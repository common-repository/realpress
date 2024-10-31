<?php

namespace RealPress\Helpers;

use RealPress\Models\UserModel;

class User {
	public static function get_client_IP() {
		if ( ! empty( Validation::sanitize_params_submitted( $_SERVER['HTTP_CLIENT_IP'] ?? '' ) ) ) {
			$ipaddress = Validation::sanitize_params_submitted( $_SERVER['HTTP_CLIENT_IP'] );
		} elseif ( ! empty( Validation::sanitize_params_submitted( $_SERVER['HTTP_X_FORWARDED_FOR'] ?? '' ) ) ) {
			$ipaddress = Validation::sanitize_params_submitted( $_SERVER['HTTP_X_FORWARDED_FOR'] );
		} elseif ( ! empty( Validation::sanitize_params_submitted( $_SERVER['HTTP_X_FORWARDED'] ?? '' ) ) ) {
			$ipaddress = Validation::sanitize_params_submitted( $_SERVER['HTTP_X_FORWARDED'] );
		} elseif ( ! empty( Validation::sanitize_params_submitted( $_SERVER['HTTP_FORWARDED_FOR'] ?? '' ) ) ) {
			$ipaddress = Validation::sanitize_params_submitted( $_SERVER['HTTP_FORWARDED_FOR'] );
		} elseif ( ! empty( Validation::sanitize_params_submitted( $_SERVER['HTTP_FORWARDED'] ?? '' ) ) ) {
			$ipaddress = Validation::sanitize_params_submitted( $_SERVER['HTTP_FORWARDED'] );
		} elseif ( ! empty( Validation::sanitize_params_submitted( $_SERVER['REMOTE_ADDR'] ?? '' ) ) ) {
			$ipaddress = Validation::sanitize_params_submitted( $_SERVER['REMOTE_ADDR'] );
		} else {
			$ipaddress = false;
		}

		return $ipaddress;
	}

	/**
	 * @param $user_id
	 *
	 * @return array[]
	 */
	public static function get_social_networks( $user_id ) {
		$user_meta_data = UserModel::get_user_meta_data( $user_id );

		return array(
			'facebook'    => array(
				'url'  => $user_meta_data['social_network:fields:facebook'],
				'icon' => '<i class="fab fa-facebook"></i>',
			),
			'twitter'     => array(
				'url'  => $user_meta_data['social_network:fields:twitter'],
				'icon' => '<i class="fab fa-twitter"></i>',
			),
			'google-plus' => array(
				'url'  => $user_meta_data['social_network:fields:google-plus'],
				'icon' => '<i class="fab fa-google-plus"></i>',
			),
			'instagram'   => array(
				'url'  => $user_meta_data['social_network:fields:instagram'],
				'icon' => '<i class="fab fa-instagram"></i>',
			),
			'pinterest'   => array(
				'url'  => $user_meta_data['social_network:fields:pinterest'],
				'icon' => '<i class="fab fa-pinterest"></i>',
			),
			'linkedin'    => array(
				'url'  => $user_meta_data['social_network:fields:linkedin'],
				'icon' => '<i class="fab fa-linkedin"></i>',
			),
			'skype'       => array(
				'url'  => $user_meta_data['social_network:fields:skype'],
				'icon' => '<i class="fab fa-skype"></i>',
			),
			'whatsapp'    => array(
				'url'  => $user_meta_data['social_network:fields:google-plus'],
				'icon' => '<i class="fab fa-whatsapp"></i></i>',
			),
		);
	}
}
