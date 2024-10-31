<?php

namespace RealPress\Models;

use RealPress\Helpers\Config;

class TermModel {
	private static $meta_data = array();

	public static function get_meta_data( $term_id ) {
		if ( isset( self::$meta_data[ $term_id ] ) && ! empty( self::$meta_data[ $term_id ] ) ) {
			return self::$meta_data[ $term_id ];
		}
		$data         = get_term_meta( $term_id, REALPRESS_TERM_META_KEY, true );
		$default_data = self::get_default_meta_data( $term_id );
		if ( empty( $data ) ) {
			$data = $default_data;
		} else {
			//If key exist in config, not in data, add key into key into data
			$data = wp_parse_args(
				$data,
				$default_data
			);
			//If key exist in data, not in config, remove key in data
			$diff_key = array_diff_key( $data, $default_data );
			if ( ! empty( $diff_key ) ) {
				foreach ( $diff_key as $key => $value ) {
					unset( $data[ $key ] );
				}
			}
		}

		self::$meta_data[ $term_id ] = $data;

		return self::$meta_data[ $term_id ];
	}

	/**
	 * @param $term_id
	 *
	 * @return array
	 */
	private static function get_default_meta_data( $term_id ) {
		$taxonomy = get_term( $term_id )->taxonomy;
		$fields   = Config::instance()->get( 'term-metabox:' . $taxonomy );

		if ( empty( $fields ) ) {
			return array();
		}

		$default_data = array();
		foreach ( $fields as $field ) {
			$default_data[ $field['name'] ] = $field['default'];
		}

		return $default_data;
	}
}
