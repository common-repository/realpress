<?php

namespace RealPress\Shortcodes;

use RealPress\Helpers\Template;

/**
 * Class HeaderMap
 * @package RealPress\Shortcodes
 */
class HeaderMap implements RenderAble {
	/**
	 * PropertyList constructor.
	 */
	public function __construct() {
		add_shortcode( 'realpress_header_map', array( $this, 'render' ) );
	}

	/**
	 * @param $atts
	 *
	 * @return string
	 */
	public function render( $atts ): string {
		ob_start();
		Template::instance( true )->get_frontend_template_type_classic( 'shortcodes/header-map.php' );

		return ob_get_clean();
	}

	/**
	 * @return void
	 */
	public function enqueue_scripts() {

	}
}
