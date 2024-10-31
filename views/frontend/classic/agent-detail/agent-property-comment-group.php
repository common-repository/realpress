<?php
if ( ! isset( $data ) ) {
	return;
}

use RealPress\Helpers\Template;

$template       = Template::instance();
$property_total = empty( $data['property_total'] ) ? 0 : $data['property_total'];
$comment_total  = empty( $data['comment_total'] ) ? 0 : $data['comment_total'];
?>
<div class="realpress-agent-detail-property-comment">
	<div class="realpress-agent-detail-property-comment-control">
		<ul>
			<li data-control="property">
				<span><?php printf( esc_html__( 'Property(%s)', 'realpress' ), $property_total ); ?></span>
			</li>
			<li data-control="comment" id="realpress-comment-scroll">
				<span><?php printf( esc_html__( 'Comment(%s)', 'realpress' ), $comment_total ); ?></span>
			</li>
		</ul>
	</div>
	<div class="realpress-agent-detail-property-comment-content">
		<div data-content="property" class="realpress-agent-detail-property-content">
			<div class="realpress-agent-detail-property-count-sort-group">
				<div class="realpress-agent-detail-property-count">
					<?php
					if ( empty( $property_total ) ) {
						esc_html_e( 'No properties', 'realpress' );
					} else {
						printf( esc_html( _n( '%s Property', '%s Properties', $property_total, 'realpress' ) ), $property_total );
					}
					?>
				</div>
				<?php
				if ( ! empty( $property_total ) ) {
					$template->get_frontend_template_type_classic( 'shared/property-sort.php' );
				}
				?>
			</div>
			<?php
			if ( ! empty( $property_total ) ) {
				?>
				<div class="realpress-agent-detail-property-container">
					<div class="realpress-wave-loading">
					</div>
				</div>
				<?php
			}
			?>

			<div class="realpress-agent-detail-property-pagination-wrapper">
			</div>
		</div>
		<div data-content="comment" class="realpress-agent-detail-comment-content">
			<div class="realpress-agent-detail-comment-count">
				<?php
				if ( empty( $comment_total ) ) {
					esc_html_e( 'No Comments', 'realpress' );
				} else {
					printf( esc_html( _n( '%s Comment', '%s Comments', $comment_total, 'realpress' ) ), $comment_total );
				}
				?>
			</div>

			<?php
			if ( ! empty( $comment_total ) ) {
				?>
				<div class="realpress-agent-detail-comment-container">
					<div class="realpress-agent-comment-title">
						<span><?php esc_html_e( 'Agent Comments', 'realpress' ); ?></span><a
								href="#realpress-agent-comment-form"><?php esc_html_e( 'Leave a comment', 'realpress' ); ?></a>
					</div>

					<ul class="realpress-comments-container">
						<li class="realpress-wave-loading">
						</li>
					</ul>
				</div>
				<!--Pagination-->
				<div class="realpress-comment-pagination-wrap">
				</div>
				<?php
			}
			?>

			<div id="realpress-agent-comment-form">
				<?php
				$template->get_frontend_template_type_classic( 'agent-detail/comments/form.php', compact( 'data' ) );
				?>
			</div>
		</div>
	</div>
</div>
