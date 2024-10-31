<?php
update_option( 'realpress_setup_wizard_completed', 'yes' );
$add_new_property_url = add_query_arg( array( 'post_type' => REALPRESS_PROPERTY_CPT ), admin_url( 'post-new.php' ) );
$setting_page         = add_query_arg(
	array(
		'post_type' => REALPRESS_PROPERTY_CPT,
		'page'      => 'realpress-setting',
	),
	admin_url( 'edit.php' )
);
?>
<div class="realpress-setup-heading">
	<h2><?php esc_html_e( 'Finish', 'realpress' ); ?></h2>
	<p><?php esc_html_e( 'RealPress is ready!', 'realpress' ); ?></p>
</div>
<div class="realpress-setup-group-button">
	<div class="realpress-setting-page">
		<a href="<?php echo esc_url_raw( $setting_page ); ?>" class="button"><?php esc_html_e( 'More Settings', 'realpress' ); ?></a>
	</div>
	<div class="realpress-add-new-property-page">
		<a href="<?php echo esc_url_raw( $add_new_property_url ); ?>" class="button"><?php esc_html_e( 'Add a new property', 'realpress' ); ?></a>
	</div>
	<div class="realpress-archive-page">
		<a href="<?php echo esc_url_raw( get_post_type_archive_link( REALPRESS_PROPERTY_CPT ) ); ?>" class="button"><?php esc_html_e( 'Archive Properties', 'realpress' ); ?></a>
	</div>
</div>
<div class="realpress-import-demo-content">
	<button type="button"><?php esc_html_e( 'Import Demo', 'realpress' ); ?></button>
	<div class="realpress-import-demo-notification">
	</div>
</div>

