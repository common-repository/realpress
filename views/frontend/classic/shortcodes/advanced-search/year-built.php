<?php

use RealPress\Helpers\Validation;

$value = Validation::sanitize_params_submitted( $_GET['year_built'] ?? '' );
?>
<div class="realpress-search-field">
	<input name="year_built" type="number" min="0" value="<?php echo esc_attr( $value ); ?>"
		   placeholder="<?php esc_attr_e( 'Year Built', 'realpress' ); ?>">
</div>
