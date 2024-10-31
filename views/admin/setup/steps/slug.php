<?php

use RealPress\Helpers\Config;
use RealPress\Helpers\Settings;

?>
	<div class="realpress-setup-heading realpress-heading-slug">
		<h2><?php esc_html_e( 'Slug Settings', 'realpress' ); ?></h2>
	</div>

	<div class="realpress-setup-form-field">
		<?php
		$slug_fields = Config::instance()->get( 'realpress-setting:group:slug:fields' );
		foreach ( $slug_fields as $field_name => $field_args ) {
			$name                = 'group:slug:fields:' . $field_name;
			$field_args['value'] = Settings::get_setting_detail( $name ) ?? '';
			$field_args['name']  = REALPRESS_OPTION_KEY . '[' . $name . ']';
			$field_args['type']->set_args( $field_args )->render();
		}
		?>
	</div>
<?php
