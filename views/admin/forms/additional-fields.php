<?php
if ( ! isset( $field ) ) {
	return;
}
$data        = $field->data;
$fields      = $field->fields;
$field_value = empty( $data[ $field->name ] ) ? array() : $data[ $field->name ];
$field_count = count( $field_value );
?>
	<div class="<?php echo esc_attr( ltrim( $field->class . ' ' . 'realpress-additional-fields' ) ); ?>">
		<?php
		if ( ! empty( $field->title ) ) {
			?>
			<div class="realpress-additional-fields-title"><?php echo esc_html( $field->title ); ?></div>
			<?php
		}
		?>

		<table class="realpress-additional-fields-table">
			<thead>
			<tr>
				<th class="realpress-sort"></th>
				<?php
				foreach ( $fields as $field_name => $field_args ) {
					?>
					<th>
						<?php
						if ( ! empty( $field_args['title'] ) ) {
							echo esc_html( $field_args['title'] );
						}
						?>
					</th>
					<?php
				}
				?>
				<th class="realpress-remove"></th>
			</tr>
			</thead>
			<tbody>
			<tr class=realpress-additional-item-template>
				<td class="realpress-sort">
					<span><i class="dashicons dashicons-menu"></i></span>
				</td>
				<?php
				foreach ( $fields as $field_name => $field_args ) {
					$field_args['name']  = $field->key . '[' . $field->name . ']' . '[0][' . $field_name . ']';
					$field_args['value'] = '';
					unset( $field_args['title'] );
					?>
					<td class="realpress-additional-element">
						<?php
						$field_args['type']->set_args( $field_args )->render();
						?>
					</td>
					<?php
				}
				?>
				<td class="realpress-remove">
					<i class="dashicons dashicons-dismiss"></i>
				</td>
			</tr>
			<?php for ( $i = 0; $i < $field_count; $i ++ ) : ?>
				<tr>
					<td class="realpress-sort">
						<span><i class="dashicons dashicons-menu"></i></span>
					</td>
					<?php
					foreach ( $fields as $field_name => $field_args ) {
						$field_args['name']  = $field->key . '[' . $field->name . '][' . $i . '][' . $field_name . ']';
						$field_args['value'] = $field_value[ $i ][ $field_name ] ?? '';
						unset( $field_args['title'] );
						?>
						<td class="realpress-additional-element">
							<?php
							$field_args['type']->set_args( $field_args )->render();
							?>
						</td>
						<?php
					}
					?>
					<td class="realpress-remove">
						<i class="dashicons dashicons-dismiss"></i>
					</td>
				</tr>
			<?php endfor; ?>
			</tbody>
		</table>
		<?php
		if ( ! empty( $field->description ) ) {
			?>
			<p><?php echo esc_html( $field->description ); ?></p>
			<?php
		}
		?>
		<p class="realpress-additional-add-more">
			<button type="button"
					class="button button-secondary add-more"><?php esc_html_e( '+ Add more', 'realpress' ); ?></button>
		</p>
	</div>
<?php
