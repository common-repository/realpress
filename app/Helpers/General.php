<?php

namespace RealPress\Helpers;

class General {
	public static function get_image_place_holder() {
		return REALPRESS_ASSETS_URL . 'images/no-image.jpg';
	}

	public static function ksesHTML( $content ) {
		$allowed_html = wp_kses_allowed_html( 'post' );

		$allowed_html['iframe'] = array(
			'src'         => 1,
			'width'       => 1,
			'height'      => 1,
			'style'       => 1,
			'class'       => array( 'embed-responsive-item' ),
			'frameborder' => 1,
		);

		$allowed_html['input'] = array(
			'src'         => 1,
			'width'       => 1,
			'height'      => 1,
			'type'        => array(),
			'placeholder' => 1,
			'value'       => 1,
			'class'       => array( 'embed-responsive-item' ),
			'frameborder' => 1,
			'name'        => 1,
			'min'         => 1,
			'max'         => 1,
		);

		$allowed_html['form'] = array(
			'class' => 1,
			'style' => 1,
		);

		return wp_kses( wp_unslash( $content ), $allowed_html );
	}

}
