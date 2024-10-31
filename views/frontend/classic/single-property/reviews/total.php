<?php
if ( ! isset( $data ) ) {
	return;
}
$review_total = $data['review_total'];
?>
<div>
	<?php
	if ( empty( $review_total ) ) {
		esc_html_e( 'No Reviews', 'realpress' );
	} else {
		printf( esc_html( _n( '%s Review', '%s Reviews', $review_total, 'realpress' ) ), $review_total );
	}
	?>
</div>
