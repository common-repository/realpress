<?php
?>
<div class="realpress-search-control-button">
	<?php
	if ( ! empty( $toggle_fields ) ) {
		?>
		<button type="button" class="realpress-search-toggle-fields-button"><i
					class="fas fa-cog"></i><?php esc_html_e( 'Advanced Search', 'realpress' ); ?>
		</button>
		<?php
	}
	?>
	<button type="button" class="realpress-search-property-button"><?php esc_html_e( 'Search', 'realpress' ); ?><i
				class="fas fa-search"></i></button>
</div>
