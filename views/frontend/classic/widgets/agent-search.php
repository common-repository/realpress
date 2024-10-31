<?php

use RealPress\Helpers\Validation;

$name_value         = Validation::sanitize_params_submitted( $_GET['display_name'] ?? '' );
$company_name_value = Validation::sanitize_params_submitted( $_GET['company_name'] ?? '' );
?>
<div class="realpress-agent-search">
	<input class="realpress-agent-search-name" type="text" name="display_name" value="<?php echo esc_attr( $name_value ); ?>"
		   placeholder="<?php esc_attr_e( 'Enter Agent name', 'realpress' ); ?>">
	<input class="realpress-agent-search-company-name" type="text"
		   name="company_name" value="<?php echo esc_attr( $company_name_value ); ?>"
		   placeholder="<?php esc_attr_e( 'Enter Agent company name', 'realpress' ); ?>">
	<button type="button"><?php esc_html_e( 'Search Agent', 'realpress' ); ?></button>
</div>

