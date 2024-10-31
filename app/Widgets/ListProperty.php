<?php

namespace RealPress\Widgets;

use RealPress\Helpers\Validation;
use RealPress\Helpers\Template;
use RealPress\Helpers\Config;
use RealPress\Helpers\Fields\AbstractField;
use WP_Query;
use RealPress\Helpers\General;

class ListProperty extends \WP_Widget {
	private $settings;

	public function __construct() {
		$this->settings = Config::instance()->get( 'property-list', 'widgets' );
		parent::__construct( 'realpress_property_list', esc_html__( '(RealPress) Property List', 'realpress' ) );
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

		unset( $instance['title'] );
		$query_args = wp_parse_args(
			array(
				'post_type'      => array( REALPRESS_PROPERTY_CPT ),
				'post_status'    => array( 'publish' ),
				'posts_per_page' => 3,
				'orderby'        => 'date',
				'order'          => 'DESC',
			),
			$instance
		);
		$query      = new WP_Query( $query_args );
		if ( $query->have_posts() ) {
			?>
			<?php
			while ( $query->have_posts() ) {
				$query->the_post();
				Template::instance()->get_frontend_template_type_classic(
					'widgets/property-list.php',
					array( 'property_id' => get_the_ID() )
				);
			}
			wp_reset_postdata();
		}
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
