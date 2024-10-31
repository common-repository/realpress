<?php

namespace RealPress\Controllers;

use RealPress\Helpers\RestApi;
use RealPress\Helpers\Template;
use RealPress\Helpers\Validation;
use RealPress\Helpers\Config;
use RealPress\Helpers\User;
use RealPress\Models\UserModel;
use WP_REST_Server;
use RealPress\Models\CommentModel;


/**
 * Class CommentController
 * @package RealPress\Controllers
 */
class CommentController {
	public function __construct() {
		add_action( 'rest_api_init', array( $this, 'register_rest_routes' ) );
		add_filter( 'admin_comment_types_dropdown', array( $this, 'add_review_comment_filter' ) );
		add_action( 'deleted_comment', array( $this, 'handle_delete_property_review' ), 10, 2 );
		add_action( 'transition_comment_status', array( $this, 'change_comment_status' ), 10, 3 );
	}

	public function change_comment_status( $new_status, $old_status, $comment ) {
		if ( $new_status === 'publish' ) {
			return;
		}
		$average_review = CommentModel::get_average_reviews( $comment->comment_post_ID, 'property' );
		update_post_meta( $comment->comment_post_ID, REALPRESS_PREFIX . '_property_average_review', $average_review );
	}

	public function handle_delete_property_review( $comment_id, $comment ) {
		if ( $comment->comment_type !== 'property' ) {
			$average_review = CommentModel::get_average_reviews( $comment->comment_post_ID, 'property' );
			update_post_meta( $comment->comment_post_ID, REALPRESS_PREFIX . '_property_average_review', $average_review );
		}
	}

	public function add_review_comment_filter( array $comment_types ): array {
		$comment_types['property'] = esc_html__( 'Property Reviews', 'realpress' );
		$comment_types['agent']    = esc_html__( 'Agent Comments', 'realpress' );

		return $comment_types;
	}

	public function register_rest_routes() {
		register_rest_route(
			RestApi::generate_namespace(),
			'/comments',
			array(
				array(
					'methods'             => WP_REST_Server::CREATABLE,
					'args'                => array(
						'email'   => array(
							'type'                => 'string',
							'permission_callback' => '__return_true',
						),
						'rating'  => array(
							'type'                => 'integer',
							'permission_callback' => '__return_true',
						),
						'content' => array(
							'type'                => 'string',
							'permission_callback' => '__return_true',
						),
					),
					'callback'            => array( $this, 'post_comment' ),
					'permission_callback' => '__return_true',
				),
				array(
					'methods'             => WP_REST_Server::READABLE,
					'args'                => array(
						'offset'         => array(
							'type'                => 'integer',
							'permission_callback' => '__return_true',
							'default'             => 1,
						),
						'posts_per_page' => array(
							'type'                => 'integer',
							'permission_callback' => '__return_true',
							'default'             => 5,
						),
						'orderby'        => array(
							'type'                => 'string',
							'permission_callback' => '__return_true',
							'default'             => 'date',
						),
						'order'          => array(
							'type'                => 'string',
							'permission_callback' => '__return_true',
							'default'             => 'ASC',
						),
					),
					'callback'            => array( $this, 'get_comments' ),
					'permission_callback' => '__return_true',
				),
			)
		);
	}

	public function get_comments( \WP_REST_Request $request ) {
		$params = $request->get_params();
		$args   = array(
			'type'             => $params['type'] ?? 'property',
			'comment_approved' => $params['status'] ?? 1,
			'paged'            => $params['offset'] ?? 1,
			'number'           => $params['posts_per_page'] ?? 5,
			'orderby'          => $params['orderby'] ?? 'comment_date',
			'order'            => $params['order'] ?? 'ASC',
		);

		if ( $args['type'] === 'property' ) {
			$args['post_id'] = $params['property_id'];
		} elseif ( $args['type'] === 'agent' ) {
			$args['post_id'] = $params['user_id'];
		}

		$data = array();
		if ( $args['orderby'] === 'rating' ) {
			$args['meta_key'] = REALPRESS_PREFIX . '_fields:review_stars';
			$args['orderby']  = 'meta_value_num';
		}

		$comments = get_comments( $args );

		if ( empty( $comments ) ) {
			if ( $args['type'] === 'property' ) {
				return RestApi::success( esc_html__( 'There are no reviews yet.', 'realpress' ), array() );
			} elseif ( $args['type'] === 'agent' ) {
				return RestApi::success( esc_html__( 'There are no comments yet.', 'realpress' ), array() );
			}
		}

		//Content
		$template = Template::instance();
		ob_start();
		foreach ( $comments as $comment ) {
			if ( $args['type'] === 'property' ) {
				$template->get_frontend_template_type_classic( 'single-property/reviews/list-review.php', compact( 'comment' ) );
			} elseif ( $args['type'] === 'agent' ) {
				$template->get_frontend_template_type_classic( 'agent-detail/comments/comment-item.php', compact( 'comment' ) );
			}
		}
		$data['content'] = ob_get_clean();
		//Paginate
		$comment_total = CommentModel::get_comment_total( $args['post_id'], $args['type'] );

		$max_pages = ceil( $comment_total / $args['number'] );
		ob_start();
		$template->get_frontend_template_type_classic(
			'shared/pagination.php',
			array(
				'max_page'     => $max_pages,
				'current_page' => $args['paged'],
			)
		);
		$data ['pagination'] = ob_get_clean();
		$data ['totals']     = $comment_total;

		return RestApi::success( '', $data );
	}

