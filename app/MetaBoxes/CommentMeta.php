<?php

namespace RealPress\MetaBoxes;

use RealPress\Helpers\Config;
use RealPress\Helpers\Template;
use RealPress\Helpers\Validation;

/**
 * Class CommentMeta
 * @package RealPress\MetaBoxes
 */
class CommentMeta {
	/**
	 * @var array|mixed
	 */
	private $config = array();

	/**
	 * MetaFieldsController constructor.
	 */
	public function __construct() {
		$this->config = Config::instance()->get( 'comment-metabox' );
		add_action( 'add_meta_boxes', array( $this, 'add_comment_metaboxes' ), 10, 2 );
		add_action( 'edit_comment', array( $this, 'save_comment_metaboxes' ), 10, 1 );
	}

	public function add_comment_metaboxes( $type, $comment ) {
		if ( $type !== 'comment' ) {
			return;
		}

		if ( $comment->comment_type !== 'property' ) {
			return;
		}

		add_meta_box(
			$this->config['id'],
			$this->config['name'],
			array( $this, 'render_metaboxes' ),
			array( 'comment' ),
			$this->config['context'],
			$this->config['priority'],
		);
	}

	/**
	 * @param $post
	 *
	 * @return void
	 */
	public function render_metaboxes( $comment ) {
		$config = $this->config;
		$data   = $this->get_review_data( $comment->comment_ID );
		Template::instance()->get_admin_template( 'comment/edit', compact( 'config', 'data' ) );
	}

	/**
	 * @param $post_id
	 * @param $post
	 *
	 * @return mixed|void
	 */
	public function save_comment_metaboxes( $comment_id ) {
		$nonce = Validation::sanitize_params_submitted( $_POST['realpress_admin_edit_review_name'] ?? '' );
		if ( empty( $nonce ) || ! wp_verify_nonce( $nonce, 'realpress_admin_edit_review_action' ) ) {
			return $comment_id;
		}

		//set default data when save empty data
		$old_data = $this->get_review_data( $comment_id );
		$new_data = array();
		foreach ( $old_data as $name => $value ) {
			$key = Validation::sanitize_params_submitted( isset( $_POST[ REALPRESS_PROPERTY_REVIEW_META_KEY ][ $name ] ) );
			if ( $key ) {
				$field             = Config::instance()->get( 'comment-metabox:' . $name );
				$sanitize          = $field['sanitize'] ?? 'text';
				$value             = Validation::sanitize_params_submitted( $_POST[ REALPRESS_PROPERTY_REVIEW_META_KEY ][ $name ], $sanitize );
				$new_data[ $name ] = $value;
				if ( ! empty( $field['is_single_key'] ) ) {
					update_comment_meta( $comment_id, REALPRESS_PREFIX . '_' . $name, $value );
				}
			} else {
				$new_data[ $name ] = '';
			}
		}
		update_comment_meta( $comment_id, REALPRESS_PROPERTY_REVIEW_META_KEY, $new_data );
	}

	/**
	 * @param $post_id
	 *
	 * @return array|mixed
	 */
	public function get_review_data( $comment_id ) {
		$data = array();
		if ( $comment_id ) {
			$data = get_comment_meta( $comment_id, REALPRESS_PROPERTY_REVIEW_META_KEY, true );
		}
		if ( empty( $data ) ) {
			$data = Config::instance()->get_default_data( $this->config );
		}

		return $data;
	}
}

