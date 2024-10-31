<?php

use RealPress\Models\TermModel;

if ( ! isset( $data ) ) {
	return;
}
$labels = $data['labels'];

//$statuses = $data['realpress-status'];
?>
<div class="realpress-property-label">
	<?php
	if ( ! empty( $labels ) ) {
		foreach ( $labels as $term ) {
			$color = TermModel::get_meta_data( $term->term_id )['color'] ?? '';
			?>
			<a style="color:<?php echo esc_attr( $color ); ?>; border-color:<?php echo esc_attr( $color ); ?>"
			   href="<?php echo get_term_link( $term ); ?>"><?php echo esc_html( $term->name ); ?></a>
			<?php
		}
	}
	?>
</div>
