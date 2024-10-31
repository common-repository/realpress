<?php
if ( ! isset( $field ) ) {
	return;
}
$fields = $field->fields;
$data   = $field->data;
?>
	<div class="realpress-map-search">
		<div class="realpress-map-search-box">
			<div class="realpress-map-search-box-input">
				<input type=text placeholder="<?php esc_attr_e( 'Search...', 'realpress' ); ?>">
			</div>
			<div class="realpress-map-search-box-button">
				<button class="button" type="button"><?php esc_html_e( 'Go', 'realpress' ); ?></button>
			</div>
		</div>
		<div class="realpress-map-search-result-header">
			<span><?php esc_html_e( 'Search Result', 'realpress' ); ?></span>
			<a><i class="dashicons dashicons-no-alt"></i></span></a>
		</div>
		<div class="realpress-map-search-result-wrapper">
			<ul class="realpress-map-search-result-list">
			</ul>
			<div class="realpress-map-search-load-more">
				<button type="button"
						class="button load-more"> <?php esc_html_e( 'Add more results', 'realpress' ); ?></button>
			</div>
		</div>
		<div class="realpress-map-search-loading-wrapper">
		</div>
	</div>
	<div class="<?php echo esc_attr( ltrim( $field->class . ' ' . 'realpress_map-fields' ) ); ?> ">
		<div id="<?php echo esc_attr( 'realpress_' . $field->map_id ); ?>"></div>
		<?php
		foreach ( $fields as $field_name => $field_args ) {
			$name                = $field->name . ':fields:' . $field_name;
			$field_args['name']  = $field->key . '[' . $name . ']';
			$field_args['value'] = $data[ $name ] ?? '';
			$field_args['type']->set_args( $field_args )->render();
		}
		if ( ! empty( $field->description ) ) {
			?>
			<p><?php echo esc_html( $field->description ); ?></p>
			<?php
		}
		?>
	</div>
<?php
