<?php

use RealPress\Helpers\Template;

if ( ! isset( $data ) ) {
	return;
}

?>
<div class="realpress-detail-section">
	<h2><?php esc_html_e( 'Details', 'realpress' ); ?></h2>
	<div class="realpress-detail">
		<?php
		$details = array(
			array(
				'key'   => 'price',
				'title' => esc_html__( 'Price', 'realpress' ),
			),
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
				'key'   => 'bedrooms',
				'title' => esc_html__( 'Bedrooms', 'realpress' ),
			),
			array(
				'key'   => 'year-built',
				'title' => esc_html__( 'Year Built', 'realpress' ),
			),
		);

		foreach ( $details as $detail ) {
			?>
			<div>
				<div class="realpress-detail-title">
					<?php echo esc_html( $detail['title'] ); ?>
				</div>
				<?php
				Template::instance()->get_frontend_template_type_classic(
					'shared/single-property/' . $detail['key'] . '.php',
					compact( 'data' )
				);
				?>
			</div>
			<?php
		}
		$additional_details = $data['additional_details'];
		if ( ! empty( $additional_details ) ) {
			foreach ( $additional_details as $additional_detail ) {
				?>
				<div>
					<div class="realpress-additional-detail-label realpress-detail-title">
						<?php echo esc_html( $additional_detail['label'] ); ?>
					</div>
					<div class="realpress-additional-detail-value">
						<?php echo esc_html( $additional_detail['value'] ); ?>
					</div>
				</div>
				<?php
			}
		}
		?>
	</div>
</div>
