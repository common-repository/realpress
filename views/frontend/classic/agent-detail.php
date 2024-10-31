<?php

use RealPress\Helpers\Template;

if ( ! wp_is_block_theme() ) {
	get_header();
}

Template::instance()->get_frontend_template_type_classic( 'agent-detail/content.php' );

get_template_part( 'template-parts/footer-menus-widgets' );
if ( ! wp_is_block_theme() ) {
	get_footer();
}
