<?php

use RealPress\Helpers\Validation;

$value = Validation::sanitize_params_submitted( $_GET['status'] ?? '' );
?>
	<div class="realpress-search-field">
		<select name="status" class="realpress-select2">
			<option value=""><?php esc_html_e( 'Select Status...', 'realpress' ); ?></option>
			<?php
			$terms = get_terms(
				array(
					'taxonomy'   => 'realpress-status',
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


