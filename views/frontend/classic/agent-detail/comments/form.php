<?php
if ( ! isset( $data ) ) {
	return;
}

if ( is_user_logged_in() ) {
	?>
	<div class="realpress-comment-form-title">
		<span><?php esc_html_e( 'Leave a comment', 'realpress' ); ?></span>
	</div>
	<form>
		<div class="realpress-form-message"></div>
		<div class="realpress-comment-form-field">
			<label for="realpress-comment-content"><?php esc_html_e( 'Comment *', 'realpress' ); ?></label>
			<textarea id="realpress-comment-content" rows="4"
					  placeholder="<?php esc_attr_e( 'Write a comment', 'realpress' ); ?>"></textarea>
		</div>
		<button type="submit" id="realpress-submit-comment">
			<?php
			esc_html_e( 'Post comment', 'realpress' );
			?>
		</button>
	</form>
	<?php
} else {
	?>
	<div class="realpress-comment-login-waring">
		<?php
		global $wp;
		$current_slug = add_query_arg( array(), $wp->request ) . '#realpress-comment-scroll';
		printf(
			__( 'You need to login in order to post a comment. Please click <a href="%s">here</a> to login', 'realpress' ),
			wp_login_url( $current_slug )
		);
		?>
	</div>
	<?php
}
