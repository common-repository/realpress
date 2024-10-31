<?php
if ( ! isset( $data ) ) {
	return;
}

$area_size         = $data['area_size'];
$area_size_postfix = $data['area_size_postfix'];
?>
<div class="realpress-area-size"><?php echo esc_html( $area_size . ' ' . $area_size_postfix ); ?></div>
