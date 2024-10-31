<?php

use RealPress\Helpers\Price;

if ( ! isset( $data ) ) {
	return;
}
$floor_plans = $data['floor_plans'];
if ( empty( $floor_plans ) ) {
	return;
}
?>
<div class="realpress-floor-plan-section">
    <h2><?php esc_html_e( 'Floor Plans', 'realpress' ); ?></h2>
    <div class="realpress-property-floor-plan">
		<?php
		$floor_plan_number = count( $floor_plans );
		for ( $i = 0; $i < $floor_plan_number; $i ++ ) {
			$price           = $floor_plans[ $i ]['price'];
			$formatted_price = Price::get_formatted_price( $price );
			?>
            <div class="realpress-floor-plan-inner">
                <div class="realpress-floor-heading">
                    <div>
                        <i class="fas fa-angle-down"></i>
                        <div class="realpress-floor-plan-title">
							<?php echo esc_html( $floor_plans[ $i ]['title'] ); ?>
                        </div>
                    </div>
                    <ul>
                        <li>
							<?php esc_html_e( 'Size', 'realpress' ); ?>:
                            <strong> <?php echo esc_html( $floor_plans[ $i ]['size'] ); ?></strong>
                        </li>
                        <li>
							<?php esc_html_e( 'Bedrooms', 'realpress' ); ?>:
                            <strong><?php echo esc_html( $floor_plans[ $i ]['bedrooms'] ); ?></strong>
                        </li>
                        <li>
							<?php esc_html_e( 'Bathrooms', 'realpress' ); ?>:
                            <strong><?php echo esc_html( $floor_plans[ $i ]['bathrooms'] ); ?></strong>
                        </li>
                        <li>
							<?php esc_html_e( 'Price', 'realpress' ); ?>:
                            <strong><?php echo esc_html( $formatted_price ); ?></strong>
                        </li>
                    </ul>
                </div>
                <div class="realpress-floor-dropdown">
                    <div>
                        <img src="<?php echo esc_url_raw( $floor_plans[ $i ]['image']['image_url'] ); ?>"
                             alt="<?php echo esc_attr( $floor_plans[ $i ]['title'] ); ?>">
                    </div>
                    <div>
                        <p><strong><?php esc_html_e( 'Description', 'realpress' ); ?>:</strong><br>
							<?php
							echo esc_html( $floor_plans[ $i ]['description'] );
							?>
                        </p>
                    </div>
                </div>
            </div>
			<?php
		}
		?>
    </div>
</div>
