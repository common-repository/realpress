<?php

use RealPress\Helpers\Validation;

$value = Validation::sanitize_params_submitted( $_GET['rooms'] ?? '' );
?>
	<div class="realpress-search-field">
		<input name="rooms" type="number" min="0" value="<?php echo esc_attr( $value ); ?>"
			   placeholder="<?php esc_attr_e( 'Rooms', 'realpress' ); ?>">
	</div>
<?php
