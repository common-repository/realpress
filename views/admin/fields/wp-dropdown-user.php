<?php
if ( ! isset( $field ) ) {
	return;
}

use RealPress\Helpers\General;

$args = $field->args;
if ( ! empty( $field->name ) ) {
	$args['name'] = $field->name;
}

if ( ! empty( $field->value ) ) {
	$args['selected'] = $field->value;
}
?>
	<div class="<?php echo esc_attr( ltrim( $field->class . ' ' . 'realpress-field-wrapper realpress-wp-dropdown-user-wrapper' ) ); ?>">
		<?php
		if ( ! empty( $field->title ) ) {
			?>
			<div class="realpress-title-wrapper">
				<label for="<?php echo esc_attr( $field->id ); ?>"><?php echo esc_html( $field->title ); ?></label>
			</div>
			<?php
		}
		?>
		<div class="realpress-wp-dropdown-user-content">
			<?php
			wp_dropdown_users( $args );
			if ( ! empty( $field->description ) ) {
				?>
				<p><?php echo General::ksesHTML( $field->description ); ?></p>
				<?php
			}
			?>
		</div>
	</div>
<?php
