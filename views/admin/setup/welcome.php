<?php
if ( ! isset( $steps ) ) {
	return;
}
?>
<div class="realpress-setup-welcome">
	<h2><?php _e( 'Welcome to RealPress', 'realpress' ); ?></h2>

	<p class="heading"><?php esc_html_e( 'Thanks for using RealPress!', 'realpress' ); ?></p>

	<p class="sub-title"><?php esc_html_e( 'The following wizard will help you configure site and get you started quickly.', 'realpress' ); ?></p>
	<?php
	$first_step_url = add_query_arg(
		array(
			'page' => 'realpress-setup',
			'step' => array_key_first( $steps ),
		),
		admin_url( 'index.php' )
	);
	?>
	<a href="<?php echo esc_url_raw( $first_step_url ); ?>"><?php esc_html_e( 'Let\'s Start', 'realpress' ); ?></a>
	<button type="submit" name="skip_setup"
			value="1"><?php esc_html_e( 'Skip Setup Wizard', 'realpress' ); ?></button>
</div>
