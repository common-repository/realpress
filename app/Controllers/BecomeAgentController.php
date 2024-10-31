<?php

namespace RealPress\Controllers;

use RealPress\Helpers\Validation;
use RealPress\Models\UserModel;
use RealPress\Helpers\RestApi;
use RealPress\Helpers\Settings;
use WP_REST_Server;

/**
 * Class BecomeAgentController
 * @package RealPress\Controllers
 */
class BecomeAgentController {
	/**
	 * BecomeAgentController constructor.
	 */
	public function __construct() {
		add_filter( 'views_users', array( $this, 'views_users' ), 10, 1 );
		add_filter( 'user_row_actions', array( $this, 'user_row_actions' ), 10, 2 );
		add_filter( 'users_list_table_query_args', array( $this, 'display_only_pending_requests' ) );
		add_action( 'rest_api_init', array( $this, 'register_rest_routes' ) );
		add_action( 'admin_init', array( $this, 'handle_become_an_agent' ) );
	}

	public function handle_become_an_agent() {
		if ( ! current_user_can( 'administrator' ) ) {
			return;
		}

		$action  = Validation::sanitize_params_submitted( $_GET['realpress-action'] ?? '' );
		$user_id = Validation::sanitize_params_submitted( $_GET['user_id'] ?? '' );
		if ( empty( $action ) || empty( $user_id ) ) {
			return;
		}

		if ( ! get_user_by( 'id', $user_id ) ) {
			return;
		}

		if ( in_array( $action, array( 'accept-request', 'deny-request' ) ) ) {
			delete_user_meta( $user_id, REALPRESS_PREFIX . '_become_an_agent_request' );

			if ( $action === 'accept-request' ) {
				$user = new \WP_User( $user_id );
				$user->remove_role( 'subscriber' );
				$user->add_role( REALPRESS_AGENT_ROLE );
				do_action( 'realpress/agent/become-an-agent/approve', $user_id );
				wp_redirect( admin_url( 'users.php?realpress-action=accepted-request&user_id=' . $user_id ) );
			} else {
				do_action( 'realpress/agent/become-an-agent/reject', $user_id );
				wp_redirect( admin_url( 'users.php?realpress-action=denied-request&user_id=' . $user_id ) );
			}
			die();
		}
	}

	public function views_users( $views ) {
		$pending_requests = UserModel::get_pending_requests();
		if ( $pending_requests ) {
			$action = Validation::sanitize_params_submitted( $_GET['realpress-action'] ?? '' );
			if ( $action === 'pending-request' ) {
				$class = ' class="current"';
				foreach ( $views as $k => $view ) {
					$views[ $k ] = preg_replace( '!class="current"!', '', $view );
				}
			} else {
				$class = '';
			}

			$views['pending-request'] = '<a href="' . admin_url( 'users.php?realpress-action=pending-request' ) . '"' . $class . '>'
										. sprintf( __( 'Pending Request <span class="count">(%s)</span>', 'realpress' ), count( $pending_requests ) ) . '</a>';
		}

		return $views;
	}

	public function user_row_actions( $actions, $user ) {
		$pending_request = UserModel::get_pending_requests();
		$action          = Validation::sanitize_params_submitted( $_GET['realpress-action'] ?? '' );
		if ( $action === 'pending-request' && $pending_request ) {
			$actions = array();
			if ( in_array( $user->ID, $pending_request ) ) {
				$actions['accept']      = sprintf(
					'<a href="' . admin_url( 'users.php?realpress-action=accept-request&user_id=' . $user->ID ) . '">%s</a>',
					_x( 'Accept', 'pending-request', 'realpress' )
				);
				$actions['delete deny'] = sprintf(
					'<a class="submitdelete" href="' . admin_url( 'users.php?realpress-action=deny-request&user_id=' . $user->ID ) . '">%s</a>',
					_x( 'Deny', 'pending-request', 'realpress' )
				);
			}
		}

		return $actions;
	}

	public function display_only_pending_requests( $args ) {
		$action = Validation::sanitize_params_submitted( $_GET['realpress-action'] ?? '' );
		if ( $action === 'pending-request' ) {
			$args['include'] = UserModel::get_pending_requests();
		}

		return $args;
	}

	public function register_rest_routes() {
		register_rest_route(
			RestApi::generate_namespace(),
			'/become-an-agent',
			array(
				'methods'             => WP_REST_Server::CREATABLE,
				'callback'            => array( $this, 'become_an_agent' ),
				'permission_callback' => '__return_true',
			),
		);
	}

	public function become_an_agent( \WP_REST_Request $request ) {
		$params = $request->get_params();
		$args   = array(
			'first_name'           => $params['first_name'] ?? '',
			'last_name'            => $params['last_name'] ?? '',
			'agency_name'          => $params['agency_name'] ?? '',
			'phone_number'         => $params['phone_number'] ?? '',
			'additional_info'      => $params['additional_info'] ?? '',
			'terms_and_conditions' => $params['terms_and_conditions'] ?? false,
		);

		if ( ! is_user_logged_in() ) {
			return RestApi::error( esc_html__( 'You must login to submit become an agent', 'realpress' ), 401 );
		}

		$user_id    = get_current_user_id();
		$user_roles = UserModel::get_field( $user_id, 'roles' );
		if ( ! in_array( 'subscriber', $user_roles ) ) {
			return RestApi::error( esc_html__( 'You don\'t have permission to do it', 'realpress' ), 403 );
		}

		if ( empty( $args['first_name'] ) ) {
			return RestApi::error( esc_html__( 'The first name is required', 'realpress' ), 400 );
		}

		if ( empty( $args['last_name'] ) ) {
			return RestApi::error( esc_html__( 'The last name is required', 'realpress' ), 400 );
		}

		if ( empty( $args['phone_number'] ) ) {
			return RestApi::error( esc_html__( 'The phone number is required', 'realpress' ), 400 );
		}

		if ( empty( $args['terms_and_conditions'] ) ) {
			return RestApi::error( esc_html__( 'Please accept Terms and Conditions', 'realpress' ), 400 );
		}

		$user              = new \WP_User( $user_id );
		$automatic_approve = Settings::get_setting_detail( 'group:agent:fields:automatically_approve' );
		if ( $automatic_approve ) {
			$user->remove_role( 'subscriber' );
			$user->add_role( REALPRESS_AGENT_ROLE );
			do_action( 'realpress/agent/become-an-agent/approve', $user_id );

			return RestApi::success( esc_html__( 'Thank you! You became an agent', 'realpress' ), array() );
		} else {
			update_user_meta( $user_id, REALPRESS_PREFIX . '_become_an_agent_request', 'yes' );
			do_action( 'realpress/agent/become-an-agent/request', $user_id, $args );

			return RestApi::success( esc_html__( 'Thank you! Your request has been sent', 'realpress' ), array() );
		}
	}
}

