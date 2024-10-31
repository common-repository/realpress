<?php

namespace RealPress\Widgets;

use RealPress\Helpers\Template;
use RealPress\Helpers\Validation;
use RealPress\Helpers\Config;
use RealPress\Helpers\Fields\AbstractField;
use RealPress\Helpers\General;

class MortgageCalculator extends \WP_Widget {
	private $settings;

	public function __construct() {
		$this->settings = Config::instance()->get( 'mortgage-calculator', 'widgets' );
		parent::__construct(
			'realpress_mortgage_calculator',
			esc_html__( '(RealPress) Mortgage Calculator', 'realpress' ),
			array(
				'description' => esc_html__( "This widget only work on Single Property page" ),
			)
		);
	}

	/**
	 * @param $instance
	 *
	 * @return string|void
	 */
	public function form( $instance ) {
		?>
        <div class="realpress-widget-group">
			<?php
			foreach ( $this->settings as $field_name => $field_args ) {
				if ( isset( $field_args['type'] ) && $field_args['type'] instanceof AbstractField ) {
					$field_args['value'] = $instance[ $field_name ] ?? $field_args['default'];
					$field_args['name']  = $this->get_field_name( $field_name );
					$field_args['id']    = $this->get_field_id( $field_args['id'] );
					$field_args['type']->set_args( $field_args )->render();
				}
			}
			?>
        </div>
		<?php
	}

	/**
	 * @param $args
	 * @param $instance
	 *
	 * @return void
	 */
	public function widget( $args, $instance ) {
		ob_start();
		echo General::ksesHTML( $args['before_widget'] );
		if ( ! empty( $instance['title'] ) ) {
			echo General::ksesHTML( $args['before_title'] );
			?>
            <span><?php echo esc_html( $instance['title'] ); ?></span>
			<?php
			echo General::ksesHTML( $args['after_title'] );
		}

		$mortgage_args = $instance;
		unset( $mortgage_args['title'] );
		Template::instance()->get_frontend_template_type_classic( 'widgets/mortgage-calculator.php', compact( 'mortgage_args' ) );
		echo General::ksesHTML( $args['after_widget'] );
		$content = ob_get_clean();
		echo General::ksesHTML( $content );
	}

	/**
	 * @param $new_instance
	 * @param $old_instance
	 *
	 * @return array
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		foreach ( $new_instance as $key => $value ) {
			$field            = $this->settings[ $key ];
			$sanitize         = $field['sanitize'] ?? 'text';
			$value            = Validation::sanitize_params_submitted( $value, $sanitize );
			$instance[ $key ] = $value;
		}

		return $instance;
	}
}
