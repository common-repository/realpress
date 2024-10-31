<?php

use RealPress\Helpers\Template;
use RealPress\Models\UserModel;
use RealPress\Helpers\User;
use RealPress\Models\CommentModel;

$template                = Template::instance();
$data                    = array();
$agent                   = get_queried_object();
$agent_id                = $agent->ID;
$user_meta_data          = UserModel::get_user_meta_data( $agent_id );
$data['display_name']    = $agent->display_name;
$data['avatar']          = UserModel::get_user_avatar( $agent_id, 'large' );
$data['company_name']    = $user_meta_data['user_profile:fields:company_name'];
$data['company_url']     = $user_meta_data['user_profile:fields:company_url'];
$data['license']         = $user_meta_data['user_profile:fields:license'];
$data['tax_number']      = $user_meta_data['user_profile:fields:tax_number'];
$data['address']         = $user_meta_data['user_profile:fields:address'];
$data['position']        = $user_meta_data['user_profile:fields:position'];
$data['mobile_number']   = $user_meta_data['user_profile:fields:mobile_number'];
$data['social_networks'] = User::get_social_networks( $agent_id );
$data['description']     = get_the_author_meta( 'description', $agent_id );
$data['property_total']  = count_user_posts( $agent_id, REALPRESS_PROPERTY_CPT, true );
$data['comment_total']   = CommentModel::get_comment_total( $agent_id, 'agent' );
?>

<div class="realpress-agent-detail">
	<div class="realpress-container">
		<?php
		do_action( 'realpress/agent-detail/frontend/breadcrumb' );
		?>
		<div class="realpress-agent-detail-breadcrumb">
			<?php
			$template->get_frontend_template_type_classic( 'shared/breadcrumb.php', compact( 'data' ) );
			?>
			<h2><?php esc_html_e( 'Agent details', 'realpress' ); ?></h2>
		</div>
		<?php
		$template->get_frontend_template_type_classic( 'agent-detail/agent-profile.php', compact( 'data' ) );
		?>
		<div class="realpress-agent-detail-content">
			<?php
			$template->get_frontend_template_type_classic( 'agent-detail/about.php', compact( 'data' ) );
			$template->get_frontend_template_type_classic( 'agent-detail/agent-property-comment-group.php', compact( 'data' ) );
			?>
		</div>
		<?php do_action( 'realpress/agent-detail/frontend/sidebar' ); ?>
		<div class="realpress-agent-detail-sidebar">
			<?php
			if ( is_active_sidebar( 'realpress-agent-detail-sidebar' ) ) {
				dynamic_sidebar( 'realpress-agent-detail-sidebar' );
			}
			?>
		</div>
	</div>
	<footer>
	</footer>
</div>
