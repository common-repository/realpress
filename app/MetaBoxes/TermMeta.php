<?php

namespace RealPress\MetaBoxes;

use RealPress\Helpers\Config;
use RealPress\Helpers\Validation;

/**
 * TermMeta
 */
class TermMeta {
	private $settings;

	public function __construct() {
		$this->settings = Config::instance()->get( 'term-metabox' );
		$taxonomies     = array_keys( $this->settings );
		foreach ( $taxonomies as $taxonomy ) {
			add_action( $taxonomy . '_add_form_fields', array( $this, 'add_term_metabox' ), 10, 1 );
			add_action( $taxonomy . '_edit_form', array( $this, 'edit_term_metabox' ), 10, 2 );
			add_action( 'saved_' . $taxonomy, array( $this, 'save_term_metabox' ), 10, 1 );
		}
		//Energy-class
		add_filter( 'manage_edit-realpress-energy-class_columns', array( $this, 'modify_energy_class_term_column_headers' ) );
		add_filter( 'manage_edit-realpress-energy-class_sortable_columns', array( $this, 'sort_energy_class_term_column' ) );
		add_filter(
			'manage_realpress-energy-class_custom_column',
			array( $this, 'modify_energy_class_term_custom_column' ),
			10,
			3
		);
	}

	public function add_term_metabox( $taxonomy ) {
		if ( $taxonomy == 'realpress-energy-class' ) {
			?>
			<style>
				.term-description-wrap {
					display: none;
				}
			</style>
			<?php
		}

		$fields    = $this->settings[ $taxonomy ];
		$term_id   = Validation::sanitize_params_submitted( $_GET['tag_ID'] ?? '' );
		$term_meta = get_term_meta( $term_id, REALPRESS_TERM_META_KEY, true );
		foreach ( $fields as $field ) {
			$field['value'] = $term_meta[ $field['name'] ] ?? $field['default'];
			$field['name']  = REALPRESS_TERM_META_KEY . '[' . $field['name'] . ']';
			$field['type']->set_args( $field )->render();
		}
	}

	public function edit_term_metabox( $tag, $taxonomy ) {
		if ( $taxonomy == 'realpress-energy-class' ) {
			?>
			<style>
				.term-description-wrap {
					display: none;
				}
			</style>
			<?php
		}

		$fields    = $this->settings[ $taxonomy ];
		$term_id   = Validation::sanitize_params_submitted( $_GET['tag_ID'] ?? '' );
		$term_meta = get_term_meta( $term_id, REALPRESS_TERM_META_KEY, true );
		foreach ( $fields as $field ) {
			$field['value'] = $term_meta[ $field['name'] ] ?? $field['default'];
			$field['name']  = REALPRESS_TERM_META_KEY . '[' . $field['name'] . ']';
			$field['type']->set_args( $field )->render();
		}
	}

	public function save_term_metabox( $term_id ) {
		$action = Validation::sanitize_params_submitted( $_POST['action'] );
		if ( empty( $action ) || ! in_array( $action, array( 'editedtag', 'add-tag' ) ) ) {
			return false;
		}
		$term = get_term( $term_id );

		$fields = $this->settings[ $term->taxonomy ];
		$data   = array();
		foreach ( $fields as $field ) {
			$key = Validation::sanitize_params_submitted( isset( $_POST[ REALPRESS_TERM_META_KEY ][ $field['name'] ] ) );
			if ( $key ) {
				$sanitize               = $field['sanitize'] ?? 'text';
				$data[ $field['name'] ] = Validation::sanitize_params_submitted( $_POST[ REALPRESS_TERM_META_KEY ][ $field['name'] ], $sanitize );
			}
		}
		update_term_meta( $term_id, REALPRESS_TERM_META_KEY, $data );
	}

	public function modify_energy_class_term_custom_column( $result, $column_name, $term_id ) {
		if ( $column_name === 'action' ) {
			return '<a href="' . get_term_link( $term_id ) . '">' . esc_html__( 'View', 'realpress' ) . '</a>';
		}

		return $result;
	}

	public function sort_energy_class_term_column( $sortable_columns ) {
		if ( isset( $sortable_columns['description'] ) ) {
			unset( $sortable_columns['description'] );
		}

		$sortable_columns['action'] = 'action';

		return $sortable_columns;
	}

	public function modify_energy_class_term_column_headers( $column_headers ) {
		if ( isset( $column_headers['description'] ) ) {
			unset( $column_headers['description'] );
		}
		$column_headers['action'] = esc_html__( 'Action', 'realpress' );

		return $column_headers;
	}
}

