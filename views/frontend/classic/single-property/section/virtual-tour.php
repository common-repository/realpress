<?php

use RealPress\Helpers\Template;

if ( ! isset( $data ) ) {
	return;
}

?>
<div class="realpress-virtual-tour-section">
	<h2><?php esc_html_e( '360 Virtual Tour', 'realpress' ); ?></h2>
	<?php Template::instance()->get_frontend_template_type_classic( 'shared/single-property/virtual-tour.php', compact( 'data' ) ); ?>
</div>
