<?php

use RealPress\Models\UserModel;
use RealPress\Helpers\Template;
use RealPress\Helpers\User;

if ( ! isset( $agent_id ) ) {
	return;
}
$template                = Template::instance();
$avatar_url              = UserModel::get_user_avatar( $agent_id, 'medium' );
$user_url                = get_author_posts_url( $agent_id );
$user_meta_data          = UserModel::get_user_meta_data( $agent_id );
$company_name            = $user_meta_data['user_profile:fields:company_name'];
$company_url             = $user_meta_data['user_profile:fields:company_url'];
$office_number           = $user_meta_data['user_profile:fields:office_phone_number'];
$mobile_number           = $user_meta_data['user_profile:fields:mobile_number'];
$email                   = UserModel::get_field( $agent_id, 'user_email' );
$data                    = array();
$data['social_networks'] = User::get_social_networks( $agent_id );
$property_total          = count_user_posts( $agent_id, REALPRESS_PROPERTY_CPT, true );
?>
<div class="realpress-agent-item">
	<div class="realpress-agent-header">
		<?php
		if ( ! empty( $avatar_url ) ) {
			?>
			<div class="realpress-agent-avatar">
				<img src="<?php echo esc_url_raw( $avatar_url ); ?>"
					 alt="<?php echo esc_attr( UserModel::get_field( $agent_id, 'display_name' ) ); ?>">
			</div>
			<?php
		}
		$template->get_frontend_template_type_classic( 'shared/agent/social-networks.php', compact( 'data' ) );
		?>
	</div>
	<div class="realpress-agent-body">
		<div class="realpress-agent-name">
			<a href="<?php echo esc_url_raw( $user_url ); ?>"><?php echo esc_html( UserModel::get_field( $agent_id, 'display_name' ) ); ?></a>
		</div>
		<?php
		if ( ! empty( $company_name ) && ! empty( $company_url ) ) {
			?>
			<div class="realpress-agent-company">
				<?php
				esc_html_e( 'Company Agent at ', 'realpress' );
				?>
				<a target="_blank"
				   href="<?php echo esc_url_raw( $company_url ); ?>"><?php echo esc_html( $company_name ); ?></a>
			</div>
			<?php
		}
		?>
		<div class="realpress-agent-contact">
			<?php
			if ( ! empty( $office_number ) ) {
				?>
				<div class="realpress-agent-office-number">
					<i class="fas fa-building"></i></i>
					<span><?php esc_html_e( 'Office:', 'realpress' ); ?></span>
					<a href="tel:<?php echo esc_attr( $office_number ); ?>"><?php echo esc_html( $office_number ); ?></a>
				</div>
				<?php
			}
			if ( ! empty( $email ) ) {
				?>
				<div class="realpress-agent-email">
					<i class="fas fa-envelope"></i><span><?php esc_html_e( 'Email:', 'realpress' ); ?></span>
					<a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a>
				</div>
				<?php
			}
			if ( ! empty( $mobile_number ) ) {
				?>
				<div class="realpress-agent-mobile">
					<i class="fas fa-mobile"></i><span><?php esc_html_e( 'Mobile:', 'realpress' ); ?></span>
					<a href="tel:<?php echo esc_attr( $mobile_number ); ?>"><?php echo esc_html( $mobile_number ); ?></a>
				</div>
				<?php
			}
			?>
		</div>
		<div class="realpress-agent-body-footer">
			<div class="realpress-agent-detail-link">
				<a href="<?php echo esc_url_raw( $user_url ); ?>"><?php esc_html_e( 'View Detail', 'realpress' ); ?></a>
			</div>
			<div class="realpress-agent-property-count">
				<?php
				if ( ! empty( $property_total ) ) {
					printf( esc_html( _n( '%s Property', '%s Properties', $property_total, 'realpress' ) ), $property_total );
				} else {
					esc_html_e( 'No Properties', 'realpress' );
				}
				?>
			</div>
		</div>
	</div>
</div>
