<?php
if ( ! isset( $data ) ) {
	return;
}

$land_area_size         = $data['land_area_size'];
$land_area_size_postfix = $data['land_area_size_postfix'];

?>
<div class="realpress-landarea-size"><?php echo esc_html( $land_area_size . ' ' . $land_area_size_postfix ); ?></div>

