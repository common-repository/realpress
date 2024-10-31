<?php
if ( ! isset( $field ) ) {
	return;
}

use RealPress\Helpers\General;

$field->value = ( empty( $field->value ) ) ? $field->default : $field->value;
?>
	<div class="<?php echo esc_attr( ltrim( $field->class . ' ' . 'realpress-field-wrapper realpress-radio-button-wrapper' ) ); ?>">
		<?php
		if ( ! empty( $field->title ) ) {
			?>
			<div class="realpress-title-wrapper">
				<?php echo esc_html( $field->title ); ?>
			</div>
			<?php
		}
		?>
		<div class="realpress-radio-button-content-wrapper">
			<?php
			foreach ( $field->options as $option_value => $option_args ) {
				?>

				<div class="realpress-radio-button-content">
					<input type="radio" name="<?php echo esc_attr( $field->name ); ?>"
						   id="<?php echo esc_attr( $option_args['id'] ); ?>"
						   value="<?php echo esc_attr( $option_value ); ?>"
						<?php checked( $field->value, $option_value ); ?>>
					<label for="<?php echo esc_attr( $option_args['id'] ); ?>"><?php echo esc_html( $option_args['label'] ); ?></label>
					<?php
					if ( ! empty( $option_args['description'] ) ) {
						?>
						<p><?php echo esc_html( $option_args['description'] ); ?></p>
						<?php
					}
					?>
				</div>
				<?php
			}
			?>
		</div>
		<?php
		if ( ! empty( $field->description ) ) {
			?>
			<p><?php echo General::ksesHTML( $field->description ); ?></p>
			<?php
		}
		?>
	</div>
<?php
