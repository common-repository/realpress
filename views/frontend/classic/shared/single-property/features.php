<?php
if ( ! isset( $data ) ) {
	return;
}

$features = $data['features'];

if ( empty( $features ) ) {
	return;
}
?>

<ul class="realpress-features">
	<?php
	foreach ( $features as $feature ) {
		?>
		<li>
			<i class="fas fa-check"></i>
			<a href="<?php echo get_term_link( $feature ); ?>"><?php echo esc_html( $feature->name ); ?></a>
		</li>
		<?php
	}
	?>
</ul>
