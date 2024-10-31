<?php

use RealPress\Helpers\Template;

$data     = array();
$template = Template::instance();
?>
<div class="realpress-agent-list">
	<div class="realpress-container">
		<?php
		do_action( 'realpress/agent-list/frontend/breadcrumb' );
		?>
		<div class="realpress-agent-list-breadcrumb">
			<?php
			$template->get_frontend_template_type_classic( 'shared/breadcrumb.php', compact( 'data' ) );
			?>
		</div>
		<div class="realpress-agent-list-content">
			<div class="realpress-list-item-control-group">
				<h2><?php esc_html_e( 'Agent List', 'realpress' ); ?></h2>
				<?php
				$template->get_frontend_template_type_classic( 'agent-list/sort-by.php' );
				?>
			</div>
			<div class="realpress-agent-list-container" data-grid-col="1">
				<div class="realpress-wave-loading">

				</div>
			</div>

			<div class="realpress-agent-list-pagination-wrapper">
				<div class="realpress-agent-list-from-to">
				</div>
				<div class="realpress-agent-list-pagination">
				</div>
			</div>
		</div>
		<?php do_action( 'realpress/agent-list/frontend/sidebar' ); ?>
		<div class="realpress-agent-list-sidebar">
			<?php
			if ( is_active_sidebar( 'realpress-agent-list-sidebar' ) ) {
				dynamic_sidebar( 'realpress-agent-list-sidebar' );
			}
			?>
		</div>
	</div>
	<footer>
	</footer>
</div>
