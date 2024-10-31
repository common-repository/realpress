<?php

use RealPress\Helpers\Template;

if ( ! isset( $data ) ) {
	return;
}

$average_ratings = $data['rating'];
$review_total    = $data['review_total'];
$template        = Template::instance();

?>
<div class="realpress-property-review-wrap">
	<!-- Header-->
	<div class="realpress-property-review-header">
		<?php
		$template->get_frontend_template_type_classic( 'single-property/reviews/total.php', compact( 'data' ) );
		$template->get_frontend_template_type_classic( 'shared/reviews/rating.php', compact( 'data' ) );
		if ( ! empty( $average_ratings ) ) {
			?>
			<div><?php printf( esc_html__( '(%s out of 5)', 'realpress' ), $average_ratings ); ?></div>
			<?php
		}
		if ( ! empty( $review_total ) ) {
			$template->get_frontend_template_type_classic( 'single-property/reviews/sort-by.php' );
		}

		if ( is_user_logged_in() ) {
			?>
			<a href="#realpress-property-review-form"><?php esc_html_e( 'Leave a Review', 'realpress' ); ?></a>
			<?php
		}
		?>

	</div>
	<!-- List reviews   -->
	<?php
	if ( ! empty( $review_total ) ) {
		?>
		<ul class="realpress-reviews-container">
			<li class="realpress-wave-loading"></li>
		</ul>
		<?php
	}
	?>

	<!--Pagination-->
	<div class="realpress-review-pagination-wrap">
	</div>

	<div id="realpress-property-review-form">
		<?php
		$template->get_frontend_template_type_classic( 'single-property/reviews/form.php', compact( 'data' ) );
		?>
	</div>
</div>
