<?php

use RealPress\Models\PropertyModel;
use RealPress\Helpers\Price;
use RealPress\Models\TermModel;
use RealPress\Helpers\General;

$property_id       = get_the_ID();
$status            = PropertyModel::get_property_terms( $property_id, 'realpress-status' );
$price             = PropertyModel::get_price( $property_id );
$text_after_price  = PropertyModel::get_text_after_price( $property_id );
$formatted_price   = Price::get_formatted_price( $price );
$types             = PropertyModel::get_property_terms( $property_id, 'realpress-type' );
$labels            = PropertyModel::get_property_terms( $property_id, 'realpress-labels' );
$bedrooms          = PropertyModel::get_bedrooms( $property_id );
$bathrooms         = PropertyModel::get_bathrooms( $property_id );
$area_size         = PropertyModel::get_area_size( $property_id );
$area_size_postfix = PropertyModel::get_area_size_postfix( $property_id );
$excerpt           = PropertyModel::get_excerpt( $property_id );
$image_url         = get_the_post_thumbnail_url( $property_id, 'realpress-custom-size-675x468' );
if ( empty( $image_url ) ) {
	$image_url = General::get_image_place_holder();
}
?>
<div class="realpress-property-item">
	<div class="realpress-property-header">
		<?php
		if ( ! empty( $status ) ) {
			$status = $status[0];
			$color  = TermModel::get_meta_data( $status->term_id )['color'] ?? '';
			?>
			<div class="realpress-property-item-status">
				<a style="background-color:<?php echo esc_attr( $color ); ?>"
				   href="<?php echo get_term_link( $status->term_id ); ?>"><span><?php echo esc_html( $status->name ); ?></span></a>
			</div>
			<?php
		}
		?>
		<div class="realpress-property-item-post-thumbnail">
			<a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url_raw( $image_url ); ?>"
													 alt="<?php the_title(); ?>"></a>
		</div>
		<div class="realpress-property-item-price">
			<span class="realpress-formated-price"><?php echo esc_html( $formatted_price ); ?></span>&nbsp;<span
					class="realpress-text-after-price"><?php echo esc_html( $text_after_price ); ?></span>
		</div>
	</div>
	<div class="realpress-property-body">
		<div class="realpress-property-type-label-group">
			<div class="realpress-property-item-type">
				<?php
				foreach ( $types as $type ) {
					?>
					<a href="<?php echo get_term_link( $type->term_id ); ?>"><?php echo esc_html( $type->name ); ?></a>
					<?php
				}
				?>
			</div>
			<div class="realpress-property-item-label">
				<?php
				foreach ( $labels as $label ) {
					$color = TermModel::get_meta_data( $label->term_id )['color'] ?? '';
					?>
					<a style="background-color: <?php echo esc_attr( $color ); ?>"
					   href="<?php echo get_term_link( $label->term_id ); ?>"><?php echo esc_html( $label->name ); ?></a>
					<?php
				}
				?>
			</div>
		</div>
		<div class="realpress-property-item-title">
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</div>
		<?php
		if ( ! empty( $excerpt ) ) {
			?>
			<div class="realpress-property-item-excerpt">
				<?php echo esc_html( $excerpt ); ?>
			</div>
			<?php
		}
		?>
		<ul class="realpress-property-item-meta">
			<li class="realpress-property-item-bedrooms">
				<i class="fas fa-bed"></i>
				<?php
				if ( empty( $bedrooms ) ) {
					esc_html_e( 'No Bed', 'realpress' );
				} else {
					printf( esc_html( _n( '%s Bed', '%s Beds', $bedrooms, 'realpress' ) ), number_format_i18n( $bedrooms ) );
				}
				?>
			</li>
			<li class="realpress-property-item-bathrooms">
				<i class="fas fa-bath"></i>
				<?php
				if ( empty( $bathrooms ) ) {
					esc_html_e( 'No Bath', 'realpress' );
				} else {
					printf( esc_html( _n( '%s Bath', '%s Baths', $bathrooms, 'realpress' ) ), number_format_i18n( $bathrooms ) );
				}
				?>
			</li>
			<li class="realpress-property-item-area-size">
				<i class="fas fa-pencil-ruler"></i>
				<?php printf( esc_html__( '%1$s %2$s', 'realpress' ), $area_size_postfix, $area_size ); ?>
			</li>
		</ul>
	</div>
</div>
