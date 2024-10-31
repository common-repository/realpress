<?php

use RealPress\Helpers\General;

if ( ! isset( $data ) ) {
	return;
}

$vr_video = $data['vr_video'];

if ( empty( $vr_video ) ) {
	return;
}
?>
<div class="realpress-vr-360">
	<?php echo General::ksesHTML( $vr_video ); ?>
</div>
