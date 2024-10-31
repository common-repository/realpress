<?php

use RealPress\Helpers\Template;

if ( ! isset( $data ) ) {
	return;
}
?>
<div class="realpress-energy-class-section">
	<h2><?php esc_html_e( 'Energy Class', 'realpress' ); ?></h2>
	<?php
	Template::instance()->get_frontend_template_type_classic( 'shared/single-property/energy-class.php', compact( 'data' ) );
	?>
</div>
