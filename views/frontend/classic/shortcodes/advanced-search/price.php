<?php

use RealPress\Helpers\Settings;
use RealPress\Helpers\Price;

$min_price           = Settings::get_setting_detail( 'group:advanced_search:fields:min_price' );
$min_formatted_price = Price::get_formatted_price( $min_price );
$max_price           = Settings::get_setting_detail( 'group:advanced_search:fields:max_price' );
$max_formatted_price = Price::get_formatted_price( $max_price );
if ( ! is_numeric( $min_price ) || ! is_numeric( $max_price ) ) {
	return;
}
?>
<div class="realpress-search-field realpress-range-slider">
	<span><?php esc_html_e( 'Price', 'realpress' ); ?></span>
	<input type="hidden" id="realpress-search-input-min-price" name="min-price">
	<input type="hidden" id="realpress-search-input-max-price" name="max-price">
	<div id="realpress-search-price"></div>
	<span><?php printf( esc_html__( '%1$s-%2$s', 'realpress' ), $min_formatted_price, $max_formatted_price ); ?></span>
</div>
