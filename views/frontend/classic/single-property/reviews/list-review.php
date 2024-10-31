<?php

use RealPress\Models\UserModel;
use RealPress\Helpers\Template;

if ( ! isset( $comment ) ) {
	return;
}
$template = Template::instance();

$review_id       = $comment->comment_ID;
$user_id         = $comment->user_id;
$display_name    = get_the_author_meta( 'display_name', $user_id );
$avatar          = UserModel::get_user_avatar( $user_id );
$review_metadata = get_comment_meta( $comment->comment_ID, REALPRESS_PROPERTY_REVIEW_META_KEY, true );

$data = array(
	'time'   => strtotime( $comment->comment_date ),
	'rating' => $review_metadata['fields:review_stars'],
);
?>
<li>
	<div class="realpress-review-image">
		<img src="<?php echo esc_url_raw( $avatar ); ?>" alt="<?php echo esc_attr( $display_name ); ?>">
	</div>
	<div class="realpress-review-message">
		<div class="realpress-posted-by-rating-group">
			<div class="realpress-posted-by">
				<?php esc_html_e( 'Posted by ', 'realpress' ); ?>
				<a href="<?php echo get_author_posts_url( $user_id ); ?>"><?php echo esc_html( $display_name ); ?></a>
			</div>
			<?php $template->get_frontend_template_type_classic( 'shared/reviews/rating.php', compact( 'data' ) ); ?>
		</div>
		<div class="realpress-review-date">
			<?php $template->get_frontend_template_type_classic( 'shared/date.php', compact( 'data' ) ); ?>
		</div>
		<div class="realpress-review-description">
			<?php echo esc_html( $comment->comment_content ); ?>
		</div>
	</div>
</li>
