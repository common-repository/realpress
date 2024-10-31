<?php

use RealPress\Helpers\Fields\AbstractField;
use RealPress\Register\Setting;
use RealPress\Helpers\Forms\AbstractForm;
use RealPress\Helpers\Validation;

/**
 * @var $config Setting
 */
if ( ! isset( $config ) || ! isset( $data ) ) {
	return;
}

$group        = $config['group'];
$active_group = Validation::sanitize_params_submitted( $_GET['tab'] ?? array_key_first( $group ) );
$url          = admin_url( $config['parent_slug'] . '&page=' . $config['slug'] );
?>
	<div class="realpress-option-setting-wrapper">
		<!--Display section-->
		<div class="realpress-option-setting-tab">
			<?php
			foreach ( $group as $tab_name => $tab_args ) {
				$active_group_class = '';
				if ( $tab_name == $active_group ) {
					$active_group_class = 'active';
				}
				?>
				<div class="<?php echo esc_attr( $active_group_class ); ?>">
					<a id="<?php echo esc_attr( 'realpress_' . $tab_args['id'] ); ?>"
					   href="<?php echo esc_url_raw( add_query_arg( 'tab', $tab_name, $url ) ); ?>">
						<span><?php echo esc_html( $tab_args['title'] ); ?></span>
					</a>
				</div>
				<?php
			}
			?>
		</div>

		<!--Display content-->
		<div class="realpress-option-setting-content">
			<form method="POST" enctype="multipart/form-data">
				<?php
				wp_nonce_field( 'realpress-option-setting-action', 'realpress-option-setting-name' );
				?>
				<div class="realpress-option-setting-field">
					<?php
					foreach ( $group as $group_name => $group_args ) {
						if ( $group_name == $active_group ) {
							if ( isset( $group_args['type'] ) && $group_args['type'] instanceof AbstractForm ) {
								$group_args['data'] = $data;
								$group_args['name'] = 'group:' . $group_name;
								$group_args['key']  = REALPRESS_OPTION_KEY;
								$group_args['type']->set_args( $group_args )->render();
								break;
							}
							$fields = $group_args['fields'];
							foreach ( $fields as $field_name => $field_args ) {
								if ( isset( $field_args['type'] ) ) {
									if ( $field_args['type'] instanceof AbstractForm ) {
										$name               = 'group:' . $group_name . ':fields:' . $field_name;
										$field_args['data'] = $data;
										$field_args['name'] = $name;
										$field_args['key']  = REALPRESS_OPTION_KEY;
										$field_args['type']->set_args( $field_args )->render();
									} elseif ( $field_args['type'] instanceof AbstractField ) {
										$name                = 'group:' . $group_name . ':fields:' . $field_name;
										$field_args['value'] = $data[ $name ] ?? '';
										$field_args['name']  = REALPRESS_OPTION_KEY . '[' . $name . ']';
										$field_args['type']->set_args( $field_args )->render();
									}
								}
							}
						}
					}
					?>
				</div>
				<button type="submit" class="button button-primary">
					<?php esc_html_e( 'Save Changes', 'realpress' ); ?>
				</button>
				<?php wp_nonce_field( 'realpress-option-setting-action', 'realpress-option-setting-name' ); ?>
			</form>
		</div>
	</div>
<?php
