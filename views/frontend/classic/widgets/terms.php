<?php
if ( ! isset( $term_args ) ) {
	return;
}
$args  = wp_parse_args( $term_args, array( 'hide_empty' => false ) );
$terms = get_terms( $args );
if ( empty( $terms ) || is_wp_error( $terms ) ) {
	return;
}

?>
<ul class="realpress-term-widget">
	<?php
	foreach ( $terms as $term ) {
		?>
		<li class="realpress-term-list-widget">
			<div><a href="<?php echo get_term_link( $term->term_id ); ?>"><?php echo esc_html( $term->name ); ?></a>
			</div>
			<div><?php echo esc_html( $term->count ); ?></div>
		</li>
		<?php
	}
	?>
</ul>
