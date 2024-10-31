<?php

use RealPress\Helpers\Validation;

$value = Validation::sanitize_params_submitted( $_GET['bathrooms'] ?? '' );
?>
	<div class="realpress-search-field">
		<input name="bathrooms" type="number" min="0" value="<?php echo esc_attr( $value ); ?>"
			   placeholder="<?php esc_attr_e( 'Bathrooms', 'realpress' ); ?>">
	</div>
<?php

