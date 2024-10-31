<?php

use RealPress\Helpers\Fields\AbstractField;

/**
 * Template Edit Review
 */
if ( ! isset( $config ) || ! isset( $data ) ) {
	return;
}
?>
<div class="realpress-review-meta-wrapper">
	<?php
	wp_nonce_field( 'realpress_admin_edit_review_action', 'realpress_admin_edit_review_name' );
	$fields = $config['fields'];
	foreach ( $fields as $field_name => $field_args ) {
		if ( isset( $field_args['type'] ) && $field_args['type'] instanceof AbstractField ) {
			$name                = 'fields:' . $field_name;
			$field_args['value'] = $data[ $name ] ?? '';
			$field_args['name']  = REALPRESS_PROPERTY_REVIEW_META_KEY . '[' . $name . ']';
			/**
			 * @var AbstractField
			 */
			$field_args['type']->set_args( $field_args )->render();
		}
	}
	?>
</div>
