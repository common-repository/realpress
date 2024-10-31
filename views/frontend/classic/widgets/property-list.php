<?php

use RealPress\Helpers\Price;
use RealPress\Models\PropertyModel;
use RealPress\Helpers\General;

if ( ! isset( $property_id ) ) {
	if ( is_singular( REALPRESS_PROPERTY_CPT ) ) {
		$property_id = get_the_ID();
	} else {
		return;
	}
}
$meta_data        = get_post_meta( $property_id, REALPRESS_PROPERTY_META_KEY, true );
$types            = PropertyModel::get_property_terms( $property_id, 'realpress-type' );
$price            = $meta_data['group:information:section:general:fields:price'];
$text_after_price = $meta_data['group:information:section:general:fields:text_after_price'];
$formatted_price  = Price::get_formatted_price( $price );
$image_url        = get_the_post_thumbnail_url( $property_id, 'realpress-custom-size-675x468' );
if ( empty( $image_url ) ) {
	$image_url = General::get_image_place_holder();
}
$address_name = $meta_data['group:map:section:map:fields:name'];
?>
<div class="realpress-property-item">
	<div class="realpress-property-item-post-thumbnail">
		<a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url_raw( $image_url ); ?>"
												 alt="<?php echo get_the_title( $property_id ); ?>"></a>
	</div>
	<div class="realpress-property-content">
		<div class="realpress-property-item-title">
			<a href="<?php echo get_the_permalink( $property_id ); ?>">
				<?php echo get_the_title( $property_id ); ?>
			</a>
		</div>
		<div class="realpress-property-item-price">
			<span class="realpress-formated-price"><?php echo esc_html( $formatted_price ); ?></span>&nbsp;<span
					class="realpress-text-after-price"><?php echo esc_html( $text_after_price ); ?></span>
		</div>
		<div class="realpress-property-item-address">
			<span><?php echo esc_html( $address_name ); ?></span>
		</div>
		<?php
		if ( ! empty( $types ) ) {
			$type = reset( $types );
			?>
			<div class="realpress-property-item-type">
				<a href="<?php echo get_term_link( $type->term_id ); ?>"><?php echo esc_html( $type->name ); ?></a>
			</div>
			<?php
		}
		?>
	</div>
</div>
