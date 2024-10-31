<?php

namespace RealPress\Helpers;

/**
 * Class Walkscore
 * @package RealPress\Helpers
 */
class Walkscore {
	public static function display_widget( string $walkscore_data = '' ) {
		if ( empty( $walkscore_data ) ) {
			return;
		}
		wp_enqueue_script( 'realpress-walkscore', 'https://www.walkscore.com/tile/show-walkscore-tile.php', array(), null, true );
		wp_add_inline_script( 'realpress-walkscore', $walkscore_data, 'before' );
	}
}

