<?php

use RealPress\Helpers\Config;
use RealPress\Helpers\Settings;

?>
<div class="realpress-setup-heading">
    <h2><?php esc_html_e( 'Static Pages', 'realpress' ); ?></h2>
    <p><?php esc_html_e( 'The pages will display content of RealPress necessary pages, such as: Agent List, Become an Agent', 'realpress' ); ?></p>
</div>
<div class="realpress-setup-form-field realpress-page-setting">
    <button id ="realpress-create-all-pages" class="button"><?php esc_html_e( 'Create all static pages', 'realpress' ) ?></button>
	<?php
	$page_fields = Config::instance()->get( 'realpress-setting:group:page:fields' );
	foreach ( $page_fields as $field_name => $field_args ) {
		$name                = 'group:page:fields:' . $field_name;
		$field_args['value'] = Settings::get_setting_detail( $name ) ?? '';
		$field_args['name']  = REALPRESS_OPTION_KEY . '[' . $name . ']';
		$field_args['type']->set_args( $field_args )->render();
	}
	?>
</div>
