<?php

namespace RealPress\Controllers;

use RealPress\Models\UserModel;
use RealPress\Helpers\RestApi;
use WP_User_Query;
use RealPress\Helpers\Template;
use RealPress\Helpers\Settings;
use WP_REST_Server;

/**
 * Class UserController
 * @package RealPress\Controllers
 */
class UserController {
	/**
	 * UserController constructor.
	 */
	public function __construct() {
		add_filter( 'get_avatar', array( $this, 'change_user_avatar' ), 10, 5 );
		add_action( 'init', array( $this, 'create_new_user_role' ) );
		add_action( 'rest_api_init', array( $this, 'register_rest_routes' ) );
	}

	/**
	 * @return void
	 */
	public function register_rest_routes() {
		register_rest_route(
			RestApi::generate_namespace(),
			'/agents',
			array(
				'methods'             => WP_REST_Server::READABLE,
				'callback'            => array( $this, 'get_agents' ),
				'args'                => array(
					'posts_per_page' => array(
						'required'    => false,
						'type'        => 'integer',
						'description' => 'The posts per page must be an integer',
					),
					'offset'         => array(
						'required'    => false,
						'type'        => 'integer',
						'description' => 'The offset must be an integer',
					),
				),
				'permission_callback' => '__return_true',
			),
		);
	}

	/**
	 * @param \WP_REST_Request $request
	 *
	 * @return \WP_REST_Response
	 */
	public function get_agents( \WP_REST_Request $request ) {
		$params = $request->get_params();
		$args   = array(
			'number'  => $params['number'] ?? Settings::get_agent_per_page(),
			'paged'   => $params['offset'] ?? 1,
			'orderby' => $params['orderby'] ?? 'display_name',
			'order'   => $params['order'] ?? 'asc',
			'role'    => REALPRESS_AGENT_ROLE,
		);

		//Search
		if ( isset( $params['display_name'] ) ) {
			$args['search']         = '*' . $params['display_name'] . '*';
			$args['search_columns'] = array( 'display_name' );
		}

		if ( isset( $params['company_name'] ) ) {
			$args['meta_query'][] = array(
				'key'     => REALPRESS_PREFIX . '_user_profile:fields:company_name',
				'value'   => $params['company_name'],
				'compare' => 'LIKE',
			);
		}

		if ( ! empty( $args['meta_query'] ) ) {
			$args['meta_query']['relation'] = 'AND';
		}

		$data   = array();
		$query  = new WP_User_Query( $args );
		$agents = $query->get_results();

		$template = Template::instance();
		//Content
		ob_start();
		if ( empty( $agents ) ) {
			return RestApi::success( esc_html__( 'No Agents found', 'realpress' ), array() );
		} else {
			foreach ( $agents as $agent ) {
				$agent_id = $agent->ID;
				if ( has_action( 'realpress/agent-list/agent' ) ) {
					do_action( 'realpress/agent-list/agent', $agent_id );
				} else {
					$template->get_frontend_template_type_classic( 'agent-list/agent-item.php', compact( 'agent_id' ) );
				}
			}
		}

		$data['content'] = ob_get_clean();

		//Paginate
		ob_start();
		$current_page = $args['paged'];
		$totals       = $query->get_total();
		$max_pages    = intval( ceil( $totals / $args['number'] ) );
		$from         = 1 + ( $current_page - 1 ) * $args['number'];
		$to           = ( $current_page * $args['number'] > $totals ) ? $totals : $current_page * $args['number'];
		if ( 0 === $totals ) {
			$from_to = '';
		} elseif ( 1 === $totals ) {
			$from_to = esc_html__( 'Showing only one result', 'realpress' );
		} else {
			if ( $from == $to ) {
				$from_to = sprintf( esc_html__( 'Showing last Agent of %s results', 'realpress' ), $totals );
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

	/**
	 * @param $avatar
	 * @param $id_or_email
	 * @param $size
	 * @param $default
	 * @param $alt
	 *
	 * @return mixed|string
	 */
	public function change_user_avatar( $avatar, $id_or_email, $size, $default, $alt ) {
		if ( is_object( $id_or_email ) ) {
			if ( empty( $id_or_email->user_id ) ) {
				$user_id = (int) $id_or_email->user_id;
			}
		} elseif ( ! is_numeric( $id_or_email ) ) {
			$user = get_user_by( 'email', $id_or_email );
			if ( ! empty( $user ) ) {
				$user_id = $user->user_id;
			}
		} else {
			$user_id = $id_or_email;
		}

		if ( ! empty( $user_id ) ) {
			$meta_data = UserModel::get_user_meta_data( $user_id );
			$url       = $meta_data['user_profile:fields:profile_picture']['image_url'] ?? '';

			if ( ! empty( $url ) ) {
				$avatar
					= "<img alt='{$alt}' src='{$url}' class='avatar avatar-{$size} photo' height='{$size}' width='{$size}' />";
			}
		}

		return $avatar;
	}

	/**
	 * @return void
	 */
	public function create_new_user_role() {
		add_role(
			REALPRESS_AGENT_ROLE,
			esc_html__( 'Agent', 'realpress' ),
			array(
				'read'                            => true,
				'edit_realpress-properties'             => true,
				'read_private_realpress-properties'     => true,
				'delete_realpress-properties'           => true,
				'delete_private_realpress-properties'   => true,
				'delete_published_realpress-properties' => true,
				'edit_private_realpress-properties'     => true,
				'edit_published_realpress-properties'   => true,
				'upload_files'                    => true,
			)
		);
		$role                     = get_role( REALPRESS_AGENT_ROLE );
		$property_approved_method = Settings::get_setting_detail( 'group:property:fields:approved_method' );
		if ( $property_approved_method === 'automatic_publish' ) {
			$role->add_cap( 'publish_realpress-properties' );
		} else {
			$role->remove_cap( 'publish_realpress-properties' );
		}

		$caps = array(
			'edit_realpress-properties',
			'edit_others_realpress-properties',
			'edit_published_realpress-properties',
			'publish_realpress-properties',
			'delete_realpress-properties',
			'delete_others_realpress-properties',
			'delete_published_realpress-properties',
			'delete_private_realpress-properties',
			'edit_private_realpress-properties',
			'read_private_realpress-properties',
		);

		$role = get_role( 'administrator' );
		foreach ( $caps as $cap ) {
			$role->add_cap( $cap );
		}
	}
}

