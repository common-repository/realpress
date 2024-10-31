<?php

use RealPress\Helpers\Template;

if ( ! isset( $data ) ) {
	return;
}
?>
<div class="realpress-description-section">
	<h2><?php esc_html_e( 'Description', 'realpress' ); ?></h2>
	<?php
	Template::instance()->get_frontend_template_type_classic( 'shared/single-property/description.php', compact( 'data' ) );
	?>
</div>


