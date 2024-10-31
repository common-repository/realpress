<?php

use RealPress\Helpers\Template;

if ( ! isset( $data ) ) {
	return;
}
$locations = $data['locations'];
if ( empty( $locations ) ) {
	$term_list = '';
} else {
	$term_names = array();
	foreach ( $locations as $term ) {
		$term_names[] = $term->name;
	}
	$term_list = implode( ',', $term_names );
}
?>
<div class="realpress-address-location-section">
	<h2><?php esc_html_e( 'Address', 'realpress' ); ?></h2>
	<div class="realpress-address-location">
		<div class="realpress-address">
			<span class="realpress-address-location-label"><?php esc_html_e( 'Address', 'realpress' ); ?></span>
			<?php
			Template::instance()->get_frontend_template_type_classic(
				'shared/single-property/address.php',
				compact( 'data' )
			);
			?>
		</div>
		<div class="realpress-location">
			<span class="realpress-address-location-label"><?php esc_html_e( 'Location', 'realpress' ); ?></span>
			<span><?php echo esc_html( $term_list ); ?></span>
		</div>
	</div>
</div>
