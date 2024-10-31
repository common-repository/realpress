<?php
if ( ! isset( $data ) ) {
	return;
}
?>
<div class="realpress-agent-detail-about">
	<h3><?php printf( esc_html__( 'About %s', 'realpress' ), $data['display_name'] ); ?></h3>
	<p><?php echo esc_html( $data['description'] ); ?></p>
</div>
