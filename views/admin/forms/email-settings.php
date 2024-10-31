<?php

if ( ! isset( $field ) ) {
	return;
}

use RealPress\Helpers\Validation;

$data           = $field->data;
$sections       = $field->section;
$active_section = Validation::sanitize_params_submitted( $_GET['section'] ?? array_key_first( $sections ) );

?>
	<div class="realpress-email-setting-wrapper">
		<div class="realpress-email-section">
			<ul>
				<?php
				foreach ( $sections as $name => $section_args ) {
					$class_active_group = '';
					if ( $name == $active_section ) {
						$class_active_group = 'active';
					}
					$url = remove_query_arg( 'object' );
					$url = add_query_arg( 'section', $name, $url );
					?>
					<li>
						<a id="<?php echo esc_attr( 'realpress_' . $section_args['id'] ); ?>"
						   href="<?php echo esc_url_raw( $url ); ?>"
						   class="<?php echo esc_attr( $class_active_group ); ?>"> <?php echo esc_html( $section_args['title'] ); ?></a>
					</li>
					<?php
				}
				?>
			</ul>
		</div>
		<div class="realpress-email-content-wrapper">
			<?php
			foreach ( $sections as $name => $section_args ) {
				if ( $active_section === $name ) {
					$objects       = $section_args['object'];
					$active_object = Validation::sanitize_params_submitted( $_GET['object'] ?? array_key_first( $objects ) );
					?>
					<div class="realpress-email-user">
						<?php
						foreach ( $objects as $object_name => $object_args ) {
							$class_active_object = '';
							if ( $object_name == $active_object ) {
								$class_active_object = 'active';
							}
							?>
							<a href="<?php echo esc_url_raw( add_query_arg( 'object', $object_name ) ); ?>"
							   class="<?php echo esc_attr( $class_active_object ); ?>"><?php echo esc_html( ucfirst( $object_name ) ); ?></a>
							<?php
						}
						?>
					</div>
					<div class="realpress-email-content">
						<?php
						foreach ( $objects as $object_name => $object_args ) {
							if ( $object_name == $active_object ) {
								$fields = $object_args['fields'];
								foreach ( $fields as $field_name => $field_args ) {
									$name                = $field->name . ':section:' . $active_section . ':object:' . $active_object . ':fields:' . $field_name;
									$field_args['value'] = $data[ $name ] ?? '';
									$field_args['name']  = $field->key . '[' . $name . ']';
									$field_args['type']->set_args( $field_args )->render();
								}
								break;
							}
						}
						?>
					</div>
					<?php
					break;
				}
			}
			if ( ! empty( $field->description ) ) {
				?>
				<div class="realpress-email-description">
					<?php
					echo esc_html( $field->description );
					?>
				</div>
				<?php
			}
			?>
		</div>
	</div>
<?php
