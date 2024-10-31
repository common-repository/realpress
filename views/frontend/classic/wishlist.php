<?php

use RealPress\Helpers\Template;

if ( ! wp_is_block_theme() ) {
	get_header();
}

Template::instance()->get_frontend_template_type_classic( 'wishlist/content.php' );
if ( ! wp_is_block_theme() ) {
	get_footer();
}
