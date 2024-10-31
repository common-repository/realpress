<?php

use RealPress\Helpers\General;

if ( ! isset( $data ) ) {
	return;
}

$video = $data['video'];

if ( empty( $video ) ) {
	return;
}
?>
<div class="realpress-video">
	<?php echo General::ksesHTML( $video ); ?>
</div>

