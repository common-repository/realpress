<?php

namespace RealPress\Controllers;

use RealPress\Helpers\Config;
use RealPress\Helpers\Settings;
use RealPress\Helpers\Template;
use RealPress\Helpers\Page;
use RealPress\Helpers\SourceAsset;
use RealPress\Helpers\Debug;
use RealPress\Helpers\RestApi;
use RealPress\Helpers\Validation;
use WP_REST_Server;

/**
 * Class SetupWizardController
 * @package RealPress\Controllers
 */
class SetupWizardController {
	private $version_assets = REALPRESS_VERSION;
	/**
	 * @var array
	 */
	private $steps = array();
	/**
	 * @var string
	 */
	private $current_step = '';

	public function __construct() {
		if ( Debug::is_debug() ) {
			$this->version_assets = uniqid();
		}
		add_action( 'admin_menu', array( $this, 'admin_menu' ) );
		add_action( 'admin_init', array( $this, 'setup_wizard' ) );
		add_action( 'rest_api_init', array( $this, 'register_rest_routes' ) );
		//Import property with different slug if property is exist
		add_filter( 'wp_import_existing_post', array( $this, 'add_exist_property' ), 10, 2 );
	}

	/**
	 * @param $post_exists
	 * @param $post
	 *
	 * @return bool|mixed
	 */
	public function add_exist_property( $post_exists, $post ) {
		if ( $post['post_type'] === REALPRESS_PROPERTY_CPT ) {
			return true;
		}

		return $post_exists;
	}

	/**
	 * @return void
	 */
	public function register_rest_routes() {
		register_rest_route(
			RestApi::generate_namespace(),
			'/import-demo',
			array(
				'methods'             => WP_REST_Server::CREATABLE,
				'callback'            => array( $this, 'import_demo' ),
				'permission_callback' => '__return_true',
			)
		);
	}

	/**
	 * @param \WP_REST_Request $request
	 *
	 * @return \WP_REST_Response
	 */
	public function import_demo( \WP_REST_Request $request ) {
		if ( ! current_user_can( 'administrator' ) ) {
			return RestApi::error( esc_html__( 'You don\'t have permission to do it', 'realpress' ), 403 );
		}

		$dummy_dir = REALPRESS_IMPORT_DEMO_DIR . 'dummy/';
		$xml_files = glob( $dummy_dir . '*.xml' );
		natsort( $xml_files );
		if ( ! empty( $xml_files ) ) {
			foreach ( $xml_files as $xml_file ) {
				$this->import_xml( $xml_file );
			}
		}

		$widget_file = $dummy_dir . 'widgets.wie';

		$this->import_widgets( file_get_contents( $widget_file ) );

		update_option( 'realpress_db_version', REALPRESS_DB_VERSION );

		return RestApi::success(
			sprintf(
				__(
					'Congratulations! The demo have been imported successfully! <a href="%s">View All Properties</a>',
					'realpress'
				),
				get_post_type_archive_link( REALPRESS_PROPERTY_CPT )
			)
		);
	}

	/**
	 * @param $file
	 *
	 * @return array|string[]
	 */
	public function import_xml( $file ) {
		if ( ! class_exists( 'REALPRESS_Import' ) ) {
			require_once REALPRESS_IMPORT_DEMO_DIR . 'wordpress-importer/class-wp-import.php';
		}

		$wp_import = new \REALPRESS_Import;
		try {
			ob_start();
			$wp_import->fetch_attachments = true;
			$wp_import->import( $file );
			ob_clean();
		} catch ( \Exception $error ) {
			return array(
				'status' => 'error',
				'msg'    => $error->getMessage(),
			);
		}

		return array( 'status' => 'success' );
	}

