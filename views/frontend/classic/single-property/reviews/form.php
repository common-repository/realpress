<?php
if ( ! isset( $data ) ) {
	return;
}

if ( is_user_logged_in() ) {
	?>
	<div class="realpress-review-form-title">
		<span><?php esc_html_e( 'Leave a review', 'realpress' ); ?></span>
	</div>
	<form>
		<div class="realpress-form-message"></div>
		<div class="realpress-review-form-field">
			<label for="realpress-review-rating"><?php esc_html_e( 'Rating', 'realpress' ); ?></label>
			<select id="realpress-review-rating">
				<option value="1"><?php esc_html_e( '1 Star - Poor', 'realpress' ); ?></option>
				<option value="2"><?php esc_html_e( '2 Star - Fair', 'realpress' ); ?></option>
				<option value="3"><?php esc_html_e( '3 Star - Average', 'realpress' ); ?></option>
				<option value="4"><?php esc_html_e( '4 Star - Good', 'realpress' ); ?></option>
				<option value="5"
						selected="selected"><?php esc_html_e( '5 Star - Excellent', 'realpress' ); ?></option>
			</select>
		</div>
		<div class="realpress-review-form-field">
			<label for="realpress-review-content"><?php esc_html_e( 'Review *', 'realpress' ); ?></label>
			<textarea id="realpress-review-content" rows="4"
					  placeholder="<?php esc_attr_e( 'Write a review', 'realpress' ); ?>"></textarea>
		</div>
		<button type="submit" id="realpress-submit-review">
			<?php
			esc_html_e( 'Submit Review', 'realpress' );
			?>
		</button>
	</form>
	<?php
} else {
	?>
	<div class="realpress-review-login-waring">
		<?php
		global $wp;
		$current_slug = add_query_arg( array(), $wp->request ) . '#realpress-property-review-form';
		printf(
			__( 'You need to login in order to post a review. Please click <a href="%s">here</a> to login', 'realpress' ),
			wp_login_url( $current_slug )
		);
		?>
	</div>
	<?php
}
