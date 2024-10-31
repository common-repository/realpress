<?php

use RealPress\Helpers\Template;

$template = Template::instance();
?>
	<section id="realpress-header-map">
		<div id="realpress-hm-map-area">
		</div>
		<div class="realpress-container">
			<div class="row">
				<div id="realpress-hm-property-area">
					<div class="realpress-list-item-control-group">
						<h2><?php esc_html_e( 'Properties', 'realpress' ); ?></h2>
						<?php
						$template->get_frontend_template_type_classic( 'shared/property-sort.php' );
						?>
						<ul class="realpress-item-switch-view">
							<li data-grid-col="1"><i class="far fa-square"></i></li>
							<li data-grid-col="3"><i class="fas fa-columns"></i></li>
						</ul>
					</div>
					<div class="realpress-property-container" data-grid-col="1">
						<div class="realpress-wave-loading">

						</div>
					</div>
					<div class="realpress-hm-pagination-wrapper">
						<div class="realpress-hm-from-to">

						</div>
						<div class="realpress-hm-pagination">
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
<?php
