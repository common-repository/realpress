<?php

use RealPress\Helpers\Validation;

$value = Validation::sanitize_params_submitted( $_GET['keyword'] ?? '' );
?>
<div class="realpress-search-field full-width">
	<input name="keyword" type="text" value="<?php echo esc_attr( $value ); ?>"
		   placeholder="<?php esc_attr_e( 'Enter your keyword here...', 'realpress' ); ?>">
</div>
