<?php

use RealPress\Helpers\Template;
use RealPress\Helpers\Validation;

if ( ! isset( $args ) ) {
	return;
}

$steps          = $args['steps'];
$current_step   = $args['current_step'];
$prev_step_link = $args['prev_step_link'];
$next_step_link = $args['next_step_link'];
$step_slugs     = array_keys( $steps );
$first_step     = array_key_first( $steps );
//$last_step      = array_key_last( $steps );
?>


	<form id="realpress-setup-form" class="realpress-setup-content" name="realpress-setup" method="post">
		<?php wp_nonce_field( 'realpress_setup_wizard_action', 'realpress_setup_wizard_name' ); ?>
		<input type="hidden" name="realpress-setup-step"
			   value="<?php echo esc_attr( $current_step ); ?>">
		<?php
		if ( empty( Validation::sanitize_params_submitted( $_GET['step'] ?? '' ) ) ) {
			Template::instance()->get_admin_template( 'setup/welcome.php', compact( 'steps' ) );
		} else {
			Template::instance()->get_admin_template( 'setup/steps/' . $current_step . '.php' );
			?>
			<div class="realpress-setup-control-buttons">
				<?php
				if ( ! empty( $prev_step_link ) ) {
					?>
					<a class="button-prev" href="<?php echo esc_url_raw( $prev_step_link ); ?>">
						<?php esc_html_e( 'Previous', 'realpress' ); ?>
					</a>
					<?php
				}
				if ( ! empty( $next_step_link ) ) {
					?>
					<a class="realpress-setup-skip"
					   href="<?php echo esc_url_raw( $next_step_link ); ?>">
						<?php esc_html_e( 'Skip this step', ' realpress' ); ?>
					</a>
					<button type="submit" name="save_step" value="1"
							class="button button-next button-primary"><?php esc_html_e( 'Continue', 'realpress' ); ?></button>
					<?php
				}
				?>
			</div>
			<?php
		}
		?>
	</form>
<?php

