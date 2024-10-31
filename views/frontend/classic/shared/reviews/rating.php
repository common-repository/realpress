<?php
if ( ! isset( $data ) ) {
	return;
}
$rating = $data['rating'];

$is_label = $data['is_label'] ?? '';
$label    = '';
if ( empty( $rating ) ) {
	$star_pattern = array( 'empty', 'empty', 'empty', 'empty', 'empty' );
} elseif ( $rating >= 1 && $rating < 1.5 ) {
	$star_pattern = array( 'full', 'empty', 'empty', 'empty', 'empty' );
	if ( $is_label ) {
		$label = esc_html__( 'Poor', ' realpress' );
	}
} elseif ( $rating >= 1.5 && $rating < 2 ) {
	$star_pattern = array( 'full', 'half', 'empty', 'empty', 'empty' );
	if ( $is_label ) {
		$label = esc_html__( 'Fair', ' realpress' );
	}
} elseif ( $rating >= 2 && $rating < 2.5 ) {
	$star_pattern = array( 'full', 'full', 'empty', 'empty', 'empty' );
	if ( $is_label ) {
		$label = esc_html__( 'Fair', ' realpress' );
	}
} elseif ( $rating >= 2.5 && $rating < 3 ) {
	$star_pattern = array( 'full', 'full', 'half', 'empty', 'empty' );
	if ( $is_label ) {
		$label = esc_html__( 'Average', ' realpress' );
	}
} elseif ( $rating >= 3 && $rating < 3.5 ) {
	$star_pattern = array( 'full', 'full', 'full', 'empty', 'empty' );
	if ( $is_label ) {
		$label = esc_html__( 'Average', ' realpress' );
	}
} elseif ( $rating >= 3.5 && $rating < 4 ) {
	$star_pattern = array( 'full', 'full', 'full', 'half', 'empty' );
	if ( $is_label ) {
		$label = esc_html__( 'Good', ' realpress' );
	}
} elseif ( $rating >= 4 && $rating < 4.5 ) {
	$star_pattern = array( 'full', 'full', 'full', 'full', 'empty' );
	if ( $is_label ) {
		$label = esc_html__( 'Good', ' realpress' );
	}
} elseif ( $rating >= 4.5 && $rating < 5 ) {
	$star_pattern = array( 'full', 'full', 'full', 'half', 'empty' );
	if ( $is_label ) {
		$label = esc_html__( 'Exceptional', ' realpress' );
	}
} else {
	$star_pattern = array( 'full', 'full', 'full', 'full', 'full' );
	if ( $is_label ) {
		$label = esc_html__( 'Exceptional', ' realpress' );
	}
}
?>
<div class="realpress-rating">
	<div class="realpress-rating-stars">
		<?php
		foreach ( $star_pattern as $type ) {
			if ( $type === 'full' ) {
				?>
				<span class="star"><i class="fas fa-star"></i></span>
				<?php
			} elseif ( $type === 'half' ) {
				?>
				<span class="star"><i class="fas fa-star-half"></i></span>
				<?php
			} else {
				?>
				<span class="star"><i class="far fa-star"></i></span>
				<?php
			}
		}
		?>
	</div>
	<?php
	if ( $is_label ) {
		?>
		<div class="realpress-rating-label"><?php echo esc_html( $label ); ?></div>
		<?php
	}
	?>
</div>
