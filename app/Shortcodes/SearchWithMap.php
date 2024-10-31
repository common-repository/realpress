<?php

namespace RealPress\Shortcodes;

use RealPress\Helpers\Template;

/**
 * Class SearchWithMap
 * @package RealPress\Shortcodes
 */
class SearchWithMap implements RenderAble {
	/**
	 * PropertyList constructor.
	 */
	public function __construct() {
		add_shortcode( 'realpress_search_with_map', array( $this, 'render' ) );
	}

	/**
	 * @param $atts
	 *
	 * @return string
	 */
	public function render( $atts ): string {
		ob_start();
		Template::instance( true )->get_frontend_template_type_classic( 'shortcodes/search-with-map.php' );

		return ob_get_clean();
	}

	/**
	 * @return void
	 */
	public function enqueue_scripts() {

	}
}
