<?php
/**
 * The template for displaying single posts and pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

use RealPress\Helpers\Template;

if ( ! wp_is_block_theme() ) {
	get_header();
}
if ( have_posts() ) {
	while ( have_posts() ) {
		the_post();
		Template::instance()->get_frontend_template_type_classic( 'single-property/content.php' );
	}
}
get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php
if ( ! wp_is_block_theme() ) {
	get_footer();
}
