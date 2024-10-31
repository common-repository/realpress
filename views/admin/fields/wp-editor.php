<?php
if ( ! isset( $field ) ) {
	return;
}

$settings = array(
	'textarea_name' => $field->name,
);
?>
	<div class="<?php echo esc_attr( ltrim( $field->class . ' ' . 'realpress-field-wrapper realpress-wp-editor-wrapper' ) ); ?>">
		<?php
		if ( ! empty( $field->title ) ) {
			?>
			<div class="realpress-title-wrapper">
				<?php echo esc_html( $field->title ); ?>
			</div>
			<?php
		}
		?>
		<div class="realpress-wp-editor-content">
			<?php
			wp_editor( $field->value, $field->id, $settings );
			if ( ! empty( $field->description ) ) {
				?>
				<p><?php echo esc_html( $field->description ); ?></p>
				<?php
			}
			?>
		</div>
	</div>
<?php
