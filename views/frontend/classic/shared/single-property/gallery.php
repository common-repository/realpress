<?php
if ( ! isset( $data ) ) {
	return;
}

use RealPress\Helpers\Media;

$galleries = $data['gallery'];

if ( empty( $galleries ) ) {
	return;
} else {
	$galleries = explode( ',', $galleries );
}
?>
<div class="realpress-single-property-gallery">
	<div id="realpress-main-gallery" class="splide">
		<div class="splide__track">
			<ul class="splide__list">
				<?php
				foreach ( $galleries as $image_id ) {
					$image_url = wp_get_attachment_image_url( $image_id, 'large' );
					$alt_text  = Media::get_image_alt( $image_id );
					?>
					<li class="splide__slide">
						<img src="<?php echo esc_url_raw( $image_url ); ?>" alt="<?php echo esc_attr( $alt_text ); ?>"/>
					</li>
					<?php
				}
				?>
			</ul>
		</div>
	</div>

	<div id="realpress-thumbnail-gallery" class="splide">
		<div class="splide__track">
			<ul class="splide__list">
				<?php
				foreach ( $galleries as $image_id ) {
					$thumbnail_url = wp_get_attachment_image_url( $image_id, 'thumbnail' );
					$alt_text  = Media::get_image_alt( $image_id );
					?>
					<li class="splide__slide">
						<img src="<?php echo esc_url_raw( $thumbnail_url ); ?>" alt="<?php echo esc_attr( $alt_text ); ?>"/>
					</li>
					<?php
				}
				?>
			</ul>
		</div>
	</div>
</div>

