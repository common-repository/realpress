<?php

use RealPress\Helpers\Settings;

?>
	<div id="realpress-become-an-agent">
		<div>
			<?php
			if ( ! is_user_logged_in() ) {
				?>
				<div class="realpress-warning">
					<?php
					global $wp;
					$current_slug = add_query_arg( array(), $wp->request );
					printf( __( 'Please <a href="%s">login</a> to send your request!', 'realpress' ), wp_login_url( $current_slug ) );
					?>
				</div>
				<?php
			} else {
				?>
				<div class="realpress-become-an-agent-container">
					<div>
						<?php
						if ( current_user_can( 'edit_realpress-properties' ) ) {
							esc_html_e( 'You are an Agent!', 'realpress' );
						} elseif ( get_user_meta( get_current_user_id(), REALPRESS_PREFIX . '_become_an_agent_request', true ) === 'yes' ) {
							esc_html_e( 'Your have already sent the request. Please wait for approvement.', 'realpress' );
						} else {
							?>
							<form action="#">
								<label>
									<?php esc_html_e( 'First Name *', 'realpress' ); ?>
									<input type="text" name="realpress-baa-firstname"
										   placeholder="<?php esc_attr_e( 'First name', 'realpress' ); ?>">
								</label>
								<label>
									<?php esc_html_e( 'Last Name *', 'realpress' ); ?>
									<input type="text" name="realpress-baa-lastname"
										   placeholder="<?php esc_attr_e( 'Last name', 'realpress' ); ?>">
								</label>
								<label>
									<?php esc_html_e( 'Agency Name', 'realpress' ); ?>
									<input type="text" name="realpress-baa-agencyname"
										   placeholder="<?php esc_attr_e( 'Agency name', 'realpress' ); ?>">
								</label>
								<label>
									<?php esc_html_e( 'Phone Number *', 'realpress' ); ?>
									<input type="text" name="realpress-baa-phonenumber"
										   placeholder="<?php esc_attr_e( 'Phone Number', 'realpress' ); ?>">
								</label>
								<label>
									<?php esc_html_e( 'Additional Information', 'realpress' ); ?>
									<textarea name="realpress-baa-additional-information" cols="3" rows="3"
											  placeholder="<?php esc_attr_e( 'Additional Information', 'realpress' ); ?>"></textarea>
								</label>
								<?php
								$terms_and_conditions_page_id = Settings::get_page_id( 'terms_and_conditions_page' );
								?>
								<label class="realpress-baa-terms-and-conditions">
									<input type="checkbox" name="realpress-baa-terms-and-conditions">
									<?php
									printf(
										__( 'I agree to&nbsp;<a target="_blank" href="%s">Terms and Conditions</a>', 'realpress' ),
										get_permalink( $terms_and_conditions_page_id )
									);
									?>
								</label>
								<div class="realpress-baa-warning"></div>
								<button type="submit"><?php esc_html_e( 'Submit', 'realpress' ); ?></button>
							</form>
							<?php
						}
						?>
					</div>
				</div>
				<?php
			}
			?>
		</div>
	</div>
<?php
