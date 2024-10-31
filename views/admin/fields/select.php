<?php
/**
 * Template Field type Select
 * @version 1.0.0
 */

use RealPress\Helpers\General;

/**
 * @var $field Select
 */
if ( ! isset( $field ) ) {
	return;
}

$select2  = $field->is_select2 ? 'realpress-select2' : '';
$multiple = $field->is_multiple ? 'multiple' : '';
$name     = $field->is_multiple ? $field->name . '[]' : $field->name;
$class    = $field->class;
?>
<div class="<?php echo esc_attr( ltrim( $class . ' ' . 'realpress-field-wrapper realpress-select-wrapper' ) ); ?>">
	<?php
	if ( ! empty( $field->title ) ) {
		?>
		<div class="realpress-title-wrapper">
			<label for="<?php echo esc_attr( $field->id ); ?>"><?php echo esc_html( $field->title ); ?></label>
		</div>
		<?php
	}
	?>
	<div class="realpress-select-content">
		<?php
		if ( $multiple ) {
			?>
			<input type="hidden" name="<?php echo esc_attr( $field->name ); ?>">
			<?php
		}
		?>
		<select name="<?php echo esc_attr( $name ); ?>" id="<?php echo esc_attr( $field->id ); ?>"
				class="<?php echo esc_attr( $select2 ); ?>"
			<?php echo esc_attr( $multiple ); ?>>
			<?php

			foreach ( $field->options as $option => $name ) :
				$select_attr = $field->is_multiple ? selected( in_array( $option, $field->value ) ) : selected( $option, $field->value );
				?>
				<option value="<?php echo esc_attr( $option ); ?>" <?php echo esc_attr( $select_attr ); ?>>
					<?php echo esc_html( $name ); ?>
				</option>
			<?php endforeach; ?>
		</select>
		<?php
		if ( ! empty( $field->description ) ) {
			?>
			<p><?php echo General::ksesHTML( $field->description ); ?></p>
			<?php
		}
		?>
	</div>
</div>
