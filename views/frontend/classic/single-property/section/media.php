<?php

use RealPress\Helpers\Template;

if ( ! isset( $data ) ) {
	return;
}
$template = Template::instance();

if ( empty( $data['gallery'] ) && ( empty( $data['lat_lon']['lat'] ) || empty( $data['lat_lon']['lon'] ) ) && empty( $data['vr_video'] ) ) {
	return;
}

?>
	<div class="realpress-property-media">
		<?php
		$template->get_frontend_template_type_classic( 'shared/single-property/contact-form.php', compact( 'data' ) );
		?>
		<div class="realpress-media-navigation-wrapper">
			<ul class="realpress-media-navigation">
				<?php
				if ( ! empty( $data['gallery'] ) ) {
					?>
					<li class="nav-item" data-item="realpress-gallery-panel">
						<i class="fas fa-image"></i>
					</li>
					<?php
				}
				if ( ! empty( $data['lat_lon']['lat'] && ! empty( $data['lat_lon']['lon'] ) ) && ! empty( $data['map_enable'] ) ) {
					?>
					<li class="nav-item" data-item="realpress-map-panel">
						<i class="fas fa-map"></i>
					</li>
					<?php
				}
				if ( ! empty( $data['vr_video'] ) ) {
					?>
					<li class="nav-item" data-item="realpress-virtual-tour-panel">
						<i class="fas fa-street-view"></i>
					</li>
					<?php
				}
				?>
			</ul>
		</div>
		<!-- Panels-->
		<div class="realpress-media-panel-wrapper">
			<?php
			if ( ! empty( $data['gallery'] ) ) {
				?>
				<div class="panel-item" id="realpress-gallery-panel">
					<?php
					$template->get_frontend_template_type_classic( 'shared/single-property/gallery.php', compact( 'data' ) );
					?>
				</div>
				<?php
			}
			if ( ! empty( $data['lat_lon']['lat'] && ! empty( $data['lat_lon']['lon'] ) ) && ! empty( $data['map_enable'] ) ) {
				?>
				<div class="panel-item" id="realpress-map-panel">
					<?php
					$template->get_frontend_template_type_classic( 'shared/single-property/map.php', compact( 'data' ) );
					?>
				</div>
				<?php
			}
			if ( ! empty( $data['vr_video'] ) ) {
				?>
				<div class="panel-item" id="realpress-virtual-tour-panel">
					<?php
					$template->get_frontend_template_type_classic( 'shared/single-property/virtual-tour.php', compact( 'data' ) );
					?>
				</div>
				<?php
			}
			?>
		</div>
	</div>
<?php
