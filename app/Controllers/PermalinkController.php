<?php

namespace RealPress\Controllers;

use RealPress\Helpers\Settings;
use RealPress\Models\UserModel;

class PermalinkController {

	public function __construct() {
		add_action( 'init', array( $this, 'add_user_rewrite_tag' ) );
		add_filter( 'author_link', array( $this, 'change_author_link' ), 9999, 2 );
		add_filter( 'realpress/config/post_types', array( $this, 'change_property_slug' ) );
		add_filter( 'realpress/config/taxonomies', array( $this, 'change_taxonomies_slug' ) );
	}

	public function change_author_link( $link, $user_id ) {
		if ( false !== strpos( $link, '%realpress_user_role%' ) ) {
			$roles = UserModel::get_field( $user_id, 'roles' );
			if ( is_array( $roles ) && in_array( REALPRESS_AGENT_ROLE, $roles ) ) {
				$slug = Settings::get_agent_slug();
			} else {
				$slug = 'author';
			}

			$link = str_replace( '%realpress_user_role%', $slug, $link );
		}

		return $link;
	}

	public function add_user_rewrite_tag() {
		global $wp_rewrite;
		$agent_slug = Settings::get_agent_slug();
		add_rewrite_tag( '%realpress_user_role%', '(' . $agent_slug . '|author)' );
		$wp_rewrite->author_base = '%realpress_user_role%';
	}

	public function change_property_slug( $config ) {
		$config[ REALPRESS_PROPERTY_CPT ]['rewrite']['slug'] = Settings::get_setting_detail( 'group:slug:fields:property' );

		return $config;
	}

	public function change_taxonomies_slug( $taxonomies ) {
		foreach ( $taxonomies as $name => $args ) {
			$taxonomies[ $name ]['rewrite']['slug'] = Settings::get_setting_detail( 'group:slug:fields:' . $name );
		}

		return $taxonomies;
	}
}
