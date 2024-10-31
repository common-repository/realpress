<?php

use RealPress\Helpers\Config;

if ( ! isset( $field ) ) {
	return;
}

$custom_taxonomies = array_keys( Config::instance()->get( 'property-type:taxonomies' ) );

if ( empty( $custom_taxonomies ) ) {
	return;
}
$taxonomy_count = count( $custom_taxonomies );
for ( $i = 0; $i <= $taxonomy_count; $i = $i + 3 ) {
	$taxonomies = array_slice( $custom_taxonomies, $i, 3 );
	if ( ! empty( $taxonomies ) ) {
		foreach ( $taxonomies as $taxonomy_slug ) {
			$taxonomy_details = get_taxonomy( $taxonomy_slug );
			?>
			<div class="<?php echo esc_attr( $field->class ); ?>">
				<div class="realpress-header-wrapper">
					<h2><?php echo esc_html( $taxonomy_details->label ); ?></h2>
				</div>
				<div class="realpress-taxonomy-content" data-taxonomy="<?php echo esc_attr( $taxonomy_slug ); ?>">
					<div class="realpress-add-taxonomy-filter">
						<div class="realpress-search-content">
							<input type="text" class="realpress-search-input"
								   placeholder="<?php esc_attr_e( 'Search...', 'realpress' ); ?>">
							<button type="button" class="realpress-search-button">
								<i class="dashicons dashicons-search"></i></button>
						</div>
					</div>
					<div class="realpress-add-taxonomy-term-list"></div>
				</div>
				<?php
				$add_taxonomy_link = add_query_arg(
					array(
						'taxonomy'  => $taxonomy_slug,
						'post_type' => REALPRESS_PROPERTY_CPT,
					),
					admin_url( 'edit-tags.php' )
				);
				?>
				<div id="<?php echo esc_attr( $taxonomy_slug . '-loading' ); ?>"
					 class="realpress-add-taxonomy-loading"></div>
				<?php
				if ( in_array( $taxonomy_slug, array( 'realpress-status', 'realpress-energy-class' ) ) ) {
					?>
					<div class="realpress-taxonomy-subtext"><?php printf( esc_html__( 'You only select one %s', 'realpress' ), $taxonomy_details->label ); ?></div>
					<?php
				}
				?>
				<?php
				if ( current_user_can( 'administrator' ) ) {
					?>
					<div class="realpress-add-taxonomy-new-term">
						<a href="<?php echo esc_url_raw( $add_taxonomy_link ); ?>" target="_blank">
							<?php printf( esc_html__( 'Add new %s', 'realpress' ), $taxonomy_details->label ); ?>
						</a>
					</div>
					<?php
				}
				?>
			</div>
			<?php
		}
	}
}
