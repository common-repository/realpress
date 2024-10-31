<?php

namespace RealPress\Shortcodes;

use RealPress\Helpers\Template;

/**
 * Class ContactForm
 * @package RealPress\Shortcodes
 */
class ContactForm implements RenderAble {
	/**
	 * ContactForm constructor.
	 */
	public function __construct() {
		add_shortcode( 'realpress_contact_form', array( $this, 'render' ) );
	}

	/**
	 * @param $atts
	 *
	 * @return string
	 */
	public function render( $atts ): string {
		ob_start();
		if ( ! isset( $atts['user_id'] ) ) {
			return '';
		}
		$user_id = $atts['user_id'];
		Template::instance()->get_frontend_template_type_classic( 'shortcodes/contact-form.php', compact( 'user_id' ) );

		return ob_get_clean();
	}

	/**
	 * @return void
	 */
	public function enqueue_scripts() {

	}
}
