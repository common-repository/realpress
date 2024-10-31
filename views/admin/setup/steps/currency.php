<?php

use RealPress\Helpers\Config;
use RealPress\Helpers\Settings;

?>
<div class="realpress-setup-heading">
	<h2><?php esc_html_e( 'Currency Settings', 'realpress' ); ?></h2>
</div>

<div class="realpress-setup-form-field">
	<?php
	$currency_fields = Config::instance()->get( 'realpress-setting:group:currency:fields' );
	foreach ( $currency_fields as $field_name => $field_args ) {
		$name                = 'group:currency:fields:' . $field_name;
		$field_args['value'] = Settings::get_setting_detail( $name ) ?? '';
		$field_args['name']  = REALPRESS_OPTION_KEY . '[' . $name . ']';
		$field_args['type']->set_args( $field_args )->render();
	}
	?>
</div>
