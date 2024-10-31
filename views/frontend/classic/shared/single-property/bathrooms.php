<?php
if ( ! isset( $data ) ) {
	return;
}

$bathrooms = $data['bathrooms'];
?>
<div class="realpress-bathrooms"><?php echo esc_html( $bathrooms ); ?></div>
