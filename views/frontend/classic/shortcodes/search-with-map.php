<?php

use RealPress\Helpers\Template;

$template = Template::instance();
?>
	<div id="realpress-search-with-map">
		<section id="realpress-map-property-wrapper">
			<div id="realpress-swm-map-area">
			</div>
			<div id="realpress-swm-proprerty-area">
				<div id="realpress-search-nav" class="realpress-search-nav-sticky">
					<?php echo do_shortcode( esc_html('[realpress_advanced_search]') ); ?>
				</div>
				<div class="realpress-list-item-control-group">
					<h2><?php esc_html_e( 'Properties', 'realpress' ); ?></h2>
					<?php
					$template->get_frontend_template_type_classic( 'shared/property-sort.php' );
					?>
					<ul class="realpress-item-switch-view">
						<li data-grid-col="1"><i class="far fa-square"></i></li>
						<li data-grid-col="2"><i class="fas fa-columns"></i></li>
					</ul>
				</div>
				<div class="realpress-property-container" data-grid-col="1">
					<div class="realpress-wave-loading">
					</div>
				</div>

				<div class="realpress-swm-pagination-wrapper">
					<div class="realpress-swm-from-to">
					</div>
					<div class="realpress-swm-pagination">
					</div>
				</div>
			</div>
		</section>
	</div>
<?php
