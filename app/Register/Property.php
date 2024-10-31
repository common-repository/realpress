<?php

namespace RealPress\Register;

use RealPress\Helpers\Config;
use RealPress\Helpers\Validation;

class Property {
	public function __construct() {
		add_action( 'init', array( $this, 'register' ), 5 );
		add_action( 'admin_footer-edit.php', array( $this, 'add_post_status_to_quick_edit' ) );
		add_filter( 'display_post_states', array( $this, 'add_post_state' ), 10, 2 );
	}

	public function register() {
		$properties    = Config::instance()->get( 'property-type:post_types' );
		$taxonomies    = Config::instance()->get( 'property-type:taxonomies' );
		$post_statuses = Config::instance()->get( 'property-type:post_statuses' );
		if ( ! empty( $properties ) ) {
			foreach ( $properties as $post_type => $args ) {
				register_post_type( $post_type, $args );
			}
		}
		flush_rewrite_rules();
		if ( ! empty( $taxonomies ) ) {
			foreach ( $taxonomies as $tax => $args ) {
				register_taxonomy( $tax, $args['post_types'], $args );
			}
		}

		if ( ! empty( $post_statuses ) ) {
			foreach ( $post_statuses as $status => $args ) {
				register_post_status( $status, $args );
			}
		}
	}

	public function add_post_status_to_quick_edit() {
		global $pagenow;
		$post_type = Validation::sanitize_params_submitted( $_GET['post_type'] ?? '' );
		if ( 'edit.php' !== $pagenow || empty( $post_type ) || $post_type !== REALPRESS_PROPERTY_CPT ) {
			return false;
		}

		$post_statuses = Config::instance()->get( 'property-type:post_statuses' );
		?>
		<script>
			let selectNode = document.querySelector('select[name="_status"]');
			let options = selectNode.innerHTML;
			<?php
			foreach ( $post_statuses as $status => $args ) {
			?>
			options += '<option value="<?php echo esc_attr( $status );?>"><?php echo esc_html( $args['label'] );?></option>'
			<?php
			}
			?>
			selectNode.innerHTML = options;
		</script>
		<?php
	}

	public function add_post_state( $post_states, $post ) {
		global $post;

		if ( empty( $post ) ) {
			return $post_states;
		}

		if ( $post->post_type === REALPRESS_PROPERTY_CPT ) {
			$post_statuses = Config::instance()->get( 'property-type:post_statuses' );
			if ( isset( $post_statuses[ $post->post_status ] ) ) {
				$post_states[] = $post_statuses[ $post->post_status ]['label'];
			}
		}

		return $post_states;
	}
}

