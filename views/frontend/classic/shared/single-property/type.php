<?php

if ( ! isset( $data ) ) {
	return;
}
$type       = get_taxonomy( 'realpress-type' );
$type_terms = $data['types'];
if ( empty( $type_terms ) ) {
	$term_list = '';
} else {
	$term_names = array();
	foreach ( $type_terms as $term ) {
		$term_names[] = $term->name;
	}
	$term_list = implode( ',', $term_names );
}
?>
	<div class="realpress-type">
		<?php echo esc_html( $term_list ); ?>
	</div>
<?php
