<?php

use RealPress\Helpers\Template;

if ( ! isset( $data ) ) {
	return;
}
?>
<div class="realpress-features-section">
	<h2><?php esc_html_e( 'Featured', 'realpress' ); ?></h2>
	<?php
	Template::instance()->get_frontend_template_type_classic( 'shared/single-property/features.php', compact( 'data' ) );
	?>
</div>

