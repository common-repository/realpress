<?php

use RealPress\Helpers\Validation;

$value = Validation::sanitize_params_submitted( $_GET['location'] ?? '' );
?>
	<div class="realpress-search-field">
		<select name="location" class="realpress-select2">
			<option value=""><?php esc_html_e( 'Select Location...', 'realpress' ); ?></option>
			<?php
			$terms = get_terms(
				array(
					'taxonomy'   => 'realpress-location',
					'hide_empty' => true,
					'number'     => 0,
				)
			);
			if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
				foreach ( $terms as $term ) {
					?>
					<option value="<?php echo esc_attr( $term->term_id ); ?>" <?php selected( $term->term_id, $value ); ?>><?php echo esc_html( $term->name ); ?></option>
					<?php
				}
			}
			?>
		</select>
	</div>
<?php



