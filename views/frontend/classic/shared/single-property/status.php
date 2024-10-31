<?php

use RealPress\Models\TermModel;

if ( ! isset( $data ) ) {
	return;
}
$status = $data['status'];

if ( ! empty( $status ) ) {
	$term = $status[0];
	?>
	<div class="realpress-property-status">
		<?php
		$color = TermModel::get_meta_data( $term->term_id )['color'] ?? '';
		?>
		<div><a style="background-color: <?php echo esc_attr( $color ); ?>"
					href="<?php echo get_term_link( $term ); ?>">
				<?php
				echo esc_html( $term->name );
				?>
			</a></div>
	</div>
	<?php
}
?>
