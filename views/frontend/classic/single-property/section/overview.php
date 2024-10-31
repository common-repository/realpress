<?php

use RealPress\Helpers\Template;

if ( ! isset( $data ) ) {
	return;
}

$template = Template::instance();
?>
<div class="realpress-overview-section">
	<h2><?php esc_html_e( 'Overview', 'realpress' ); ?></h2>
	<div class="realpress-overview">
		<div class="realpress-property-overview-data">
			<?php
			$overviews = array(
				array(
					'key'   => 'property-id',
					'title' => esc_html__( 'Property ID', 'realpress' ),
				),
				array(
					'key'   => 'area-size',
					'title' => esc_html__( 'Area Size', 'realpress' ),
				),
				array(
					'key'   => 'land-area-size',
					'title' => esc_html__( 'Land Area Size', 'realpress' ),
				),
				array(
					'key'   => 'rooms',
					'title' => esc_html__( 'Rooms', 'realpress' ),
				),
				array(
					'key'   => 'bathrooms',
					'title' => esc_html__( 'Bathrooms', 'realpress' ),
				),
				array(
					'key'   => 'bedrooms',
					'title' => esc_html__( 'Bedrooms', 'realpress' ),
				),
				array(
					'key'   => 'year-built',
					'title' => esc_html__( 'Year Built', 'realpress' ),
				),
			);

			foreach ( $overviews as $overview ) {
				?>
				<div>
					<div class="realpress-overview-title">
						<?php echo esc_html( $overview['title'] ); ?>
					</div>
					<?php
					$template->get_frontend_template_type_classic(
						'shared/single-property/' . $overview['key'] . '.php',
						compact( 'data' )
					);
					?>
				</div>
				<?php
			}
			?>
		</div>
	</div>
</div>
