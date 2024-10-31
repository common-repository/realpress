<?php

namespace RealPress\Register;

use RealPress\Helpers\Config;

class Widgets {
	public function __construct() {
		add_action( 'widgets_init', array( $this, 'register_sidebars' ) );
	}

	public function register_sidebars() {
		$sidebars = Config::instance()->get( 'sidebars', 'widgets' );

		if ( ! empty( $sidebars ) ) {
			foreach ( $sidebars as $sidebar ) {
				register_sidebar( $sidebar );
			}
		}

		$files = glob( REALPRESS_DIR . 'app/Widgets/*.php' );
		foreach ( $files as $file ) {
			require_once $file;

			$file_names = explode( '/', $file );
			$file_name  = end( $file_names );
			$file_name  = str_replace( '.php', '', $file_name );
			$class_name = 'RealPress\Widgets\\' . $file_name;
			register_widget( $class_name );
		}
	}
}

