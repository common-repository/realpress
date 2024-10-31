<?php

namespace RealPress\Models;

use RealPress\Helpers\Config;

class PropertyModel {
	private static $meta_data = array();

	public static function get_property( array $args = array() ) {

		$args              = wp_parse_args(
			$args,
			array(
				'post_status'    => array( 'publish' ),
				'posts_per_page' => - 1,
				'page'           => 1,
			)
		);
		$args['post_type'] = array( REALPRESS_PROPERTY_CPT );
		$properties        = get_posts( $args );
		$result            = array();
		foreach ( $properties as $items ) {
			$result[ $items->ID ] = $items->post_title;
		}

		return $result;
	}

	/**
	 * @param $property_id
	 * @param string $taxonomy
	 *
	 * @return array|\WP_Error
	 */
	public static function get_property_terms( $property_id, string $taxonomy = 'realpress-type' ) {
		$terms = get_the_terms( $property_id, $taxonomy );
		if ( empty( $terms ) || is_wp_error( $terms ) ) {
			return array();
		}

		return $terms;
	}

	/**
	 * @param $property_id
	 *
	 * @return mixed
	 */
	public static function get_meta_data( $property_id ) {
		if ( ! isset( self::$meta_data[ $property_id ] ) ) {
			$config = Config::instance()->get( 'property-metabox' );
			$data   = get_post_meta( $property_id, REALPRESS_PROPERTY_META_KEY, true );

			if ( empty( $data ) ) {
				$data = Config::instance()->get_default_data( $config );
			} else {
				$default = Config::instance()->get_default_data( $config );
				//If key exist in config, not in $data, add key into key into $data
				$data = wp_parse_args(
					$data,
					$default
				);
				//If key exist in $data, not in config, remove key in $data
				$diff_key = array_diff_key( $data, $default );
				if ( ! empty( $diff_key ) ) {
					foreach ( $diff_key as $key => $value ) {
						unset( $data[ $key ] );
					}
				}
			}

			self::$meta_data[ $property_id ] = $data;
		}

		return self::$meta_data[ $property_id ];
	}

	/**
	 * @param $property_id
	 *
	 * @return mixed|string
	 */
	public static function get_address_name( $property_id ) {
		$meta_data = self::get_meta_data( $property_id );

		return $meta_data['group:map:section:map:fields:name'];
	}

	public static function get_lat_lon( $property_id ) {
		$meta_data = self::get_meta_data( $property_id );

		return array(
			'lat' => $meta_data['group:map:section:map:fields:lat'],
			'lon' => $meta_data['group:map:section:map:fields:lon'],
		);
	}

	/**
	 * @param $property_id
	 *
	 * @return mixed
	 */
	public static function get_price( $property_id ) {
		$meta_data = self::get_meta_data( $property_id );

		return $meta_data['group:information:section:general:fields:price'];
	}

	/**
	 * @param $property_id
	 *
	 * @return mixed
	 */
	public static function get_text_after_price( $property_id ) {
		$meta_data = self::get_meta_data( $property_id );

		return $meta_data['group:information:section:general:fields:text_after_price'];
	}

	/**
	 * @param $property_id
	 *
	 * @return mixed
	 */
	public static function get_galleries( $property_id ) {
		$meta_data = self::get_meta_data( $property_id );

		return $meta_data['group:media:section:gallery:fields:gallery'];
	}

	/**
	 * @param $property_id
	 *
	 * @return mixed
	 */
	public static function get_vr_video( $property_id ) {
		$meta_data = self::get_meta_data( $property_id );

		return $meta_data['group:media:section:360-vr:fields:360_vr'];
	}

	/**
	 * @param $property_id
	 *
	 * @return mixed
	 */
	public static function get_video( $property_id ) {
		$meta_data = self::get_meta_data( $property_id );

		return $meta_data['group:media:section:video:fields:video'];
	}

	/**
	 * @param $property_id
	 *
	 * @return mixed
	 */
	public static function get_property_id( $property_id ) {
		$meta_data = self::get_meta_data( $property_id );

		return $meta_data['group:information:section:general:fields:property_id'];
	}

