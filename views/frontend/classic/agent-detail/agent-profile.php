<?php

use RealPress\Helpers\Template;

if ( ! isset( $data ) ) {
	return;
}
$template = Template::instance();
?>
<div class="realpress-agent-detail-profile-wrapper">
	<div class="realpress-agent-detail-avatar">
		<img src="<?php echo esc_url_raw( $data['avatar'] ); ?>" alt="<?php echo esc_attr( $data['display_name'] ); ?>">
	</div>
	<div class="realpress-agent-detail-profile">
		<div class="realpress-agent-detail-info">
			<div class="realpress-agent-detail-name"><?php echo esc_html( $data['display_name'] ); ?></div>
			<?php
			if ( ! empty( $data['company_name'] ) && ! empty( $data['company_url'] ) ) {
				?>
				<div class="realpress-agent-detail-company"><?php esc_html_e( 'Company Agent at ', 'realpress' ); ?><a
							href="<?php echo esc_url_raw( $data['company_url'] ); ?>"><?php echo esc_html( $data['company_name'] ); ?></a>
				</div>
				<?php
			}
			?>
			<ul>
				<?php
				if ( ! empty( $data['license'] ) ) {
					?>
					<li>
						<strong><?php esc_html_e( 'Agent License', 'realpress' ); ?></strong>
						<span><?php echo esc_html( $data['license'] ); ?></span>
					</li>
					<?php
				}
				if ( ! empty( $data['tax_number'] ) ) {
					?>
					<li>
						<strong><?php esc_html_e( 'Tax Number', 'realpress' ); ?></strong>
						<span><?php echo esc_html( $data['tax_number'] ); ?></span>
					</li>
					<?php
				}
				if ( ! empty( $data['address'] ) ) {
					?>
					<li>
						<strong><?php esc_html_e( 'Address', 'realpress' ); ?></strong>
						<span><?php echo esc_html( $data['address'] ); ?></span>
					</li>
					<?php
				}
				if ( ! empty( $data['position'] ) ) {
					?>
					<li>
						<strong><?php esc_html_e( 'Position', 'realpress' ); ?></strong>
						<span><?php echo esc_html( $data['position'] ); ?></span>
					</li>
					<?php
				}
				?>
			</ul>
			<div class="realpress-agent-detail-contact">
				<button type="button"><?php esc_html_e( 'Send Email', 'realpress' ); ?></button>
				<a href="tel:<?php echo esc_attr( $data['mobile_number'] ); ?>"><?php printf( esc_html__( 'Call %s', 'realpress' ), $data['mobile_number'] ); ?></a>
			</div>
		</div>
		<div class="realpress-agent-deatail-comment-social">
			<div class="realpress-agent-detail-comment-scroll">
				<a href="#realpress-comment-scroll"><?php esc_html_e( 'See all comments', 'realpress' ); ?></a>
			</div>
			<?php
			$template->get_frontend_template_type_classic( 'shared/agent/social-networks.php', compact( 'data' ) )
			?>
		</div>
	</div>
</div>
