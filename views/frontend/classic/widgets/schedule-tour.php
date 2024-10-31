<?php

use RealPress\Models\PropertyModel;
use RealPress\Models\UserModel;

if ( ! isset( $property_id ) ) {
	return;
}

$agent             = PropertyModel::get_agent_info( $property_id );
$agent_form_enable = $agent['enable'];
if ( empty( $agent_form_enable ) ) {
	return;
}
$show_custom_field = false;
$agent_form_info   = $agent['info'];
if ( in_array( $agent_form_info, array( 'author', 'agent' ) ) ) {
	$user_id = $agent['user_id'];
} elseif ( $agent_form_info === 'show_custom_field' ) {
	$show_custom_field = true;
}
if ( $show_custom_field === true ) {
	$agent_custom_fields = $agent['custom_fields'];
	if ( ! empty( $agent_custom_fields ) ) {
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
	}
} else {
	if ( empty( $user_id ) ) {
		return;
	}
	$user                   = get_userdata( $user_id );
	$user_meta_data         = UserModel::get_user_meta_data( $user_id );
	$shedule_tour_shortcode = $user_meta_data['user_profile:fields:schedule_tour_sc'] ?? '';
	if ( ! empty( $shedule_tour_shortcode ) ) {
		echo do_shortcode( esc_html( $shedule_tour_shortcode ) );
	}
}