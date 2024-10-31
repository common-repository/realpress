<?php
/**
 * Template Edit Property
 */
if ( ! isset( $config ) || ! isset( $data ) ) {
	return;
}

$group = $config['group'];
?>
<div class="realpress-property-meta-wrapper">
	<!--Display section-->
	<div class="realpress-tab-section">
		<ul>
			<?php

			use RealPress\Helpers\Fields\AbstractField;
			use RealPress\Helpers\Forms\AbstractForm;

			foreach ( $group as $group_args ) {
				?>
				<li id="<?php echo esc_attr( 'realpress_' . $group_args['id'] . '_tab' ); ?>"><a href="#">
						<?php
						if ( ! empty( $group_args['icon'] ) ) {
							?>
							<i class="<?php echo esc_attr( $group_args['icon'] ); ?>"></i>
							<?php
						}
						?>
						<span><?php echo esc_html( $group_args['title'] ); ?></span></a></li>
				<?php
			}
			?>
		</ul>
	</div>

	<!--Display content-->
	<?php
	wp_nonce_field( 'realpress_admin_edit_property_action', 'realpress_admin_edit_property_name' );
	?>
	<div class="realpress-tab-content-section">
		<?php
		foreach ( $group as $group_name => $group_args ) {
			$id = 'realpress_' . $group_args['id'] . '_content';
			?>
			<div id="<?php echo esc_attr( $id ); ?>" class="realpress-field-content">
				<?php
				$section = $group_args['section'];
				foreach ( $section as $section_name => $section_args ) {
					?>
					<div class="realpress-row">
						<?php
						if ( isset( $section_args['type'] ) && $section_args['type'] instanceof AbstractForm ) {
							$section_args['key']  = REALPRESS_PROPERTY_META_KEY;
							$section_args['data'] = $data;
							$section_args['name'] = 'group:' . $group_name . ':section:' . $section_name;
							$section_args['type']->set_args( $section_args )->render();
						} else {
							$fields = $section_args['fields'];
							foreach ( $fields as $field_name => $field_args ) {
								if ( isset( $field_args['type'] ) && $field_args['type'] instanceof AbstractField ) {
									$name                = 'group:' . $group_name . ':section:' . $section_name . ':fields:' . $field_name;
									$field_args['value'] = $data[ $name ] ?? '';
									$field_args['name']  = REALPRESS_PROPERTY_META_KEY . '[' . $name . ']';
									/**
									 * @var AbstractField
									 */
									$field_args['type']->set_args( $field_args )->render();
								}
							}
						}
						if ( ! empty( $section_args['description'] ) ) {
							?>
							<p><?php echo esc_html( $section_args['description'] ); ?></p>
							<?php
						}
						?>
					</div>
					<?php
				}
				?>
			</div>
			<?php
		}
		?>
	</div>
</div>
