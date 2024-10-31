<?php

use RealPress\Helpers\Validation;

$orderby = Validation::sanitize_params_submitted( $_GET['orderby'] ?? '' );
$order   = Validation::sanitize_params_submitted( $_GET['order'] ?? '' );
$value   = 'default';
if ( $orderby === 'title' ) {
	if ( $order === 'ASC' ) {
		$value = 'name_asc';
	} elseif ( $order === 'DESC' ) {
		$value = 'name_desc';
	}
} elseif ( $orderby === 'price' ) {
	if ( $order === 'ASC' ) {
		$value = 'price_asc';
	} elseif ( $order === 'DESC' ) {
		$value = 'price_desc';
	}
} elseif ( $orderby === 'rating' ) {
	if ( $order === 'ASC' ) {
		$value = 'rating_asc';
	} elseif ( $order === 'DESC' ) {
		$value = 'rating_desc';
	}
}
?>
<div class="realpress-sort-by">
	<select>
		<option value="default" <?php selected( 'default', $value ); ?>><?php esc_html_e( 'Default Order', 'realpress' ); ?></option>
		<option value="name_asc" <?php selected( 'name_asc', $value ); ?>><?php esc_html_e( 'Name (A->Z)', 'realpress' ); ?></option>
		<option value="name_desc" <?php selected( 'name_desc', $value ); ?>><?php esc_html_e( 'Name (Z->A)', 'realpress' ); ?></option>
		<option value="price_desc" <?php selected( 'price_desc', $value ); ?>><?php esc_html_e( 'Price (High to Low)', 'realpress' ); ?></option>
		<option value="price_asc" <?php selected( 'price_asc', $value ); ?>><?php esc_html_e( 'Price (Low to High)', 'realpress' ); ?></option>
		<option value="rating_desc" <?php selected( 'rating_desc', $value ); ?>><?php esc_html_e( 'Rating (High to Low)', 'realpress' ); ?></option>
		<option value="rating_asc" <?php selected( 'rating_asc', $value ); ?>><?php esc_html_e( 'Rating (Low to High)', 'realpress' ); ?></option>
	</select>
</div>