	public function post_comment( \WP_REST_Request $request ) {
		$params = $request->get_params();

		if ( ! is_user_logged_in() ) {
			return RestApi::error( esc_html__( 'You must login to submit review', 'realpress' ), 401 );
		}

		if ( $params['type'] === 'property' && empty( $params['rating'] ) ) {
			return RestApi::error( esc_html__( 'The rating is required', 'realpress' ), 400 );
		}

		if ( empty( $params['content'] ) ) {
			if ( $params['type'] === 'property' ) {
				return RestApi::error( esc_html__( 'The review content is required', 'realpress' ), 400 );
			}
			if ( $params['type'] === 'agent' ) {
				return RestApi::error( esc_html__( 'The comment content is required', 'realpress' ), 400 );
			}
		}

		$content = Validation::sanitize_params_submitted( $params['content'], 'textarea' );

		$comment_data = array(
			'comment_approved'  => 1,
			'comment_content'   => $content,
			'comment_type'      => $params['type'] ?? 'property',
			'comment_author_IP' => User::get_client_IP(),
		);

		if ( $comment_data['comment_type'] === 'property' ) {
			$comment_data['comment_post_ID'] = $params['property_id'];
		} elseif ( $comment_data['comment_type'] === 'agent' ) {
			$comment_data['comment_post_ID'] = $params['user_id'];
		}

		$user_id                              = get_current_user_id();
		$comment_data['comment_author']       = UserModel::get_field( $user_id, 'display_name' );
		$comment_data['comment_author_url']   = UserModel::get_field( $user_id, 'user_url' );
		$comment_data['comment_author_email'] = UserModel::get_field( $user_id, 'user_email' );

		if ( CommentModel::is_comment_exist( $comment_data['comment_post_ID'], $comment_data['comment_author_email'], $comment_data['comment_type'] ) ) {
			if ( $comment_data['comment_type'] === 'property' ) {
				return RestApi::error( esc_html__( 'You\'ve already posted review', 'realpress' ), 409 );
			} elseif ( $comment_data['comment_type'] === 'agent' ) {
				return RestApi::error( esc_html__( 'You\'ve already posted comment', 'realpress' ), 409 );
			}
		}

		$comment_data['user_id'] = $user_id;
		$comment_id              = wp_insert_comment( $comment_data );

		if ( ! empty( $comment_id ) && $comment_data['comment_type'] === 'property' ) {
			//Update review meta data
			$rating           = Validation::sanitize_params_submitted( $params['rating'], 'text' );
			$review_meta_data = array(
				'fields:review_stars' => $rating,
			);
			update_comment_meta( $comment_id, REALPRESS_PROPERTY_REVIEW_META_KEY, $review_meta_data );
			foreach ( $review_meta_data as $key => $value ) {
				$field = Config::instance()->get( 'comment-metabox:' . $key );
				if ( ! empty( $field['is_single_key'] ) ) {
					update_comment_meta( $comment_id, REALPRESS_PREFIX . '_' . $key, $value );
				}
			}

			//Update average review
			$average_review = CommentModel::get_average_reviews( $comment_data['comment_post_ID'], $comment_data['comment_type'] );
			update_post_meta( $comment_data['comment_post_ID'], REALPRESS_PREFIX . '_property_average_review', $average_review );
		}

		if ( $comment_data['comment_type'] === 'property' ) {
			return RestApi::success(
				esc_html__( 'Review has been submitted successfully! ', 'realpress' ),
				array(
					'id' => $comment_id,
				)
			);
		} elseif ( $comment_data['comment_type'] === 'agent' ) {
			return RestApi::success(
				esc_html__( 'Comment has been submitted successfully! ', 'realpress' ),
				array(
					'id' => $comment_id,
				)
			);
		}
	}
}
