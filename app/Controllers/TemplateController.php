<?php

namespace RealPress\Controllers;

use RealPress\Helpers\Template;
use RealPress\Helpers\Page;
use RealPress\Helpers\Config;

/**
 * Class TemplateController
 * @package RealPress\Controllers
 */
class TemplateController {
	public function __construct() {
		add_filter( 'single_template', array( $this, 'load_template_single_property' ), 10, 3 );
		add_filter( 'page_template', array( $this, 'load_list_agent_template' ), 10, 3 );
		add_filter( 'page_template', array( $this, 'load_wishlist_template' ), 10, 3 );
		add_filter( 'the_content', array( $this, 'filter_become_an_agent_page_content' ), 10, 3 );
		add_filter( 'archive_template', array( $this, 'load_template_archive_property' ), 10, 3 );
		add_filter( 'taxonomy_template', array( $this, 'load_template_taxonomy_property' ), 10, 3 );
		add_filter( 'author_template', array( $this, 'load_template_author' ), 10, 3 );
	}

	/**
	 * @param string $template
	 * @param string $type
	 * @param array $templates
	 *
	 * @return string|void
	 */
	public function load_list_agent_template( string $template, string $type, array $templates ) {
		if ( Page::is_agent_list_page() ) {
			$template = Template::instance( false )->get_frontend_template_type_classic( 'agent-list.php' );
		}

		return $template;
	}


	/**
	 * @param string $template
	 * @param string $type
	 * @param array $templates
	 *
	 * @return string|void
	 */
	public function load_wishlist_template( string $template, string $type, array $templates ) {
		if ( Page::is_wishlist_page() ) {
			$template = Template::instance( false )->get_frontend_template_type_classic( 'wishlist.php' );
		}

		return $template;
	}

	/**
	 * @param string $content
	 *
	 * @return string
	 */
	public function filter_become_an_agent_page_content( string $content ) {
		if ( Page::is_become_an_agent_page() ) {
			$content .= '[realpress_become_an_agent]';
		}

		return $content;
	}

	/**
	 * @param string $template
	 * @param string $type
	 * @param array $templates
	 *
	 * @return string|void
	 */
	public function load_template_archive_property( string $template, string $type, array $templates ) {
		if ( wp_is_block_theme() ) {
			return $template;
		}

		if ( ! is_post_type_archive( REALPRESS_PROPERTY_CPT ) ) {
			return $template;
		}

		if ( 'archive' !== $type ) {
			return $template;
		}

		return Template::instance( false )->get_frontend_template_type_classic( 'archive-property.php' );
	}


	public function load_template_taxonomy_property( string $template, string $type, array $templates ) {
		if ( wp_is_block_theme() ) {
			return $template;
		}

		if ( 'taxonomy' !== $type ) {
			return $template;
		}

		$current_term      = get_queried_object();
		$custom_taxonomies = array_keys( Config::instance()->get( 'property-type:taxonomies' ) );

		if ( ! in_array( $current_term->taxonomy, $custom_taxonomies ) ) {
			return $template;
		}

		return Template::instance( false )->get_frontend_template_type_classic( 'archive-property.php' );
	}

	/**
	 * @param string $template
	 * @param string $type
	 * @param array $templates
	 *
	 * @return string|void
	 */
	public function load_template_author( string $template, string $type, array $templates ) {
		if ( 'author' !== $type ) {
			return $template;
		}

		if ( ! in_array( REALPRESS_AGENT_ROLE, get_queried_object()->roles ) ) {
			return $template;
		}

		return Template::instance( false )->get_frontend_template_type_classic( 'agent-detail.php' );
	}

	/**
	 * Load property template
	 * Hook apply_filters( "{$type}_template", $template, $type, $templates );
	 *
	 * @param string $single
	 *
	 * @return string|void
	 * @since 1.0.0
	 * @version 1.0.0
	 */
	public function load_template_single_property( string $template, string $type, array $templates ) {
		global $post;

		if ( empty( $post ) ) {
			return $template;
		}

		if ( wp_is_block_theme() ) {
			return $template;
		}

		if ( REALPRESS_PROPERTY_CPT !== $post->post_type ) {
			return $template;
		}
		/* Checks for single template by post type */
		if ( 'single' == $type ) {
			$template = Template::instance( false )->get_frontend_template_type_classic( 'single-property.php' );
		}

		return $template;
	}
}
