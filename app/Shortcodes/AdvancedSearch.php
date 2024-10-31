<?php

namespace RealPress\Shortcodes;

use RealPress\Helpers\Template;

/**
 * Class AdvancedSearch
 * @package RealPress\Shortcodes
 */
class AdvancedSearch implements RenderAble {
	/**
	 * BecomeAgentForm constructor.
	 */
	public function __construct() {
		add_shortcode( 'realpress_advanced_search', array( $this, 'render' ) );
	}

	/**
	 * @param $atts
	 *
	 * @return string
	 */
	public function render( $atts ): string {
		ob_start();
		if ( isset( $atts['layout'] ) ) {
			do_action( 'realpress/shortcode/realpress-advanced-search/render', $atts );
		} else {
			Template::instance( true )->get_frontend_template_type_classic( 'shortcodes/advanced-search.php' );
		}

		return ob_get_clean();
	}

	/**
	 * @return void
	 */
	public function enqueue_scripts() {

	}
}

