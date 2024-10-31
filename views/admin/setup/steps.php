<?php
if ( ! isset( $steps ) ) {
	return;
}

use RealPress\Helpers\Validation;

$current_step = Validation::sanitize_params_submitted( $_GET['step'] ?? '' );
?>
<ul class="realpress-setup-steps">
	<?php
	foreach ( $steps as $step_key => $step ) {
		$class = '';
		if ( $step_key === $current_step ) {
			$class = 'active';
		} elseif ( array_search( $current_step, array_keys( $steps ), true ) > array_search( $step_key, array_keys( $steps ), true ) ) {
			$class = 'done';
		}

		?>
		<li class="<?php echo esc_attr( $class ); ?>"><?php echo esc_html( $step['title'] ); ?></li>
		<?php
	}
	?>
</ul>

