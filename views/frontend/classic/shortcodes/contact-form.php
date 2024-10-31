<?php

use RealPress\Models\UserModel;
use RealPress\Helpers\Settings;

if ( empty( $user_id ) ) {
	return;
}


if ( ! user_can( $user_id, 'edit_realpress-properties' ) ) {
	return '';
}
?>
<form class="realpress-contact-form">
	<?php
	$email = UserModel::get_field( $user_id, 'user_email' );
	?>
    <input type="hidden" name="email-target" value="<?php echo esc_attr( $email ); ?>">
    <div>
        <input type="text" name="name" placeholder="<?php esc_attr_e( 'Name', 'realpress' ); ?>">
    </div>
    <div>
        <input type="text" name="phone" placeholder="<?php esc_attr_e( 'Phone', 'realpress' ); ?>">
    </div>
    <div>
        <input type="text" name="email" placeholder="<?php esc_attr_e( 'Email', 'realpress' ); ?>">
    </div>
    <div>
        <textarea name="message" cols="30" rows="3"></textarea>
    </div>
    <div>
		<?php
		$terms_and_conditions_page_id = Settings::get_page_id( 'terms_and_conditions_page' );
		if ( ! empty( $terms_and_conditions_page_id ) ) {
			?>
            <label>
                <input type="checkbox" name="terms_and_conditions">
				<?php
				printf(
					__( 'I agree to&nbsp;<a target="_blank" href="%s">Terms and Conditions</a>', 'realpress' ),
					get_permalink( $terms_and_conditions_page_id )
				);
				?>
            </label>
			<?php
		}
		?>
    </div>
    <div class="realpress-message-result"></div>
    <div>
        <button type="button"
                class="realpress-send-message"><?php esc_html_e( 'Send Message', 'realpress' ); ?></button>
		<?php
		$user_meta_data = UserModel::get_user_meta_data( $user_id );
		$mobile_number  = $user_meta_data['user_profile:fields:mobile_number'];
		if ( ! empty( $mobile_number ) ) {
			?>
            <a href="tel:<?php echo esc_attr( $mobile_number ); ?>"><?php esc_html_e( 'Call', 'realpress' ); ?></a>
			<?php
		}
		?>
    </div>
</form>