	/**
	 * @param $property_id
	 *
	 * @return mixed
	 */
	public static function get_bedrooms( $property_id ) {
		$meta_data = self::get_meta_data( $property_id );

		return $meta_data['group:information:section:general:fields:bedrooms'];
	}

	/**
	 * @param $property_id
	 *
	 * @return mixed
	 */
	public static function get_bathrooms( $property_id ) {
		$meta_data = self::get_meta_data( $property_id );

		return $meta_data['group:information:section:general:fields:bathrooms'];
	}

	/**
	 * @param $property_id
	 *
	 * @return mixed
	 */
	public static function get_area_size( $property_id ) {
		$meta_data = self::get_meta_data( $property_id );

		return $meta_data['group:information:section:general:fields:area_size'];
	}

	/**
	 * @param $property_id
	 *
	 * @return mixed
	 */
	public static function get_area_size_postfix( $property_id ) {
		$meta_data = self::get_meta_data( $property_id );

		return $meta_data['group:information:section:general:fields:area_size_postfix'];
	}

	public static function get_land_area_size( $property_id ) {
		$meta_data = self::get_meta_data( $property_id );

		return $meta_data['group:information:section:general:fields:land_area_size'];
	}

	/**
	 * @param $property_id
	 *
	 * @return mixed
	 */
	public static function get_land_area_size_postfix( $property_id ) {
		$meta_data = self::get_meta_data( $property_id );

		return $meta_data['group:information:section:general:fields:land_area_size_postfix'];
	}

	/**
	 * @param $property_id
	 *
	 * @return mixed
	 */
	public static function get_year_built( $property_id ) {
		$meta_data = self::get_meta_data( $property_id );

		return $meta_data['group:information:section:general:fields:year_built'];
	}

	/**
	 * @param $property_id
	 *
	 * @return mixed
	 */
	public static function get_additional_details( $property_id ) {
		$meta_data = self::get_meta_data( $property_id );

		return $meta_data['group:information:section:additional-features'];
	}

	/**
	 * @param $property_id
	 *
	 * @return mixed
	 */
	public static function get_rooms( $property_id ) {
		$meta_data = self::get_meta_data( $property_id );

		return $meta_data['group:information:section:general:fields:rooms'];
	}

	/**
	 * @param $property_id
	 *
	 * @return mixed
	 */
	public static function get_floor_plans( $property_id ) {
		$meta_data = self::get_meta_data( $property_id );

		return $meta_data['group:floor_plan:section:floor_plan'];
	}

	public static function is_enable_map( $property_id ) {
		$meta_data = self::get_meta_data( $property_id );

		return $meta_data['group:map:section:enable_map:fields:enable'];
	}

	/**
	 * @param $property_id
	 *
	 * @return false|string
	 */
	public static function get_excerpt( $property_id ) {
		$excerpt = get_the_excerpt( $property_id );

		if ( empty( $excerpt ) ) {
			$excerpt = get_the_content( $property_id );
		}

		return substr( $excerpt, 0, 100 );
	}

	public static function get_agent_info( $property_id ) {
		$meta_data        = self::get_meta_data( $property_id );
		$agents           = array();
		$agents['enable'] = $meta_data ['group:agent:section:agent_information:fields:enable'];

		if ( ! empty( $agents['enable'] ) ) {
			$agents['info'] = $meta_data ['group:agent:section:agent_information:fields:information'];

			if ( $agents['info'] === 'author' ) {
				$agents['user_id'] = get_post_field( 'post_author', $property_id );
			} elseif ( $agents['info'] == 'agent' ) {
				$agents['user_id'] = $meta_data['group:agent:section:agent_user:fields:agent_user'];
			} elseif ( $agents['info'] === 'show_custom_field' ) {
				$agents['custom_fields'] = $meta_data['group:agent:section:additional_agents'];
			}
		}

		return $agents;
	}
}
