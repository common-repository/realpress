<?php

use RealPress\Models\UserModel;
use RealPress\Helpers\Template;

if ( ! isset( $comment ) ) {
	return;
}
$template = Template::instance();

$comment_id   = $comment->comment_ID;
$user_id      = $comment->user_id;
$display_name = get_the_author_meta( 'display_name', $user_id );
$avatar       = UserModel::get_user_avatar( $user_id );
$data         = array(
	'time' => strtotime( $comment->comment_date ),
);
?>
<li>
    <div class="realpress-comment-image">
        <img src="<?php echo esc_url_raw( $avatar ); ?>" alt="<?php echo esc_attr( $display_name ); ?>">
    </div>
    <div class="realpress-comment-message">
        <div class="realpress-posted-by">
			<?php esc_html_e( 'Posted by ', 'realpress' ); ?>
            <a href="<?php echo esc_url_raw( get_author_posts_url( $user_id ) ); ?>"><?php echo esc_html( $display_name ); ?></a>
        </div>
        <div class="realpress-review-date">
			<?php $template->get_frontend_template_type_classic( 'shared/date.php', compact( 'data' ) ); ?>
        </div>
        <div class="realpress-review-description">
			<?php echo esc_html( $comment->comment_content ); ?>
        </div>
    </div>
</li>
