<?php

namespace RealPress\MetaBoxes;

use RealPress\Helpers\Config;
use RealPress\Helpers\Template;
use RealPress\Helpers\Validation;
use RealPress\Models\PropertyModel;

/**
 * Class PropertyMeta
 * @package RealPress\MetaBoxes
 */
class PropertyMeta {
	/**
	 * @var array|mixed
	 */
	private $config = array();

	/**
	 * MetaFieldsController constructor.
	 */
	public function __construct() {
		$this->config = Config::instance()->get( 'property-metabox' );
		add_action( 'add_meta_boxes', array( $this, 'add_property_metaboxes' ) );
		add_action( 'save_post', array( $this, 'save_property_metaboxes' ), 10, 2 );
	}

	public function render_section() {
		include REALPRESS_VIEWS . 'metaboxes/sections.php';
	}

	/**
	 * @return void
	 */
	public function add_property_metaboxes() {
		global $wp_meta_boxes;

		//Remove taxonomies metabox in classic editor
		$taxonomies = Config::instance()->get( 'property-type:taxonomies' );
		$taxonomies = array_keys( $taxonomies );
		if ( isset( $wp_meta_boxes[ REALPRESS_PROPERTY_CPT ] ) ) {
			$property_metabox = $wp_meta_boxes[ REALPRESS_PROPERTY_CPT ];

			foreach ( $property_metabox as $context_key => $context_item ) {
				foreach ( $context_item as $priority_key => $priority_item ) {
					foreach ( $priority_item as $metabox_key => $metabox_item ) {
						$key = str_replace( 'div', '', $metabox_key );

						if ( in_array( $key, $taxonomies ) ) {
							unset( $wp_meta_boxes[ REALPRESS_PROPERTY_CPT ][ $context_key ][ $priority_key ][ $metabox_key ] );
						}
					}
				}
			}
		}

		add_meta_box(
			$this->config['id'],
			$this->config['name'],
			array( $this, 'render_metaboxes' ),
			array( REALPRESS_PROPERTY_CPT ),
			$this->config['context'],
			$this->config['priority']
		);
	}

	/**
	 * @param $post
	 *
	 * @return void
	 */
	public function render_metaboxes( $post ) {
		$config = $this->config;
		$data   = PropertyModel::get_meta_data( $post->ID );
		Template::instance()->get_admin_template( 'property/edit', compact( 'config', 'data' ) );
	}

	/**
	 * @param $post_id
	 * @param $post
	 *
	 * @return mixed|void
	 */
	public function save_property_metaboxes( $post_id, $post ) {
		$nonce = Validation::sanitize_params_submitted( $_POST['realpress_admin_edit_property_name'] ?? '' );
		if ( empty( $nonce ) || ! wp_verify_nonce( $nonce, 'realpress_admin_edit_property_action' ) ) {
			return $post_id;
		}

		if ( ! current_user_can( 'edit_realpress-properties', $post_id ) ) {
			return $post_id;
		}

		if ( REALPRESS_PROPERTY_CPT != $post->post_type ) {
			return $post_id;
		}

		//set default data when save empty data
		$this->set_default( $post_id );
		//set default data when save empty data
		$old_data = PropertyModel::get_meta_data( $post_id );
		$new_data = array();

		foreach ( $old_data as $name => $value ) {
			$field = Config::instance()->get( 'property-metabox:' . $name );
			$key   = Validation::sanitize_params_submitted( isset( $_POST[ REALPRESS_PROPERTY_META_KEY ][ $name ] ) );
			if ( $key ) {
				$save_data         = $_POST[ REALPRESS_PROPERTY_META_KEY ];
				$value             = Validation::filter_fields( $save_data[ $name ], $field );
				$sanitize          = $field['sanitize'] ?? 'text';
				$value             = Validation::sanitize_params_submitted( $value, $sanitize );
				$new_data[ $name ] = $value;
				if ( ! empty( $field['is_single_key'] ) ) {
					update_post_meta( $post_id, REALPRESS_PREFIX . '_' . $name, $value );
				}
			} else {
				if ( ! empty( $field['is_single_key'] ) ) {
					update_post_meta( $post_id, REALPRESS_PREFIX . '_' . $name, '' );
				}
				$new_data[ $name ] = '';
			}
		}

		update_post_meta( $post_id, REALPRESS_PROPERTY_META_KEY, $new_data );

		//update post terms
		$taxonomies         = Config::instance()->get( 'property-type:taxonomies' );
		$taxonomies         = array_keys( $taxonomies );
		$taxonomy_save_data = Validation::sanitize_params_submitted( $_POST['tax_input'] ?? array() );

		foreach ( $taxonomies as $taxonomy ) {
			if ( ! isset( $taxonomy_save_data[ $taxonomy ] ) ) {
				wp_set_post_terms( $post_id, array(), $taxonomy );
			}

			if ( in_array( $taxonomy, array( 'realpress-status', 'realpress-energy-class' ) ) ) {
				if ( ! empty( $taxonomy_save_data[ $taxonomy ] ) ) {
					$terms[] = $taxonomy_save_data[ $taxonomy ][0];
					wp_set_post_terms( $post_id, $terms, $taxonomy );
				}
			}
		}
	}

	/**
	 * @param $post_id
	 *
	 * @return void
	 */
	public function set_default( $post_id ) {
		if ( ! metadata_exists( 'post', $post_id, REALPRESS_PREFIX . '_property_average_review' ) ) {
			update_post_meta( $post_id, REALPRESS_PREFIX . '_property_average_review', 0 );
		}
	}
}

