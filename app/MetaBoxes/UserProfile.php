<?php

namespace RealPress\MetaBoxes;

use RealPress\Helpers\Config;
use RealPress\Helpers\Validation;
use RealPress\Helpers\Template;
use RealPress\Models\UserModel;

/**
 * Class UserProfile
 * @package RealPress\MetaBoxes
 */
class UserProfile {
	/**
	 * @var array
	 */
	private $config = array();

	/**
	 * MetaFieldsController constructor.
	 */
	public function __construct() {
		$this->config = Config::instance()->get( 'agent-profile' );
		add_action( 'user_new_form', array( $this, 'add_user_profile_fields' ) );
		add_action( 'show_user_profile', array( $this, 'add_user_profile_fields' ) );
		add_action( 'edit_user_profile', array( $this, 'add_user_profile_fields' ) );
		add_action( 'personal_options_update', array( $this, 'save_user_profile_fileds' ) );
		add_action( 'edit_user_profile_update', array( $this, 'save_user_profile_fileds' ) );
	}

	/**
	 * @param $user
	 *
	 * @return void
	 */
	public function add_user_profile_fields( $user ) {
		$config = $this->config;
		if ( is_object( $user ) ) {
			$user_id = $user->ID;
		} else {
			$user_id = '';
		}

		if ( empty( $user_id ) ) {
			return $user;
		}

		if ( user_can( $user_id, 'edit_realpress-properties' ) ) {
			$data = UserModel::get_user_meta_data( $user_id );
			Template::instance()->get_admin_template( 'user/agent-profile', compact( 'config', 'data' ) );
		}

		return $user;
	}


	/**
	 * @param $user_id
	 *
	 * @return mixed|void
	 */
	public function save_user_profile_fileds( $user_id ) {
		$nonce = Validation::sanitize_params_submitted( $_POST['realpress_admin_user_profile_name'] ?? '' );
		if ( empty( $nonce ) || ! wp_verify_nonce( $nonce, 'realpress_admin_user_profile_action' ) ) {
			return $user_id;
		}

		if ( ! current_user_can( 'edit_user', $user_id ) ) {
			return $user_id;
		}

		//set default data when save empty data
		$data     = Validation::sanitize_params_submitted( $_POST[ REALPRESS_USER_META_KEY ] );
		$new_data = array();

		foreach ( $data as $name => $value ) {
			$field             = Config::instance()->get( 'agent-profile:' . $name );
			$value             = Validation::filter_fields( $data[ $name ], $field );
			$sanitize          = $field['sanitize'] ?? 'text';
			$value             = Validation::sanitize_params_submitted( $value, $sanitize );
			$new_data[ $name ] = $value;

			if ( ! empty( $field['is_single_key'] ) ) {
				update_user_meta( $user_id, REALPRESS_PREFIX . '_' . $name, $value );
			}
		}

		update_user_meta( $user_id, REALPRESS_USER_META_KEY, $new_data );
	}
}
