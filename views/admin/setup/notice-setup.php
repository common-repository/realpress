<div id="realpress-notice-install" class="realpress-notice notice notice-info">
	<p><?php _e( '<strong>RealPress is ready to use.</strong>', 'realpress' ); ?></p>
	<p>
		<a class="button button-primary"
		   href="<?php echo admin_url( 'index.php?page=realpress-setup' ); ?>"><?php esc_attr_e( 'Quick Setup', 'realpress' ); ?></a>
		<button class="button"
				data-dismiss-notice="skip-setup-wizard"><?php _e( 'Skip', 'realpress' ); ?></button>
	</p>
</div>
<?php
