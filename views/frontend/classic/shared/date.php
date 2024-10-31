<?php
if ( ! isset( $data ) ) {
	return;
}
$time   = $data['time'];
$period = human_time_diff( $time, current_time( 'timestamp' ) );

?>
<div>
	<?php
	echo esc_html( $period . ' ago' );
	?>
</div>
