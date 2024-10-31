<?php

namespace RealPress\Controllers;

use RealPress\Helpers\Debug;
use RealPress\Helpers\General;
use RealPress\Helpers\Page;
use RealPress\Helpers\Config;
use RealPress\Helpers\Price;
use RealPress\Helpers\RestApi;
use RealPress\Helpers\Settings;
use RealPress\Models\PropertyModel;

/**
 * Class EnqueueScriptsController
 * @package RealPress\Controllers
 */
class EnqueueScriptsController {
	/**
	 * @var mixed|string
	 */
	private $version_assets = REALPRESS_VERSION;

	/**
	 * EnqueueScripts constructor.
	 */
	public function __construct() {
		if ( Debug::is_debug() ) {
			$this->version_assets = uniqid();
		}
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'wp_enqueue_scripts' ) );
	}

	/**
	 * @param $args
	 *
	 * @return mixed|void
	 */
	public function can_load_asset( $args ) {
		$current_page = Page::get_current_page();
		$can_load     = false;

		if ( ! empty( $args['screens'] ) ) {
			if ( in_array( $current_page, $args['screens'] ) ) {
				$can_load = true;
			}
		} elseif ( ! empty( $args['exclude_screens'] ) ) {
			if ( ! in_array( $current_page, $args['exclude_screens'] ) ) {
				$can_load = true;
			}
		} else {
			$can_load = true;
		}

		$is_on = 'admin';
		if ( ! is_admin() ) {
			$is_on = 'frontend';
		}

		return apply_filters(
			'realpress/' . $is_on . '/can-load-assets/' . $args['type'] . '/' . $args['handle'],
			$can_load,
			$current_page,
			$args['screens']
		);
	}

	/**
	 * @return void
	 */
	public function admin_enqueue_scripts() {
		$styles = Config::instance()->get( 'styles:admin' );

		foreach ( $styles as $handle => $args ) {
			wp_register_style(
				$handle,
				$args['src'] ?? '',
				$args['deps'] ?? array(),
				$this->version_assets,
				'all'
			);

			$can_load_asset = $this->can_load_asset(
				array(
					'handle'          => $handle,
					'screens'         => $args['screens'] ?? array(),
					'exclude_screens' => $args['exclude_screens'] ?? array(),
					'type'            => 'css',
				)
			);

			if ( $can_load_asset ) {
				wp_enqueue_style( $handle );
			}
		}

		$scripts          = Config::instance()->get( 'scripts:admin' );
		$register_scripts = $scripts['register'];
		foreach ( $register_scripts as $handle => $args ) {
			wp_register_script(
				$handle,
				$args['src'],
				$args['deps'] ?? array(),
				$this->version_assets,
				$args['in_footer'] ?? true
			);

			$can_load_asset = $this->can_load_asset(
				array(
					'handle'          => $handle,
					'screens'         => $args['screens'] ?? [],
					'exclude_screens' => $args['exclude_screens'] ?? [],
					'type'            => 'js',
				)
			);

			if ( $can_load_asset ) {
				wp_enqueue_script( $handle );
			}
		}

		$this->localize_admin_script();

		$js_translation = $scripts['js-translation'];
		if ( ! empty( $js_translation ) ) {
			foreach ( $js_translation as $handle => $args ) {
				wp_set_script_translations( $handle, 'realpress', $args['src'] );
			}
		}
	}

	/**
	 * @return void
	 */
	public function wp_enqueue_scripts() {
		wp_register_style( 'realpress-fontawesome-5', REALPRESS_ASSETS_URL . 'fonts/fontawesome/css/all.min.css', array(), $this->version_assets );
		wp_enqueue_style( 'realpress-fontawesome-5' );

		$styles = Config::instance()->get( 'styles:frontend' );

		foreach ( $styles as $handle => $args ) {
			wp_register_style(
				$handle,
				$args['src'] ?? '',
				$args['deps'] ?? array(),
				$this->version_assets,
				'all'
			);

			$can_load_asset = $this->can_load_asset(
				array(
					'handle'          => $handle,
					'screens'         => $args['screens'] ?? array(),
					'exclude_screens' => $args['exclude_screens'] ?? array(),
					'type'            => 'css',
				)
			);

			if ( $can_load_asset ) {
				wp_enqueue_style( $handle );
			}
		}

		$scripts          = Config::instance()->get( 'scripts:frontend' );
		$register_scripts = $scripts['register'];
		foreach ( $register_scripts as $handle => $args ) {
			wp_register_script(
				$handle,
				$args['src'],
				$args['deps'] ?? array(),
				$this->version_assets,
				$args['in_footer'] ?? true
			);

			$can_load_asset = $this->can_load_asset(
				array(
					'handle'          => $handle,
					'screens'         => $args['screens'] ?? [],
					'exclude_screens' => $args['exclude_screens'] ?? [],
					'type'            => 'js',
				)
			);

			if ( $can_load_asset ) {
				wp_enqueue_script( $handle );
			}
		}

		$this->localize_frontend_script();
	}

	/**
	 * @return void
	 */
	public function localize_frontend_script() {
		if ( is_singular( REALPRESS_PROPERTY_CPT ) ) {
			$meta_data = get_post_meta( get_the_ID(), REALPRESS_PROPERTY_META_KEY, true );
			wp_localize_script(
				'realpress-single-property',
				'REALPRESS_SINGLE_PROPERTY_PAGE',
				array(
					'map'         => array(
						'name' => $meta_data['group:map:section:map:fields:name'],
						'lat'  => $meta_data['group:map:section:map:fields:lat'],
						'lon'  => $meta_data['group:map:section:map:fields:lon'],
					),
					'property_id' => get_the_ID(),
				)
			);
		}

		if ( Page::is_property_archive_page() ) {
			wp_localize_script(
				'realpress-archive-property',
				'REALPRESS_PROPERTY_ARCHIVE_OBJECT',
				array(
					'term_id'  => get_queried_object()->term_id ?? '',
					'taxonomy' => get_queried_object()->taxonomy ?? '',
				)
			);
		}

		if ( Page::is_agent_detail_page() ) {
			wp_localize_script(
				'realpress-agent-detail',
				'REALPRESS_AGENT_DETAIL_OBJECT',
				array(
					'user_id' => get_queried_object()->ID ?? '',
				)
			);
		}

		$advanced_search = array(
			'min_price'           => Settings::get_setting_detail( 'group:advanced_search:fields:min_price' ),
			'max_price'           => Settings::get_setting_detail( 'group:advanced_search:fields:max_price' ),
			'allow_redirect_page' => true,
		);

		if ( Page::is_property_archive_page() ) {
			$advanced_search['allow_redirect_page'] = false;
		}

		if ( empty( Settings::get_setting_detail( 'group:advanced_search:fields:redirect_to' ) ) ) {
			$advanced_search['redirect_page'] = 'archive_page';
		} else {
			$advanced_search['redirect_page'] = get_permalink( Settings::get_setting_detail( 'group:advanced_search:fields:redirect_to' ) );
		}

		$agent_list_page_id = Settings::get_page_id( 'agent_list_page' );

		wp_localize_script(
			'realpress-global',
			'REALPRESS_GLOBAL_OBJECT',
			array(
				'rest_namespace'            => RestApi::generate_namespace(),
				'advanced_search'           => $advanced_search,
				'currency_symbol'           => Price::get_currency_symbol(),
				'thousands_separator'       => Settings::get_setting_detail( 'group:currency:fields:thousands_separator' ),
				'number_decimals'           => Settings::get_setting_detail( 'group:currency:fields:number_of_decimals' ),
				'currency_position'         => Settings::get_setting_detail( 'group:currency:fields:position' ),
				'agent_list_page_url'       => empty( $agent_list_page_id ) ? '' : get_permalink( $agent_list_page_id ),
				'archive_property_page_url' => get_post_type_archive_link( REALPRESS_PROPERTY_CPT ),
				'login_page_url'            => wp_login_url(),
				'image_placeholder'         => General::get_image_place_holder(),
			)
		);
	}

	/**
	 * @return void
	 */
	public function localize_admin_script() {
		wp_localize_script(
			'realpress-global',
			'REALPRESS_GLOBAL_OBJECT',
			array(
				'rest_namespace' => RestApi::generate_namespace(),
				'siteurl'        => site_url(),
			)
		);

		if ( Page::is_admin_single_property_page() ) {
			$property_id = Page::get_property_single_edit_page();
			$taxonomies  = $this->get_property_taxonomies();
			$term_ids    = $this->get_post_terms( $property_id, $taxonomies );
			wp_localize_script(
				'realpress-property',
				'REALPRESS_ADMIN_SINGLE_PROPERTY_OBJECT',
				array(
					'post_terms' => $term_ids,
					'taxonomies' => $taxonomies,
				)
			);
		}

		wp_localize_script(
			'realpress-edit-block',
			'REALPRESS_ADMIN_EDIT_PROPERTY',
			array()
		);
	}

	/**
	 * @return int[]|string[]
	 */
	public function get_property_taxonomies() {
		$taxonomies = Config::instance()->get( 'property-type:taxonomies' );

		return array_keys( $taxonomies );
	}

	/**
	 * @param $post_id
	 * @param $taxonomies
	 *
	 * @return array
	 */
	public function get_post_terms( $post_id, $taxonomies ) {
		$term_ids = array();
		foreach ( $taxonomies as $taxonomy_slug ) {
			$all_post_terms = PropertyModel::get_property_terms( $post_id, $taxonomy_slug );

			if ( ! empty( $all_post_terms ) ) {
				foreach ( $all_post_terms as $post_term ) {
					$term_ids[ $taxonomy_slug ][] = $post_term->term_id;
				}
			}
		}

		return $term_ids;
	}
}
