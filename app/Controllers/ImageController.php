<?php

namespace RealPress\Controllers;

/**
 * ImageController
 */
class ImageController {
	public function __construct() {
		add_action( 'init', array( $this, 'add_image_sizes' ) );
	}

	/**
	 * @return void
	 */
	public function add_image_sizes() {
		add_image_size( 'realpress-custom-size-675x468', 675, 468, true );
	}
}
