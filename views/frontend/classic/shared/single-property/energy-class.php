<?php

use RealPress\Models\TermModel;

if ( ! isset( $data ) ) {
	return;
}

$energy_class = $data['energy-class'];
if ( empty( $energy_class ) ) {
	return;
}
//Get first value
$energy_class   = $energy_class[0];
$term_meta_data = TermModel::get_meta_data( $energy_class->term_id );

$all_enery_class_terms = get_terms(
	array(
		'taxonomy'   => 'realpress-energy-class',
		'hide_empty' => false,
		'orderby'    => 'slug',
	)
);
?>
<div class="realpress-energy-class">
	<ul class="realpress-class-energy-list">
		<li>
			<strong><?php esc_html_e( 'Energy class:', 'realpress' ); ?></strong>
			<span><?php echo esc_html( $energy_class->name ); ?></span>
		</li>
		<li>
			<strong><?php esc_html_e( 'Global Energy Performance Index:', 'realpress' ); ?></strong>
			<?php
			if ( ! empty( $term_meta_data['global_performance_index'] ) ) {
				?>
				<span><?php echo esc_html( $term_meta_data['global_performance_index'] ); ?></span>
				<?php
			}
			?>
		</li>
		<li>
			<strong><?php esc_html_e( 'Renewable energy performance index:', 'realpress' ); ?></strong>
			<?php
			if ( ! empty( $term_meta_data['renewable_performance_index'] ) ) {
				?>
				<span><?php echo esc_html( $term_meta_data['renewable_performance_index'] ); ?></span>
				<?php
			}
			?>
		</li>
		<li>
			<strong><?php esc_html_e( 'Energy performance of the building:', 'realpress' ); ?></strong>
			<?php
			if ( ! empty( $term_meta_data['performance_of_building'] ) ) {
				?>
				<span><?php echo esc_html( $term_meta_data['performance_of_building'] ); ?></span>
				<?php
			}
			?>
		</li>
		<li>
			<strong><?php esc_html_e( 'EPC Current Rating:', 'realpress' ); ?></strong>
			<?php
			if ( ! empty( $term_meta_data['epc_current_rating'] ) ) {
				?>
				<span><?php echo esc_html( $term_meta_data['epc_current_rating'] ); ?></span>
				<?php
			}
			?>
		</li>
		<li>
			<strong><?php esc_html_e( 'EPC Potential Rating:', 'realpress' ); ?></strong>
			<?php
			if ( ! empty( $term_meta_data['epc_potential_rating'] ) ) {
				?>
				<span><?php echo esc_html( $term_meta_data['epc_potential_rating'] ); ?></span>
				<?php
			}
			?>
		</li>
	</ul>
	<ul class="realpress-class-energy-indicator">
		<?php
		foreach ( $all_enery_class_terms as $enery_class_term ) {
			$color = TermModel::get_meta_data( $enery_class_term->term_id )['color'];
			?>
			<li>
				<?php
				if ( $enery_class_term->term_id == $energy_class->term_id ) {
					?>
					<div class="realpress-class-energy-current-indicator"><?php printf( esc_html__( '%1$s | Energy class %2$s', 'realpress' ), $term_meta_data['global_performance_index'], $energy_class->name ); ?></div>
					<?php
				}
				?>
				<span style="background-color: <?php echo esc_attr( $color ); ?>"><?php echo esc_html( $enery_class_term->name ); ?></span>
			</li>
			<?php
		}
		?>
	</ul>
</div>
