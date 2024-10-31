<?php
if ( ! isset( $data ) ) {
	return;
}
$rooms = $data['rooms'];
?>
<div class="realpress-rooms">
	<?php echo esc_html( $rooms ); ?>
</div>