	/**
	 * @param $data
	 *
	 * @return bool|mixed|void
	 */
	public function import_widgets( $data ) {
		global $wp_registered_sidebars;
		$data = json_decode( $data );

		if ( empty( $data ) || ! is_object( $data ) ) {
			return true;
		}

		// Get all available widgets site supports
		$available_widgets = $this->get_available_widgets();

		// Get all existing widget instances
		$widget_instances = [];
		foreach ( $available_widgets as $widget_data ) {
			$widget_instances[ $widget_data['id_base'] ] = get_option( 'widget_' . $widget_data['id_base'] );
		}

		// Begin results
		$results             = [];
		$widget_message_type = 'success';
		$widget_message      = '';

		// Loop import data's sidebars
		foreach ( $data as $sidebar_id => $widgets ) {

			// Skip inactive widgets
			// (should not be in export file)
			if ( 'wp_inactive_widgets' == $sidebar_id ) {
				continue;
			}

			// Check if sidebar is available on this site
			// Otherwise add widgets to inactive, and say so
			if ( isset( $wp_registered_sidebars[ $sidebar_id ] ) ) {
				$sidebar_available    = true;
				$use_sidebar_id       = $sidebar_id;
				$sidebar_message_type = 'success';
				$sidebar_message      = '';
			} else {
				$sidebar_available    = false;
				$use_sidebar_id       = 'wp_inactive_widgets'; // add to inactive if sidebar does not exist in theme
				$sidebar_message_type = 'error';
				$sidebar_message      = esc_html__( 'Widget area does not exist in theme (using Inactive)', 'realpress' );
			}

			// Result for sidebar
			$results[ $sidebar_id ]['name']         =
				! empty( $wp_registered_sidebars[ $sidebar_id ]['name'] ) ? $wp_registered_sidebars[ $sidebar_id ]['name'] :
					$sidebar_id; // sidebar name if theme supports it; otherwise ID
			$results[ $sidebar_id ]['message_type'] = $sidebar_message_type;
			$results[ $sidebar_id ]['message']      = $sidebar_message;
			$results[ $sidebar_id ]['widgets']      = [];

			// Loop widgets
			foreach ( $widgets as $widget_instance_id => $widget ) {
				$fail = false;

				// Get id_base (remove -# from end) and instance ID number
				$id_base            = preg_replace( '/-[0-9]+$/', '', $widget_instance_id );
				$instance_id_number = str_replace( $id_base . '-', '', $widget_instance_id );

				// Does site support this widget?
				if ( ! isset( $available_widgets[ $id_base ] ) ) {
					$fail                = true;
					$widget_message_type = 'error';
					$widget_message      =
						esc_html__( 'Site does not support widget', 'realpress' ); // explain why widget not imported
				}
				$widget = apply_filters( 'wie_widget_settings', $widget ); // object
				$widget = json_decode( wp_json_encode( $widget ), true );

				$widget = apply_filters( 'wie_widget_settings_array', $widget );

				// Does widget with identical settings already exist in same sidebar?
				if ( ! $fail && isset( $widget_instances[ $id_base ] ) ) {

					// Get existing widgets in this sidebar
					$sidebars_widgets = get_option( 'sidebars_widgets' );
					$sidebar_widgets  = $sidebars_widgets[ $use_sidebar_id ] ?? []; // check Inactive if that's where will go

					// Loop widgets with ID base
					$single_widget_instances = ! empty( $widget_instances[ $id_base ] ) ? $widget_instances[ $id_base ] : [];
					foreach ( $single_widget_instances as $check_id => $check_widget ) {

						// Is widget in same sidebar and has identical settings?
						if ( in_array( "$id_base-$check_id", $sidebar_widgets ) && (array) $widget == $check_widget ) {
							$fail                = true;
							$widget_message_type = 'warning';
							$widget_message      =
								esc_html__( 'Widget already exists', 'realpress' ); // explain why widget not imported
							break;
						}
					}
				}

				// No failure
				if ( ! $fail ) {
					// Add widget instance
					$single_widget_instances =
						get_option( 'widget_' . $id_base ); // all instances for that widget ID base, get fresh every time
					$single_widget_instances =
						! empty( $single_widget_instances ) ? maybe_unserialize( $single_widget_instances ) :
							[ '_multiwidget' => 1 ]; // start fresh if have to

					$single_widget_instances[] = $widget; // add it

					// Get the key it was given
					end( $single_widget_instances );
					$new_instance_id_number = key( $single_widget_instances );

					// If key is 0, make it 1
					// When 0, an issue can occur where adding a widget causes data from other widget to load, and the widget doesn't stick (reload wipes it)
					if ( '0' === strval( $new_instance_id_number ) ) {
						$new_instance_id_number                             = 1;
						$single_widget_instances[ $new_instance_id_number ] = $single_widget_instances[0];
						unset( $single_widget_instances[0] );
					}

					// Move _multiwidget to end of array for uniformity
					if ( isset( $single_widget_instances['_multiwidget'] ) ) {
						$multiwidget = $single_widget_instances['_multiwidget'];
						unset( $single_widget_instances['_multiwidget'] );
						$single_widget_instances['_multiwidget'] = $multiwidget;
					}

					// Update option with new widget
					update_option( 'widget_' . $id_base, $single_widget_instances );

					// Assign widget instance to sidebar
					$sidebars_widgets =
						get_option( 'sidebars_widgets' ); // which sidebars have which widgets, get fresh every time

					// Avoid rarely fatal error when the option is an empty string
					// https://github.com/churchthemes/widget-importer-exporter/pull/11
					if ( ! $sidebars_widgets ) {
						$sidebars_widgets = [];
					}

					$new_instance_id                       =
						$id_base . '-' . $new_instance_id_number; // use ID number from new widget instance
					$sidebars_widgets[ $use_sidebar_id ][] = $new_instance_id; // add new instance to sidebar
					update_option( 'sidebars_widgets', $sidebars_widgets ); // save the amended data

					// After widget import action
					$after_widget_import = [
						'sidebar'           => $use_sidebar_id,
						'sidebar_old'       => $sidebar_id,
						'widget'            => $widget,
						'widget_type'       => $id_base,
						'widget_id'         => $new_instance_id,
						'widget_id_old'     => $widget_instance_id,
						'widget_id_num'     => $new_instance_id_number,
						'widget_id_num_old' => $instance_id_number,
					];

					// Success message
					if ( $sidebar_available ) {
						$widget_message_type = 'success';
						$widget_message      = esc_html__( 'Imported', 'realpress' );
					} else {
						$widget_message_type = 'warning';
						$widget_message      = esc_html__( 'Imported to Inactive', 'realpress' );
					}
				}

				// Result for widget instance
				$results[ $sidebar_id ]['widgets'][ $widget_instance_id ]['name']         =
					$available_widgets[ $id_base ]['name'] ?? $id_base; // widget name or ID if name not available (not supported by site)
				$results[ $sidebar_id ]['widgets'][ $widget_instance_id ]['title']        =
					! empty( $widget['title'] ) ? $widget['title'] :
						esc_html__( 'No Title', 'realpress' ); // show "No Title" if widget instance is untitled
				$results[ $sidebar_id ]['widgets'][ $widget_instance_id ]['message_type'] = $widget_message_type;
				$results[ $sidebar_id ]['widgets'][ $widget_instance_id ]['message']      = $widget_message;
			}
		}

		return apply_filters( 'wie_import_results', $results );
	}

