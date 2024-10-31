<?php

use RealPress\Helpers\Settings;
use RealPress\Helpers\Walkscore;

if ( ! isset( $data ) ) {
	return;
}
$address          = $data['address_name'];
$walkscore_enable = Settings::get_setting_detail( 'group:walk_score:fields:enable' );

if ( empty( $walkscore_enable ) ) {
	return;
}
$api_key = Settings::get_setting_detail( 'group:walk_score:fields:api' );

if ( empty( $api_key ) ) {
	return;
}
?>
	<div class="realpress-walkscore-section">
		<h2><?php esc_html_e( 'Walkscore', 'realpress' ); ?></h2>
		<div class="realpress-walkscore">
			<div id="ws-walkscore-tile"></div>
		</div>
	</div>
<?php
$walkscore_data = "var ws_wsid    = '" . esc_html( $api_key ) . "';
				 var ws_address = '" . esc_html( $address ) . "';
				 var ws_format  = 'wide';
				 var ws_width   = '650';
				 var ws_width   = '100%';
				 var ws_height  = '400';";
Walkscore::display_widget( $walkscore_data );
