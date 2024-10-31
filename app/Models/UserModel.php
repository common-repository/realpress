<?php

namespace RealPress\Models;

use RealPress\Helpers\Config;

/**
 * UserModel
 */
class UserModel {
	private static $user_data;
	private static $cache;

	private static function set_cache( $key, $val ) {
		self::$cache[ $key ] = $val;
	}

	private static function get_cache( $key ) {
		return self::$cache[ $key ] ?? null;
	}

	/**
	 * @param $user_id
	 * @param string $size
	 *
	 * @return false|mixed|string
	 */
	public static function get_user_avatar( $user_id = null, string $size = 'thumbnail' ) {
		$user_id   = empty( $user_id ) ? get_current_user_id() : $user_id;
		$meta_data = self::get_user_meta_data( $user_id );
		$avatar_id = $meta_data['user_profile:fields:profile_picture']['image_id'] ?? '';
		if ( empty( $avatar_id ) ) {
			$avatar_url = get_avatar_url( $user_id, array( 'size' => $size ) );
		} else {
			$avatar_url = wp_get_attachment_image_src( $avatar_id, $size )[0];
		}

		return $avatar_url;
	}

	public static function get_user_meta_data( $user_id ) {
		$user_meta_data = array();

		if ( ! empty( $user_id ) ) {
			$user_meta_data = get_user_meta( $user_id, REALPRESS_USER_META_KEY, true );
		}
		if ( empty( $user_meta_data ) ) {
			$config         = Config::instance()->get( 'agent-profile' );
			$user_meta_data = Config::instance()->get_default_data( $config );
		}

		return $user_meta_data;
	}

	/**
	 * @param $user_id
	 * @param $field
	 *
	 * @return int|mixed|string
	 */
	public static function get_field( $user_id, $field ) {
		$user_data = self::get_user_data( $user_id );

		return $user_data->{$field} ?? '';
	}

	/**
	 * @param $user_id
	 *
	 * @return false|mixed|\WP_User
	 */
	public static function get_user_data( $user_id ) {
		if ( isset( self::$user_data[ $user_id ] ) ) {
			return self::$user_data[ $user_id ];
		}

		self::$user_data[ $user_id ] = get_userdata( $user_id );

		return self::$user_data[ $user_id ];
	}

	/**
	 * @return array|mixed
	 */
	public static function get_pending_requests() {
		$key   = 'realpress_pending_requests';
		$cache = self::get_cache( $key );

		if ( $cache ) {
			return $cache;
		}
		global $wpdb;

		$query = $wpdb->prepare(
			"
				SELECT ID
				FROM {$wpdb->users} u
				INNER JOIN {$wpdb->usermeta} um ON um.user_id = u.ID AND um.meta_key = %s
				WHERE um.meta_value = %s
			",
			REALPRESS_PREFIX . '_become_an_agent_request',
			'yes'
		);

		$pending_requests = $wpdb->get_col( $query );
		self::set_cache( $key, $pending_requests );

		return $pending_requests;
	}
}