	/**
	 * @return mixed|void
	 */
	public function get_available_widgets() {
		global $wp_registered_widget_controls;
		$widget_controls   = $wp_registered_widget_controls;
		$available_widgets = [];
		foreach ( $widget_controls as $widget ) {
			if ( ! empty( $widget['id_base'] ) && ! isset( $available_widgets[ $widget['id_base'] ] ) ) { // no dupes
				$available_widgets[ $widget['id_base'] ]['id_base'] = $widget['id_base'];
				$available_widgets[ $widget['id_base'] ]['name']    = $widget['name'];
			}
		}

		return apply_filters( 'wie_available_widgets', $available_widgets );
	}

	/**
	 * @return void
	 */
	public function admin_menu() {
		if ( ! Page::is_setup_page() || ! current_user_can( 'install_plugins' ) ) {
			return;
		}
		add_dashboard_page( '', '', 'manage_options', 'realpress-setup', '' );
	}

	/**
	 * @return void
	 */
	public function setup_wizard() {
		if ( ! Page::is_setup_page() || ! current_user_can( 'install_plugins' ) ) {
			return;
		}

		wp_register_style( 'realpress-fontawesome-5', REALPRESS_ASSETS_URL . 'fonts/fontawesome/css/all.min.css', array(), $this->version_assets );
		wp_enqueue_style( 'realpress-fontawesome-5' );

		$fonts   = array();
		$fonts[] = 'Poppins:wght@400;600;700';

		$font_url = add_query_arg( array(
			'family'  => urlencode( implode( '|', $fonts ) ),
			'display' => 'swap',
		), 'https://fonts.googleapis.com/css2' );

		wp_enqueue_style(
			'realpress-google-fonts',
			$font_url,
			array(),
			$this->version_assets,
		);

		wp_enqueue_style( 'buttons' );
		wp_enqueue_style( 'common' );
		wp_enqueue_style( 'forms' );
		wp_enqueue_style( 'themes' );
		wp_enqueue_style( 'dashboard' );
		wp_enqueue_style( 'widgets' );
		wp_enqueue_style(
			'realpress-setup',
			SourceAsset::getInstance()->get_asset_admin_file_url( 'css', 'realpress-setup' ),
			array(),
			$this->version_assets,
			'all'
		);

		wp_enqueue_style(
			'realpress-admin',
			SourceAsset::getInstance()->get_asset_admin_file_url( 'css', 'realpress-admin' ),
			array(),
			$this->version_assets,
			'all'
		);

		wp_enqueue_script(
			'realpress-global',
			SourceAsset::getInstance()->get_asset_admin_file_url( 'js', 'realpress-global' ),
			array(),
			$this->version_assets,
			false
		);

		wp_enqueue_script(
			'realpress-setup',
			SourceAsset::getInstance()->get_asset_admin_file_url( 'js', 'realpress-setup' ),
			array( 'wp-api-fetch' ),
			$this->version_assets,
			false
		);

		wp_localize_script(
			'realpress-global',
			'REALPRESS_GLOBAL_OBJECT',
			array(
				'rest_namespace'               => RestApi::generate_namespace(),
				'agent_list_page_id'           => Settings::get_page_id( 'agent_list_page' ),
				'terms_and_conditions_page_id' => Settings::get_page_id( 'terms_and_conditions_page' ),
				'become_an_agent_page_id'      => Settings::get_page_id( 'become_an_agent_page' ),
				'wishlist_page_id'             => Settings::get_page_id( 'wishlist_page' ),
			)
		);

		$this->set_steps();
		$this->current_step = Validation::sanitize_params_submitted( $_GET['step'] ?? '' );

		$nonce = Validation::sanitize_params_submitted( $_POST['realpress_setup_wizard_name'] ?? '' );
		if ( ! empty( $nonce ) ) {
			if ( wp_verify_nonce( $nonce, 'realpress_setup_wizard_action' ) ) {
				if ( ! empty( Validation::sanitize_params_submitted( $_POST['skip_setup'] ?? '' ) ) ) {
					$this->handle_skip_setup();
				} elseif ( ! empty( Validation::sanitize_params_submitted( $_POST['save_step'] ?? '' ) ) ) {
					$this->handle_save_step();
				}
			}
		}

		if ( 'finish' === $this->current_step ) {
			update_option( 'realpress_setup_wizard_completed', 'yes' );
		}

		$this->set_setup_wizard_template();
		die;
	}

