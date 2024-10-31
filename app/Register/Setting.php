<?php

namespace RealPress\Register;

use RealPress\Helpers\Config;
use RealPress\Helpers\Settings;
use RealPress\Helpers\Template;
use RealPress\Helpers\Validation;

/**
 * Class Setting
 * @package RealPress\Register
 */
class Setting {
	/**
	 * @var array|mixed
	 */
	public $config = array();
	/**
	 * @var array|false|mixed|void|null
	 */
	public $data = array();

	public function __construct() {
		$this->config = Config::instance()->get( 'realpress-setting' );
		$this->data   = Settings::get_all_settings();
		add_action( 'admin_menu', array( $this, 'register' ) );
		add_action( 'admin_init', array( $this, 'save_settings' ) );
	}

	/**
	 * @return void
	 */
	public function register() {
		add_submenu_page(
			$this->config['parent_slug'],
			$this->config['page_title'],
			$this->config['menu_title'],
			$this->config['capability'],
			$this->config['slug'],
			array( $this, 'show_settings' )
		);
	}

	/**
	 * @return void
	 */
	public function show_settings() {
		$config = $this->config;
		$data   = $this->data;
		Template::instance()->get_admin_template( 'settings', compact( 'config', 'data' ) );
	}

	/**
	 * Save config
	 *
	 * @return void
	 */
	public function save_settings() {
		$nonce = Validation::sanitize_params_submitted( $_POST['realpress-option-setting-name'] ?? '' );
		if ( ! wp_verify_nonce( $nonce, 'realpress-option-setting-action' ) ) {
			return;
		}
		$data = $this->data;
		foreach ( $data as $name => $value ) {
			$field = Config::instance()->get( 'realpress-setting:' . $name );
			$key   = Validation::sanitize_params_submitted( isset( $_POST[ REALPRESS_OPTION_KEY ][ $name ] ) );
			if ( $key ) {
				$sanitize      = $field['sanitize'] ?? 'text';
				$data[ $name ] = Validation::sanitize_params_submitted( $_POST[ REALPRESS_OPTION_KEY ][ $name ], $sanitize );
			}
		}

		update_option( REALPRESS_OPTION_KEY, $data );
		wp_redirect( Validation::sanitize_params_submitted( $_SERVER['HTTP_REFERER'] ) );
	}
}
