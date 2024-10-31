<?php

use RealPress\Helpers\Validation;

$orderby = Validation::sanitize_params_submitted( $_GET['orderby'] ?? '' );
$order   = Validation::sanitize_params_submitted( $_GET['order'] ?? '' );
$value   = 'name_asc';
if ( $orderby === 'display_name' && $order === 'DESC' ) {
	$value = 'name_desc';
}
?>
	<div class="realpress-sort-by">
		<select>
			<option value="name_asc"
				<?php selected( 'name_asc', $value ); ?>><?php esc_html_e( 'Name (A->Z)', 'realpress' ); ?></option>
			<option value="name_desc" <?php selected( 'name_desc', $value ); ?>><?php esc_html_e( 'Name (Z->A)', 'realpress' ); ?></option>
		</select>
	</div>
<?php
