<?php

use RealPress\Helpers\Price;

if ( ! isset( $data ) ) {
	return;
}
$price            = Price::get_formatted_price( $data['price'] );
$text_after_price = $data['text_after_price'];
?>
<div class="realpress-property-price">
	<span class="realpress-formated-price"><?php echo esc_html( $price ); ?></span>&nbsp;<span class="realpress-text-after-price"><?php echo esc_html( $text_after_price ); ?></span>
</div>
