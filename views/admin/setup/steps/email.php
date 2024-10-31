<?php

use RealPress\Helpers\Config;
use RealPress\Helpers\Settings;

?>
	<div class="realpress-setup-heading realpress-heading-email">
		<h2><?php esc_html_e( 'Email Settings', 'realpress' ); ?></h2>
	</div>

	<div class="realpress-setup-form-field">
		<table>
			<tr>
				<th></th>
				<th><?php esc_html_e( 'Admin', 'realpress' ); ?></th>
				<th><?php esc_html_e( 'User', 'realpress' ); ?></th>
			</tr>
			<?php
			$email_sections = Config::instance()->get( 'realpress-setting:group:email:section' );
			foreach ( $email_sections as $section_name => $section_args ) {
				$object = $section_args['object'];
				?>
				<tr>
					<td><?php echo esc_html( $section_args['title'] ); ?></td>
					<td>
						<?php
						if ( isset( $object['admin'] ) ) {
							$name       = 'group:email:section:' . $section_name . ':object:admin:fields:enable';
							$field_args = $object['admin']['fields']['enable'];
							unset( $field_args['title'] );
							$field_args['value'] = Settings::get_setting_detail( $name ) ?? '';
							$field_args['name']  = REALPRESS_OPTION_KEY . '[' . $name . ']';
							$field_args['type']->set_args( $field_args )->render();
						}
						?>
					</td>
					<td>
						<?php
						if ( isset( $object['user'] ) ) {
							$name       = 'group:email:section:' . $section_name . ':object:user:fields:enable';
							$field_args = $object['user']['fields']['enable'];
							unset( $field_args['title'] );
							$field_args['value'] = Settings::get_setting_detail( $name ) ?? '';
							$field_args['name']  = REALPRESS_OPTION_KEY . '[' . $name . ']';
							$field_args['type']->set_args( $field_args )->render();
						}
						if ( isset( $object['agent'] ) ) {
							$name       = 'group:email:section:' . $section_name . ':object:agent:fields:enable';
							$field_args = $object['agent']['fields']['enable'];
							unset( $field_args['title'] );
							$field_args['value'] = Settings::get_setting_detail( $name ) ?? '';
							$field_args['name']  = REALPRESS_OPTION_KEY . '[' . $name . ']';
							$field_args['type']->set_args( $field_args )->render();
						}
						?>
					</td>
				</tr>
				<?php
			}
			?>
		</table>

	</div>
<?php

