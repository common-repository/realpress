<?php

use RealPress\Helpers\Settings;
use RealPress\Helpers\Config;
use RealPress\Helpers\YelpNearBy;
use RealPress\Helpers\Template;

if ( ! isset( $data ) ) {
	return;
}

$enable = Settings::get_setting_detail( 'group:yelp_nearby:fields:enable' );

if ( empty( $enable ) ) {
	return;
}

$lat_lon            = $data['lat_lon'];
$yelp_categories    = Settings::get_setting_detail( 'group:yelp_nearby:fields:category' );
$yelp_category_data = Config::instance()->get( 'yelp-category' );

if ( empty( $yelp_categories ) ) {
	return;
}

$unit = Settings::get_setting_detail( 'group:yelp_nearby:fields:distance_unit' );
?>
<div class="realpress-yelp-nearby-section">
	<h2><?php esc_html_e( 'What\'s NearBy' ); ?></h2>
	<div class="realpress-yelp-near-by">
		<?php
		foreach ( $yelp_categories as $category ) {
			$term       = $yelp_category_data[ $category ]['name'];
			$icon       = $yelp_category_data[ $category ]['icon'];
			$fetch_data = YelpNearBy::get_data( $term, $lat_lon );

			if ( $fetch_data['status'] === 'error' ) {
				?>
				<div class="realpress-yelp-nearby-error"><?php echo esc_html( $fetch_data['msg'] ); ?></div>
				<?php
			} else {
				$data = $fetch_data['data'];

				if ( empty( $data->businesses ) ) {
					continue;
				}
				$businesses = $data->businesses;
				?>
				<div class="realpress-yelp-nearby-term-icon">
					<i class="<?php echo esc_attr( $icon ); ?>"></i> <?php echo esc_html( $term ); ?>
				</div>

				<?php
				foreach ( $businesses as $business ) {
					?>
					<div class="realpress-yelp-nearby-item">
						<div class="realpress-yelp-nearby-left">
							<?php
							echo esc_html( $business->name );
							if ( isset( $data->region->center ) && isset( $business->coordinates ) ) {
								$current_lat = $data->region->center->latitude;
								$current_lon = $data->region->center->longitude;

								$location_lat = $business->coordinates->latitude;
								$location_lon = $business->coordinates->longitude;
								$distance     = YelpNearBy::get_distance( $location_lat, $location_lon, $current_lat, $current_lon, $unit );
								?>
								<span class="realpress-yelp-nearby-distance"> <?php printf( esc_html__( '( %1$s %2$s )', 'realpress' ), round( $distance, 2 ), $unit ); ?></span>
								<?php
							}
							?>
						</div>
						<div class="realpress-yelp-nearby-right">
							<?php
							Template::instance()->get_frontend_template_type_classic(
								'shared/reviews/rating.php',
								array(
									'data' => array(
										'rating'   => $business->rating,
										'is_label' => true,
									),
								)
							);
							?>
							<span><?php printf( esc_html__( '%d reviews', 'realpress' ), $business->review_count ); ?></span>
						</div>
					</div>
					<?php
				}
			}
		}
		?>
	</div>
</div>




