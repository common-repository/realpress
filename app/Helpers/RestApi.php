<?php

namespace RealPress\Helpers;

/**
 * Class RestApi
 */
class RestApi {
	/**
	 * @return string
	 */
	public static function generate_namespace(): string {
		return REALPRESS_PREFIX . '/' . REALPRESS_REST_VERSION;
	}

	public static function error( string $msg = '', $status_code = 404 ) {
		return new \WP_REST_Response(
			array(
				'status'      => 'error',
				'msg'         => $msg,
				'status_code' => $status_code,
			),
			$status_code
		);
	}

	/**
	 * @param string $msg
	 * @param array $data
	 *
	 * @return \WP_REST_Response
	 */
	public static function success( string $msg = '', array $data = array() ) {
		return new \WP_REST_Response(
			array(
				'status' => 'success',
				'msg'    => $msg,
				'data'   => $data,
			),
			200
		);
	}

	public static function build_properties_query( $params ) {

	}
}