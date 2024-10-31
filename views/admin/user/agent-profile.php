<?php

use RealPress\Helpers\Fields\AbstractField;

if ( ! isset( $config ) || ! isset( $data ) ) {
	return;
}
wp_nonce_field( 'realpress_admin_user_profile_action', 'realpress_admin_user_profile_name' );
foreach ( $config as $group_name => $group_args ) {
	if ( isset( $group_args['title'] ) ) { ?>
		<h2><?php echo esc_html( $group_args['title'] ); ?></h2>
		<?php
	}

	$fields = $group_args['fields'];

	foreach ( $fields as $field_name => $field_args ) {
		if ( $field_args['type'] instanceof AbstractField ) {
			$name                = $group_name . ':fields:' . $field_name;
			$field_args['value'] = $data[ $name ] ?? '';
			$field_args['name']  = REALPRESS_USER_META_KEY . '[' . $name . ']';
			$field_args['type']->set_args( $field_args )->render();
		}
	}
}