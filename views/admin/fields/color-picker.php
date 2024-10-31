<?php
if ( ! isset( $field ) ) {
	return;
}

use RealPress\Helpers\General;

?>
<div class="<?php echo esc_attr( ltrim( $field->class . ' ' . 'realpress-field-wrapper' ) ); ?>">
	<?php
	if ( ! empty( $field->title ) ) {
		?>
		<div class="realpress-title-wrapper">
			<label for="<?php echo esc_attr( $field->id ); ?>"><?php echo esc_html( $field->title ); ?></label>
		</div>
		<?php
	}
	?>
	<div class="realpress-color-picker">
		<input type="text" data-jscolor="" id="<?php echo esc_attr( $field->id ); ?>"
			   name="<?php echo esc_attr( $field->name ); ?>"
			   value="<?php echo esc_attr( $field->value ?? '' ); ?>"
			<?php echo empty( $field->pattern ) ? '' : 'pattern = "' . esc_attr( $field->pattern ) . '"'; ?>
		/>
		<?php
		if ( ! empty( $field->description ) ) {
			?>
			<p><?php echo General::ksesHTML( $field->description ); ?></p>
			<?php
		}
		?>
	</div>
</div>
