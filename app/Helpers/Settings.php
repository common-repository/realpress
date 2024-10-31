<?php

namespace RealPress\Helpers;

/**
 * Class Settings
 * @package RealPress\Helpers
 */
class Settings {
	/**
	 * Get all options
	 *
	 * @return false|mixed|void|null
	 */
	public static function get_all_settings() {
		static $settings = null;

		if ( null === $settings ) {
			$settings = get_option( REALPRESS_OPTION_KEY );
			$config   = Config::instance()->get( 'realpress-setting' );
			if ( empty( $settings ) ) {
				$settings = Config::instance()->get_default_data( $config );
			} else { // Handle when add key, remove key or change key settings
				$default = Config::instance()->get_default_data( $config );
				//If key exist in config, not in settings, add key into key into settings
				$settings = wp_parse_args(
					$settings,
					$default
				);
				//If key exist in settings, not in config, remove key in settings
				$diff_key = array_diff_key( $settings, $default );
				if ( ! empty( $diff_key ) ) {
					foreach ( $diff_key as $key => $value ) {
						unset( $settings[ $key ] );
					}
				}
			}
		}

		return $settings;
	}

	/**
	 * @param string $group_key
	 *
	 * @return array|false|\stdClass|string
	 */
	public static function get_setting_detail( string $group_key = '' ) {
		return self::get_all_settings()[ $group_key ] ?? '';
	}

	/**
	 * @return string
	 */
	public static function get_property_slug(): string {
		$settings = self::get_all_settings();

		if ( empty( $settings->group->url_slug->fields->property_slug->value ) ) {
			return REALPRESS_PROPERTY_CPT;
		}

		return $settings->group->url_slug->fields->property_slug->value;
	}

	public static function get_agent_slug() {
		$agent_slug = self::get_setting_detail( 'group:slug:fields:agent' );
		if ( $agent_slug === '' ) {
			$agent_slug = REALPRESS_AGENT_ROLE;
		}

		return $agent_slug;
	}

	/**
	 * @return array|false|\stdClass|string
	 */
	public static function get_advanced_search() {
		$advanced_search = self::get_setting_detail( 'group:advanced_search:fields:advanced_search' );
		unset( $advanced_search['order'] );

		return $advanced_search;
	}

	public static function get_property_per_page() {
		$property_per_page = self::get_setting_detail( 'group:property:fields:property_per_page' );
		if ( empty( $property_per_page ) ) {
			$property_per_page = 10;
		}

		return $property_per_page;
	}

	public static function get_agent_per_page() {
		$agent_per_page = self::get_setting_detail( 'group:agent:fields:agent_per_page' );
		if ( empty( $agent_per_page ) ) {
			$agent_per_page = 10;
		}

		return $agent_per_page;
	}

	/**
	 * @param $key
	 *
	 * @return array|\stdClass|string
	 */
	public static function get_page_id( $key ) {
		$page_id = Settings::get_setting_detail( 'group:page:fields:' . $key );
		if ( empty( $page_id ) ) {
			return '';
		}

		if ( get_post_status( $page_id ) !== 'publish' ) {
			return '';
		}

		return $page_id;
	}
}
