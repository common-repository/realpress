<?php

namespace RealPress\Shortcodes;

use RealPress\Helpers\Template;
use RealPress\Helpers\Page;

/**
 * Class BecomeAgentForm
 * @package RealPress\Shortcodes
 */
class BecomeAgentForm implements RenderAble {
	/**
	 * BecomeAgentForm constructor.
	 */
	public function __construct() {
		add_shortcode( 'realpress_become_an_agent', array( $this, 'render' ) );
	}

	/**
	 * @param $atts
	 *
	 * @return string
	 */
	public function render( $atts ): string {
		ob_start();
		if ( Page::is_become_an_agent_page() ) {
			Template::instance( true )->get_frontend_template_type_classic( 'shortcodes/become-an-agent.php' );
		}

		return ob_get_clean();
	}

	/**
	 * @return void
	 */
	public function enqueue_scripts() {

	}
}

