<?php

use RealPress\Helpers\Settings;
use RealPress\Helpers\Template;

$advanced_search_enable = Settings::get_setting_detail( 'group:advanced_search:fields:enable' );

if ( empty( $advanced_search_enable ) ) {
	return;
}
$advanced_search = Settings::get_advanced_search();

if ( empty( $advanced_search ) ) {
	return;
}

$price = array_search( 'price', $advanced_search );
if ( $price !== false ) {
	unset( $advanced_search[ $price ] );
	$advanced_search = array_values( $advanced_search );
}

$taxonomy       = get_queried_object()->taxonomy ?? '';
$taxonomy_index = array_search( $taxonomy, $advanced_search );
if ( $taxonomy_index !== false ) {
	unset( $advanced_search[ $taxonomy_index ] );
	$advanced_search = array_values( $advanced_search );
}
$template = Template::instance();
?>
	<div class="realpress-advanced-search">
		<?php
		$displayed_fields = array_slice( $advanced_search, 0, 4 );
		$toggle_fields    = array_values( array_diff( $advanced_search, $displayed_fields ) );
		?>
		<div class="realpress-search-displayed-fields">
			<?php
			foreach ( $displayed_fields as $key ) {
				$key = str_replace( array( '_', 'realpress-' ), array( '-', '' ), $key );
				$template->get_frontend_template_type_classic( 'shortcodes/advanced-search/' . $key . '.php' );
			}
			?>
		</div>
		<?php
		if ( ! empty( $toggle_fields ) ) {
			?>
			<div class="realpress-search-toggle-fields">
				<?php
				foreach ( $toggle_fields as $key ) {
					$key = str_replace( array( '_', 'realpress-' ), array( '-', '' ), $key );
					$template->get_frontend_template_type_classic( 'shortcodes/advanced-search/' . $key . '.php' );
				}
				?>
			</div>
			<?php
		}
		?>
		<div class="realpress-price-search-control-group">
			<?php
			if ( $price !== false ) {
				$template->get_frontend_template_type_classic( 'shortcodes/advanced-search/price.php' );
			}
			$template->get_frontend_template_type_classic( 'shortcodes/advanced-search/button.php', compact( 'toggle_fields' ) );
			?>
		</div>
	</div>
<?php