	/**
	 * @return void
	 */
	public function set_setup_wizard_template() {
		$steps = $this->steps;
		$args  = array(
			'steps'          => $steps,
			'current_step'   => $this->current_step,
			'next_step_link' => $this->get_next_step_link(),
			'prev_step_link' => $this->get_prev_step_link(),
		);
		Template::instance()->get_admin_template( 'setup/header.php' );
		Template::instance()->get_admin_template( 'setup/steps.php', compact( 'steps' ) );
		Template::instance()->get_admin_template( 'setup/content.php', compact( 'args' ) );
		Template::instance()->get_admin_template( 'setup/footer.php' );
	}

	/**
	 * @return void
	 */
	public function handle_skip_setup() {
		update_option( 'realpress_setup_wizard_completed', 'yes' );
		wp_safe_redirect( admin_url() );
		die;
	}

	/**
	 * @return void
	 */
	public function handle_save_step() {
		$option_values = Validation::sanitize_params_submitted( $_POST[ REALPRESS_OPTION_KEY ] ?? array() );
		$data          = Settings::get_all_settings();
		$group         = Validation::sanitize_params_submitted( $_POST['realpress-setup-step'] );

		foreach ( $data as $name => $value ) {
			// check current group
			if ( strpos( $name, 'group:' . $group . ':' ) !== false ) {
				$field = Config::instance()->get( 'realpress-setting:' . $name );
				if ( array_key_exists( $name, $option_values ) ) {
					$sanitize      = $field['sanitize'] ?? 'text';
					$data[ $name ] = Validation::sanitize_params_submitted( $option_values[ $name ], $sanitize );
				} else {
					if ( is_array( $field['default'] ) ) {
						$data[ $name ] = array();
					} else {
						$data[ $name ] = '';
					}
				}
			}
		}

		update_option( REALPRESS_OPTION_KEY, $data );
		wp_safe_redirect( $this->get_next_step_link() );
	}

	/**
	 * @return void
	 */
	public function set_steps() {
		$this->steps = array(
			'currency' => array(
				'title' => __( 'Currency', 'realpress' ),
			),
			'page'     => array(
				'title' => __( 'Page', 'realpress' ),
			),
			'slug'     => array(
				'title' => __( 'Slug', 'realpress' ),
			),
			'email'    => array(
				'title' => __( 'Email', 'realpress' ),
			),
			'property' => array(
				'title' => __( 'Property', 'realpress' ),
			),
			'finish'   => array(
				'title' => __( 'Finish', 'realpress' ),
			),
		);
	}

	/**
	 * @return string
	 */
	public function get_next_step_link() {
		$keys     = array_keys( $this->steps );
		$step_key = array_search( $this->current_step, array_keys( $this->steps ), true );

		if ( isset( $keys[ $step_key + 1 ] ) ) {
			return add_query_arg( 'step', $keys[ $step_key + 1 ] );
		}

		return '';
	}

	/**
	 * @return string
	 */
	public function get_prev_step_link() {
		$keys = array_keys( $this->steps );

		$step_key = array_search( $this->current_step, array_keys( $this->steps ), true );

		if ( isset( $keys[ $step_key - 1 ] ) && ( $step_key + 1 ) !== count( $keys ) ) {
			return add_query_arg( 'step', $keys[ $step_key - 1 ] );
		}

		return '';
	}
}
