<?php

namespace RealPress\Helpers;

use WP_Query;

/**
 * Class Page
 * @package RealPress\Helpers
 */
class Page {
	/**
	 * @return bool
	 */
	public static function is_property_setting_page(): bool {
		global $pagenow;
		$slug = Config::instance()->get( 'realpress-setting:slug' );

		if ( 'edit.php' !== $pagenow ) {
			return false;
		}

		$post_type = Validation::sanitize_params_submitted( $_GET['post_type'] ?? '' );
		$page      = Validation::sanitize_params_submitted( $_GET['page'] ?? '' );

		if ( empty( $post_type ) || empty( $page ) || REALPRESS_PROPERTY_CPT !== $post_type || $page !== $slug ) {
			return false;
		}

		return true;
	}


	public static function is_import_demo_page(): bool {
		global $pagenow;
		$slug = 'import-demo';

		if ( 'edit.php' !== $pagenow ) {
			return false;
		}

		$post_type = Validation::sanitize_params_submitted( $_GET['post_type'] ?? '' );
		$page      = Validation::sanitize_params_submitted( $_GET['page'] ?? '' );

		if ( empty( $post_type ) || empty( $page ) || REALPRESS_PROPERTY_CPT !== $post_type || $page !== $slug ) {
			return false;
		}

		return true;
	}

	/**
	 * @return bool
	 */
	public static function is_admin_single_property_page(): bool {
		global $pagenow, $current_screen;

		if ( ! in_array( $pagenow, array( 'post-new.php', 'post.php' ) ) ) {
			return false;
		}

		if ( ! isset( $current_screen->post_type ) || $current_screen->post_type !== REALPRESS_PROPERTY_CPT ) {
			return false;
		}

		return true;
	}

	/**
	 * @return mixed|string|void
	 */
	public static function get_current_page() {
		if ( self::is_property_setting_page() ) {
			return REALPRESS_PROPERTY_SETTING_PAGE;
		} elseif ( self::is_import_demo_page() ) {
			return REALPRESS_IMPORT_DEMO_PAGE;
		} elseif ( self::is_admin_single_property_page() ) {
			return REALPRESS_ADMIN_SINGLE_PROPERTY_PAGE;
		} elseif ( self::is_property_single_page() ) {
			return REALPRESS_SINGLE_PROPERTY_PAGE;
		} elseif ( self::is_property_term_page() ) {
			return REALPRESS_ADMIN_PROPERTY_TERM_PAGE;
		} elseif ( self::is_property_edit_tag_page() ) {
			return REALPRESS_PROPERTY_EDIT_TAGS_PAGE;
		} elseif ( self::is_user_profile_page() ) {
			return REALPRESS_USER_PROFILE_PAGE;
		} elseif ( self::is_property_archive_page() ) {
			return REALPRESS_PROPERTY_ARCHIVE_PAGE;
		} elseif ( self::is_agent_list_page() ) {
			return REALPRESS_AGENT_LIST_PAGE;
		} elseif ( self::is_become_an_agent_page() ) {
			return REALPRESS_BECOME_AN_AGENT_PAGE;
		} elseif ( Page::is_agent_detail_page() ) {
			return REALPRESS_AGENT_DETAIL_PAGE;
		} elseif ( Page::is_setup_page() ) {
			return REALPRESS_SETUP_PAGE;
		} elseif ( Page::is_wishlist_page() ) {
			return REALPRESS_WISHLIST_PAGE;
		} else {
			return apply_filters( 'realpress/page/current', '' );
		}
	}

	public static function is_agent_detail_page() {
		if ( ! is_author() ) {
			return false;
		}

		$author = get_queried_object();
		$roles  = $author->roles;

		return in_array( REALPRESS_AGENT_ROLE, $roles );
	}

	/**
	 * @return bool
	 */
	public static function is_widget_page() {
		global $pagenow;

		return $pagenow === 'widgets.php';
	}

	public static function is_property_archive_page() {
		if ( is_post_type_archive( REALPRESS_PROPERTY_CPT ) || self::is_property_taxonomy_archive() ) {
			return true;
		}

		return false;
	}


	public static function is_property_taxonomy_archive() {
		return is_tax( array_keys( Config::instance()->get( 'property-type:taxonomies' ) ) );
	}

	public static function is_property_single_page() {
		return is_singular( REALPRESS_PROPERTY_CPT );
	}

	/**
	 * @return array|false|mixed|string
	 */
	public static function get_property_single_edit_page() {
		$post = Validation::sanitize_params_submitted( $_GET['post'] ?? '' );
		if ( self::is_admin_single_property_page() && ! empty( $post ) ) {
			return $post;
		}

		return false;
	}

	public static function is_property_term_page() {
		global $pagenow;

		$post_type = Validation::sanitize_params_submitted( $_GET['post_type'] ?? '' );
		if ( empty( $post_type ) || $post_type !== REALPRESS_PROPERTY_CPT ) {
			return false;
		}

		if ( $pagenow === 'term.php' ) {
			return true;
		}

		return false;
	}

	public static function is_property_edit_tag_page() {
		global $pagenow;

		$post_type = Validation::sanitize_params_submitted( $_GET['post_type'] ?? '' );
		if ( empty( $post_type ) || $post_type !== REALPRESS_PROPERTY_CPT ) {
			return false;
		}

		if ( $pagenow === 'edit-tags.php' ) {
			return true;
		}

		return false;
	}

	public static function is_user_profile_page() {
		global $pagenow;
		if ( in_array( $pagenow, array( 'profile.php', 'user-new.php', 'user-edit.php' ) ) ) {
			return true;
		}

		return false;
	}

	public static function is_agent_list_page() {
		if ( ! is_singular( 'page' ) ) {
			return false;
		}
		global $post;
		$agent_list_page_id = Settings::get_page_id( 'agent_list_page' );

		return $agent_list_page_id == $post->ID;
	}

	public static function is_become_an_agent_page() {
		if ( ! is_singular( 'page' ) ) {
			return false;
		}
		global $post;
		$become_an_agent_page_id = Settings::get_page_id( 'become_an_agent_page' );

		return $become_an_agent_page_id == $post->ID;
	}

	public static function is_wishlist_page() {
		if ( ! is_singular( 'page' ) ) {
			return false;
		}
		global $post;
		$agent_list_page_id = Settings::get_page_id( 'wishlist_page' );

		return $agent_list_page_id == $post->ID;
	}

	public static function is_setup_page() {
		$page = Validation::sanitize_params_submitted( $_GET['page'] ?? '' );
		if ( ! empty( $page ) && 'realpress-setup' == $page ) {
			return true;
		}

		return false;
	}
}


