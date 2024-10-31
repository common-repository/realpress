<?php
if ( ! isset( $field ) ) {
	return;
}

use RealPress\Helpers\General;

$required = $field->required ? ' required' : '';
?>

<div class="<?php echo esc_attr( ltrim( $field->class . ' ' . 'realpress-field-wrapper realpress-input-number-wrapper' ) ); ?>">
	<?php
	if ( ! empty( $field->title ) ) {
		?>
		<div class="realpress-title-wrapper">
			<label for="<?php echo esc_attr( $field->id ); ?>"><?php echo esc_html( $field->title ); ?></label>
		</div>
		<?php
	}
	?>
	<div class="realpress-input-content">
		<input type="number" id="<?php echo esc_attr( $field->id ); ?>"
			   name="<?php echo esc_attr( $field->name ); ?>" value="<?php echo esc_attr( $field->value ); ?>"
			   min="<?php echo esc_attr( $field->min ); ?>" max="<?php echo esc_attr( $field->max ); ?>"
			<?php echo esc_attr( $required ); ?>
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
