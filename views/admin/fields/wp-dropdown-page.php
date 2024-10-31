<?php
if ( ! isset( $field ) ) {
	return;
}

use RealPress\Helpers\General;

$args = $field->args;
if ( ! empty( $field->name ) ) {
	$args['name'] = $field->name;
}

if ( ! empty( $field->value ) && get_post_status( $field->value ) === 'publish' ) {
	$args['selected'] = $field->value;
}

$allow_create_page = $field->allow_create_page;
?>
	<div class="<?php echo esc_attr( ltrim( $field->class . ' ' . 'realpress-field-wrapper realpress-wp-dropdown-page-wrapper' ) ); ?>">
		<?php
		if ( ! empty( $field->title ) ) {
			?>
			<div class="realpress-title-wrapper">
				<label for="<?php echo esc_attr( $field->id ); ?>"><?php echo esc_html( $field->title ); ?></label>
			</div>
			<?php
		}
		?>
		<div class="realpress-wp-dropdown-page-content">
			<div class="realpress-dropdown">
				<?php
				wp_dropdown_pages( $args );
				?>
			</div>
			<?php
			if ( ! empty( $allow_create_page ) ) {
				?>
				<button type="button" class="button realpress-quick-add-page">
					<?php esc_html_e( 'Create new page', 'realpress' ); ?>
				</button>

				<p class="realpress-quick-add-page-inline">
					<input type="text" placeholder="<?php esc_attr_e( 'New page title', 'realpress' ); ?>"/>
					<button class="button" type="button">
						<?php esc_html_e( 'Confirm', 'realpress' ); ?>
					</button>
					<a href=""><?php esc_html_e( 'Cancel [ESC]', 'realpress' ); ?></a>
				</p>

				<p class="realpress-quick-add-page-actions">
					<?php
					if ( ! empty( $args['selected'] ) ) {
						?>
						<a class="edit-page" href="<?php echo get_edit_post_link( $args['selected'] ); ?>"
						   target="_blank"><?php esc_html_e( 'Edit page', 'realpress' ); ?></a>
						&#124;
						<a class="view-page" href="<?php echo get_permalink( $args['selected'] ); ?>"
						   target="_blank"><?php esc_html_e( 'View page', 'realpress' ); ?></a>
						<?php
					}
					?>
				</p>
				<?php
			}
			if ( ! empty( $field->description ) ) {
				?>
				<p><?php echo General::ksesHTML( $field->description ); ?></p>
				<?php
			}
			?>
		</div>
	</div>
<?php
