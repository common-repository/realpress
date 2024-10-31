<?php

use RealPress\Helpers\Template;

if ( ! wp_is_block_theme() ) {
	get_header();
}

Template::instance()->get_frontend_template_type_classic( 'archive-property/content.php' );
if ( ! wp_is_block_theme() ) {
	get_footer();
}
