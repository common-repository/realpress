<?php

namespace RealPress\Shortcodes;

/**
 * Interface AbstractForm
 * @package RealPress\Shortcodes
 */
interface RenderAble {
	/**
	 * @param $atts
	 *
	 * @return string
	 */
	public function render( $atts ) : string;
}
