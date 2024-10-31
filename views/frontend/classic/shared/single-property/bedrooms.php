<?php
if ( ! isset( $data ) ) {
	return;
}

$bedroom = $data['bedrooms'];
?>
<div class="realpress-bedrooms"><?php echo esc_html( $bedroom ); ?></div>
