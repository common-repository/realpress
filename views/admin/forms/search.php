<?php
if ( ! isset( $field ) ) {
	return;
}
?>
	<div class="<?php echo esc_attr( $field->class ); ?>">
		<?php
		if ( ! empty( $field->title ) ) {
			?>
			<div class="realpress-title-wrapper">
				<label for="<?php echo esc_attr( $field->id ); ?>"><?php echo esc_html( $field->title ); ?></label>
			</div>
			<?php
		}
		?>
		<div class="realpress-search-content">
			<input type="text" id="<?php echo esc_attr( $field->id ); ?>" class="realpress-search-input"
				   name="<?php echo esc_attr( $field->name ); ?>" value="<?php echo esc_attr( $field->value ); ?>"
				   placeholder="<?php echo esc_attr( $field->place_holder ); ?>"/>
			<button type="button" class="realpress-search-button"><i class="dashicons dashicons-search"></i></button>
			<?php
			if ( ! empty( $field->description ) ) {
				?>
				<p><?php echo esc_html( $field->description ); ?></p>
				<?php
			}
			?>
		</div>
	</div>
<?php
