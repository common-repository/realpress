<?php

use RealPress\Models\UserModel;

if ( ! isset( $data ) ) {
	return;
}

$propety_id        = $data['id'];
$agent             = $data['agent'];
$agent_form_enable = $agent['enable'];
if ( empty( $agent_form_enable ) ) {
	return;
}
$show_custom_field   = false;
$user_id             = null;
$user_meta_data      = array();
$agent_custom_fields = array();

$agent_form_info = $agent['info'];
if ( $agent_form_info === 'show_custom_field' ) {
	$show_custom_field = true;
	if ( empty( $agent['custom_fields'] ) ) {
		return;
	}

	$agent_custom_fields = $agent['custom_fields'];
} else {
	$user_id = $agent['user_id'];
	if ( empty( $user_id ) ) {
		return;
	}
	$user_meta_data = UserModel::get_user_meta_data( $user_id );
}
?>

<div class="realpress-single-property-contact-form">
	<?php
	if ( $show_custom_field === true ) {
		?>
		<ul class=" realpress-agent-custom-fields">
			<?php
			foreach ( $agent_custom_fields as $agent_custom_field ) {
				?>
				<li>
					<div><?php echo esc_html( $agent_custom_field['label'] ); ?></div>
					<div><?php echo esc_html( $agent_custom_field['value'] ); ?></div>
				</li>
				<?php
			}
			?>
		</ul>
		<?php
	} else {
		?>
		<div class="realpress-agent-detail">
			<?php
			$company_name = $user_meta_data['user_profile:fields:company_name'];
			$company_url  = $user_meta_data['user_profile:fields:company_url'];
			$avatar_url   = UserModel::get_user_avatar( $user_id );
			$display_name = UserModel::get_field( $user_id, 'display_name' );
			if ( ! empty( $avatar_url ) ) {
				?>
				<div class="realpress-agent-image">
					<img src="<?php echo esc_url_raw( $avatar_url ); ?>"
						 alt="<?php echo esc_attr( $display_name ); ?>">
				</div>
				<?php
			}
			?>
			<div class="realpress-agent-info">
				<div class="realpress-agent-name"><?php echo esc_html( $display_name ); ?></div>
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
				if ( ! empty( $user_meta_data['user_profile:fields:mobile_number'] ) ) {
					?>
					<div class="realpress-agent-mobile"><?php echo esc_html( $user_meta_data['user_profile:fields:mobile_number'] ); ?></div>
					<?php
				}
				?>
			</div>
			<i class="fas fa-angle-down"></i>
		</div>
		<div class="realpress-agent-link">
			<a href="<?php echo get_author_posts_url( $user_id ); ?>"><?php esc_html_e( 'View detail', 'realpress' ); ?>
			</a></div>
		<?php
		echo do_shortcode( esc_html( '[realpress_contact_form user_id =' . $user_id . ']' ) );
	}
	?>
</div>
