<?php

use RealPress\Helpers\Template;

if ( ! isset( $data ) ) {
	return;
}

?>
<div class="realpress-video-section">
	<h2><?php esc_html_e( 'Video', 'realpress' ); ?></h2>
	<?php Template::instance()->get_frontend_template_type_classic( 'shared/single-property/video.php', compact( 'data' ) ); ?>
</div>
