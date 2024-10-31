<?php

use RealPress\Helpers\Template;

$data     = array();
$template = Template::instance();
?>
	<div id="realpress-wishlist">
		<div class="realpress-container">
			<?php
			do_action( 'realpress/wishlist/frontend/breadcrumb' );
			?>
			<div class="realpress-wishlist-breadcrumb">
				<?php
				$template->get_frontend_template_type_classic( 'shared/breadcrumb.php', compact( 'data' ) );
				?>
			</div>
			<?php
			if ( ! is_user_logged_in() ) {
				return;
			}
			?>
			<div class="realpress-wishlist-content">
				<div class="realpress-property-container" data-grid-col="3">
					<div class="realpress-wave-loading">

					</div>
				</div>

				<div class="realpress-wishlist-pagination-wrapper">
					<div class="realpress-wishlist-from-to">
					</div>
					<div class="realpress-wishlist-pagination">
					</div>
				</div>
			</div>
		</div>
		<footer>
		</footer>
	</div>
<?php
