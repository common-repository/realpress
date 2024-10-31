<?php
if ( ! isset( $data ) ) {
	return;
}

$year_built = $data['year_built'];
?>
	<div class="realpress-year-built">
		<?php echo esc_html( $year_built ); ?>
	</div>
<?php
