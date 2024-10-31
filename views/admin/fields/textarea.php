<?php
if ( ! isset( $field ) ) {
	return;
}

use RealPress\Helpers\General;

?>
	<div class="<?php echo esc_attr( ltrim( $field->class . ' ' . 'realpress-field-wrapper realpress-textarea-wrapper' ) ); ?>">
		<?php
		if ( ! empty( $field->title ) ) {
			?>
			<div class="realpress-title-wrapper">
				<label for="<?php echo esc_attr( $field->id ); ?>"><?php echo esc_html( $field->title ); ?></label>
			</div>
			<?php
		}
		?>
		<div class="realpress-textarea-content">
				<textarea type="text" id="<?php echo esc_attr( $field->id ); ?>" class="widefat"
						  name="<?php echo esc_attr( $field->name ); ?>"
						  <?php echo empty( $field->placeholder ) ? '' : 'placeholder = "' . esc_attr( $field->placeholder ) . '"'; ?>
						  rows="<?php echo esc_attr( $field->rows ); ?>"><?php echo esc_textarea( $field->value ); ?></textarea>
			<?php
			if ( ! empty( $field->description ) ) {
				?>
				<p><?php echo General::ksesHTML( $field->description ); ?></p>
				<?php
			}
			?>
		</div>
	</div>
<?php
