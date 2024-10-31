<?php

use RealPress\Helpers\Template;

$data     = array();
$template = Template::instance();
?>
<div class="realpress-archive-property">
    <div class="realpress-container">
		<?php
		do_action( 'realpress/archive-property/frontend/breadcrumb' );
		?>
        <div class="realpress-archive-property-breadcrumb">
			<?php
			$template->get_frontend_template_type_classic( 'shared/breadcrumb.php', compact( 'data' ) );
			?>
        </div>
		<?php
		$template->get_frontend_template_type_classic( 'shortcodes/advanced-search.php' );
		?>

        <div class="realpress-archive-property-content">
            <div class="realpress-list-item-control-group">
                <h2><?php esc_html_e( 'Archive Properties', 'realpress' ); ?></h2>
				<?php
				$template->get_frontend_template_type_classic( 'shared/property-sort.php' );
				?>
                <ul class="realpress-item-switch-view">
                    <li data-grid-col="1"><i class="far fa-square"></i></li>
                    <li data-grid-col="2"><i class="fas fa-columns"></i></li>
                    <li data-grid-col="3"><i class="fas fa-border-all"></i></li>
                </ul>
            </div>
            <div class="realpress-property-container" data-grid-col="1">
                <div class="realpress-wave-loading">

                </div>
            </div>

            <div class="realpress-archive-property-pagination-wrapper">
                <div class="realpress-archive-property-from-to">

                </div>
                <div class="realpress-archive-property-pagination">

                </div>
            </div>
        </div>
		<?php do_action( 'realpress/archive-property/frontend/sidebar' ); ?>
        <div class="realpress-archive-property-sidebar">
			<?php
			if ( is_active_sidebar( 'realpress-archive-property-sidebar' ) ) {
				dynamic_sidebar( 'realpress-archive-property-sidebar' );
			}
			?>
        </div>
    </div>
    <footer>
    </footer>
</div>
