<?php

namespace RealPress\Controllers;

use RealPress\Helpers\RestApi;
use RealPress\Helpers\Settings;
use RealPress\Helpers\Template;
use WP_REST_Server;

/**
 * WishListController
 */
class WishListController {
	public function __construct() {
		add_action( 'rest_api_init', array( $this, 'register_rest_routes' ) );
	}

	/**
	 * @return void
	 */
	public function register_rest_routes() {
		register_rest_route(
			RestApi::generate_namespace(),
			'/user/favorite',
			array(
				array(
					'methods'             => WP_REST_Server::CREATABLE,
					'callback'            => array( $this, 'toggle_wishlist' ),
					'args'                => array(
						'property_id' => array(
							'required'    => false,
							'type'        => 'integer',
							'description' => 'The property id is required',
						),
					),
					'permission_callback' => function () {
						return is_user_logged_in();
					},
				),
				array(
					'methods'             => WP_REST_Server::READABLE,
					'callback'            => array( $this, 'get_user_wishlist' ),
					'permission_callback' => function () {
						return is_user_logged_in();
					},
				),
			)
		);
	}

	/**
	 * @param \WP_REST_Request $request
	 *
	 * @return \WP_REST_Response
	 */
	public function toggle_wishlist( \WP_REST_Request $request ) {
		$user_id     = get_current_user_id();
		$property_id = $request->get_param( 'property_id' );

		$wishlist = get_user_meta( $user_id, REALPRESS_PREFIX . '_my_wishlist', true );
		$data     = array();
		if ( empty( $wishlist ) ) {
			$meta_id       = update_user_meta( $user_id, REALPRESS_PREFIX . '_my_wishlist', [ $property_id ] );
			$data['added'] = ! empty( $meta_id );
		} else {
			if ( in_array( $property_id, $wishlist ) ) {
				$key = array_search( $property_id, $wishlist );
				unset( $wishlist[ $key ] );
				if ( empty( $wishlist ) ) {
					$data['removed'] = delete_user_meta( $user_id, REALPRESS_PREFIX . '_my_wishlist' );
				} else {
					$meta_id         = update_user_meta( $user_id, REALPRESS_PREFIX . '_my_wishlist', $wishlist );
					$data['removed'] = ! empty( $meta_id );
				}
			} else {
				$wishlist[]    = $property_id;
				$meta_id       = update_user_meta( $user_id, REALPRESS_PREFIX . '_my_wishlist', $wishlist );
				$data['added'] = ! empty( $meta_id );
			}
		}

		return RestApi::success( '', $data );
	}

	/**
	 * @param \WP_REST_Request $request
	 *
	 * @return \WP_REST_Response
	 */
	public function get_user_wishlist( \WP_REST_Request $request ) {
		$user_id  = get_current_user_id();
		$wishlist = get_user_meta( $user_id, REALPRESS_PREFIX . '_my_wishlist', true );
		$params   = $request->get_params();
		$args     = array(
			'posts_per_page' => $params['posts_per_page'] ?? Settings::get_property_per_page(),
			'paged'          => $params['offset'] ?? 1,
			'orderby'        => $params['orderby'] ?? 'date',
			'order'          => $params['order'] ?? 'asc',
			'post_type'      => REALPRESS_PROPERTY_CPT,
			'post__in'       => empty( $wishlist ) ? array() : $wishlist,
		);

		$data = array();

		$query    = new \WP_Query( $args );
		$template = Template::instance();

		ob_start();
		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
				$template->get_frontend_template_type_classic(
					apply_filters( 'realpress/layout/wishlist/property-item', 'wishlist/property-item.php' )
				);
			}
			wp_reset_postdata();
		} else {
			return RestApi::success( esc_html__( 'No properties found', 'realpress' ), array() );
		}

		$data['content'] = ob_get_clean();

		//Paginate
		ob_start();
		$current_page = $args['paged'];
		$max_pages    = intval( $query->max_num_pages );
		$totals       = $query->found_posts;
		$from         = 1 + ( $current_page - 1 ) * $args['posts_per_page'];
		$to           = ( $current_page * $args['posts_per_page'] > $totals ) ? $totals : $current_page * $args['posts_per_page'];
		if ( 0 === $totals ) {
			$from_to = '';
		} elseif ( 1 === $totals ) {
			$from_to = esc_html__( 'Showing only one result', 'realpress' );
		} else {
			if ( $from == $to ) {
				$from_to = sprintf( esc_html__( 'Showing last property of %s results', 'realpress' ), $totals );
			} else {
				$from_to = $from . '-' . $to;
				$from_to = sprintf( esc_html__( 'Showing %1$s of %2$s results', 'realpress' ), $from_to, $totals );
			}
		}

		$template->get_frontend_template_type_classic(
			'shared/pagination.php',
			array(
				'max_page'     => $max_pages,
				'current_page' => $current_page,
			)
		);
		$data ['pagination'] = ob_get_clean();
		$data ['totals']     = $totals;
		$data ['from_to']    = $from_to;

		return RestApi::success( '', $data );
	}
}
