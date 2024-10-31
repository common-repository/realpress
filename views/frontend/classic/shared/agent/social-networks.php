<?php
if ( ! isset( $data ) ) {
	return;
}

use RealPress\Helpers\General;

$social_networks = $data['social_networks'];
?>
<ul class="realpress-agent-social-network-list">
	<?php
	foreach ( $social_networks as $social_network ) {
		if ( ! empty( $social_network['url'] ) ) {
			?>
			<li class="realpress-agent-social-network-item">
				<a target="_blank"
				   href="<?php echo esc_url_raw( $social_network['url'] ); ?>"><?php echo General::ksesHTML( $social_network['icon'] ); ?></a>
			</li>
			<?php
		}
	}
	?>
</ul>
