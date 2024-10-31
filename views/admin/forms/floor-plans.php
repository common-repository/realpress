<?php
if ( ! isset( $field ) ) {
	return;
}
$data        = $field->data;
$fields      = $field->fields;
$value       = empty( $data[ $field->name ] ) ? array() : $data[ $field->name ];
$panel_count = count( $value );
?>
	<div class="<?php echo esc_attr( ltrim( $field->class . ' ' . 'realpress-field-wrapper' ) ); ?>">
		<div class="realpress-field-panel-inner">
			<div class="realpress-field-panel realpress-field-panel-template">
				<div class="realpress-field-panel-title">
					<span class="realpress-field-panel-title-text"><?php esc_html_e( 'New Plan Title', 'realpress' ); ?></span>
					<span class="realpress-button-remove"><i class="dashicons dashicons-no-alt"></i></span>
					<span class="realpress-button-toggle"><i class="dashicons dashicons-minus"></i></span>
				</div>
				<div class="realpress-field-panel-content">
					<?php
					foreach ( $fields as $field_name => $field_args ) {
						$field_args['name']   = $field->key . '[' . $field->name . '][0][' . $field_name . ']';
						$field_args ['value'] = '';
						$field_args['id']     = str_replace( 'realpress_', '', $field->id . '_0_' . $field_args['id'] );
						$field_args['type']->set_args( $field_args )->render();
					}
					?>
				</div>
			</div>
			<?php
			for ( $i = 0; $i < $panel_count; $i ++ ) {
				?>
				<div class="realpress-field-panel">
					<div class="realpress-field-panel-title">
						<?php
						$plan_title = $value[ $i ][ array_key_first( $fields ) ];
						?>
						<span class="realpress-field-panel-title-text"><?php echo esc_html( $plan_title ); ?></span>
						<span class="realpress-button-remove"><i class="dashicons dashicons-no-alt"></i></span>
						<span class="realpress-button-toggle"><i class="dashicons dashicons-minus"></i></span>
					</div>
					<div class="realpress-field-panel-content">
						<?php
						foreach ( $fields as $field_name => $field_args ) {
							$field_args['name']   = $field->key . '[' . $field->name . '][' . $i . '][' . $field_name . ']';
							$field_args ['value'] = $value[ $i ][ $field_name ];
							$field_args['id']     = $field->id . '_' . $i . '_' . $field_args['id'];
							$field_args['type']->set_args( $field_args )->render();
						}
						?>
					</div>
				</div>
				<?php
			}
			?>
		</div>
		<button class="button button-secondary add-more"
				type="button"><?php esc_html_e( '+ Add more', 'realpress' ); ?></button>
		<?php
		if ( ! empty( $field->description ) ) {
			?>
			<p><?php echo esc_html( $field->description ); ?></p>
			<?php
		}
		?>
	</div>
<?php
