<?php

use RealPress\Helpers\Template;

if ( ! isset( $data ) ) {
	return;
}
$template = Template::instance();
?>
<div class="realpress-single-property-header">
	<?php
	$template->get_frontend_template_type_classic( 'shared/single-property/title.php', compact( 'data' ) );
	?>
	<div class="realpress-property-header-left">
		<div class="realpress-group-status-rating">
			<?php
			$template->get_frontend_template_type_classic( 'shared/single-property/status.php', compact( 'data' ) );
			$template->get_frontend_template_type_classic( 'shared/reviews/rating.php', compact( 'data' ) );
			$template->get_frontend_template_type_classic( 'single-property/reviews/total.php', compact( 'data' ) );
			?>
		</div>
		<div class="realpress-group-address-date">
			<?php
			$template->get_frontend_template_type_classic( 'shared/single-property/address.php', compact( 'data' ) );
			$template->get_frontend_template_type_classic( 'shared/date.php', compact( 'data' ) );
			?>
		</div>
	</div>
	<div class="realpress-property-header-right">
		<?php
		$template->get_frontend_template_type_classic( 'shared/single-property/price.php', compact( 'data' ) );
		$template->get_frontend_template_type_classic( 'shared/single-property/area-size.php', compact( 'data' ) );
		$template->get_frontend_template_type_classic( 'shared/tools.php', compact( 'data' ) );
		?>
	</div>
</div>

