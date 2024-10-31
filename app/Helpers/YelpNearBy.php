<?php

namespace RealPress\Helpers;

/**
 * Class YelpNearBy
 * @package RealPress\Helpers
 */
class YelpNearBy {
	public static function get_data( $term, array $lat_lon = array() ) {
		$api_key = Settings::get_setting_detail( 'group:yelp_nearby:fields:api' );
		if ( empty( $api_key ) ) {
			return array(
				'status' => 'error',
				'msg'    => esc_html__( 'Please setup API in setting', 'realpress' ),
			);
		}
		$location  = implode( ',', $lat_lon );
		$query_url = add_query_arg(
			array(
				'term'     => $term,
				'location' => $location,
				'limit'    => Settings::get_setting_detail( 'group:yelp_nearby:fields:limit' ),
				'sort_by'  => 'distance',
			),
			'https://api.yelp.com/v3/businesses/search'
		);

		$args = array(
			'user-agent' => '',
			'headers'    => array(
				'authorization' => 'Bearer ' . $api_key,
			),
		);

		$response = wp_safe_remote_get( $query_url, $args );
		if ( is_wp_error( $response ) ) {
			return array(
				'status' => 'error',
				'msg'    => $response->get_error_message(),
			);
		}

		$body = wp_remote_retrieve_body( $response );
		$data = json_decode( $body, false );

		return array(
			'status' => 'success',
			'data'   => $data,
		);
	}

	public static function get_distance( $lat_1, $lon_1, $lat_2, $lon_2, string $unit = 'km' ) {
		$theta = $lon_1 - $lon_2;
		$dist  = sin( deg2rad( $lat_1 ) ) * sin( deg2rad( $lat_2 ) ) + cos( deg2rad( $lat_1 ) ) * cos( deg2rad( $lat_2 ) ) * cos( deg2rad( $theta ) );
		$dist  = acos( $dist );

		if ( $unit === 'km' ) {
			$dist = $dist * 60 * 1.609344;
		} elseif ( $unit === 'miles' ) {
			$dist = $dist * 60 * 1.1515;
		}

		return rad2deg( $dist );
	}
}

