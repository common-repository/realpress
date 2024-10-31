<?php

namespace RealPress\Controllers;

use RealPress\Helpers\Page;
use RealPress\Helpers\RestApi;
use RealPress\Models\UserModel;
use WP_REST_Server;

class ContactFormController {
	public function __construct() {
		add_action( 'rest_api_init', array( $this, 'register_rest_routes' ) );
		add_action( 'wp_body_open', array( $this, 'add_contact_form_popup' ) );
	}

	/**
	 * @return void
	 */
	public function register_rest_routes() {
		register_rest_route(
			RestApi::generate_namespace(),
			'/contact-form',
			array(
				'methods'             => WP_REST_Server::CREATABLE,
				'callback'            => array( $this, 'send_message' ),
				'permission_callback' => '__return_true',
			),
		);
	}

	/**
	 * @param \WP_REST_Request $request
	 *
	 * @return \WP_REST_Response
	 */
	public function send_message( \WP_REST_Request $request ) {
		$params = $request->get_params();

		if ( empty( $params['email_target'] ) ) {
			return RestApi::error( esc_html__( 'The email target is required', 'realpress' ), 400 );
		}

		if ( empty( $params['name'] ) ) {
			return RestApi::error( esc_html__( 'The name field is required', 'realpress' ), 400 );
		}

		if ( empty( $params['phone'] ) ) {
			return RestApi::error( esc_html__( 'The phone field is required', 'realpress' ), 400 );
		}

		if ( empty( $params['email'] ) ) {
			return RestApi::error( esc_html__( 'The email field required', 'realpress' ), 400 );
		}

		if ( ! is_email( $params['email'] ) ) {
			return RestApi::error( esc_html__( 'The email is invalid', 'realpress' ), 400 );
		}

		if ( empty( $params['message'] ) ) {
			return RestApi::error( esc_html__( 'The message field is required', 'realpress' ), 400 );
		}

		if ( empty( $params['terms_and_conditions'] ) ) {
			return RestApi::error( esc_html__( 'Please accept Terms and Conditions', 'realpress' ), 400 );
		}

		$args = array(
			'name'    => $params['name'],
			'phone'   => $params['phone'],
			'email'   => $params['email'],
			'message' => $params['message'],
		);

		$subject = $this->generate_email_subject( $args );
		$content = $this->generate_email_content( $args );

		$header = $this->get_email_header();

		$send_message = wp_mail( $params['email_target'], $subject, $content, $header );

		if ( $send_message ) {
			return RestApi::success( esc_html__( 'Send email successfully!', 'realpress' ) );
		} else {
			return RestApi::error( esc_html__( 'Server Error: Make sure Email function working on your server!', 'realpress' ), 422 );
		}
	}

	/**
	 * @return void
	 */
	public function add_contact_form_popup() {
		if ( ! Page::is_agent_detail_page() ) {
			return;
		}
		$agent_id     = get_queried_object()->ID;
		$avatar_url   = UserModel::get_user_avatar( $agent_id );
		$display_name = UserModel::get_field( $agent_id, 'display_name' );
		?>
        <div class="realpress-agent-contact-form">
            <div class="realpress-agent-contact-form-inner">
                <span class="realpress-agent-contact-form-close"><i class="fas fa-window-close"></i></span>
                <div class="realpress-agent-contact-form-header">
                    <img src="<?php echo esc_attr( $avatar_url ); ?>" alt="<?php echo esc_attr( $display_name ); ?>">
                    <span><?php echo esc_html( $display_name ); ?></span>
                </div>
				<?php
				echo do_shortcode( esc_html( '[realpress_contact_form user_id =' . $agent_id . ']' ) );
				?>
            </div>
        </div>
		<?php
	}

	/**
	 * @return mixed|void
	 */
	public function get_email_header() {
		return apply_filters( 'realpress/agent-contact-form/email/headers', array( 'Content-Type: text/html;' ) );
	}

	/**
	 * @param $args
	 *
	 * @return mixed|void
	 */
	public function generate_email_subject( $args ) {
		$subject = '';

		if ( ! empty( $args['name'] ) ) {
			$subject = sprintf( esc_html__( ' New message sent by %s using agent contact form', 'realpress' ), $args['name'] );
		}

		return apply_filters( 'realpress/agent-contact-form/email/subject', $subject, $args );
	}

	public function generate_email_content( $args ) {
		$content = '';
		if ( ! empty( $args['name'] ) ) {
			$content .= sprintf( esc_html__( ' You have received new message from: %s', 'realpress' ), $args['name'] );
			$content .= '<br>';
		}
		if ( ! empty( $args['phone'] ) ) {
			$content .= sprintf( esc_html__( ' Phone: %s', 'realpress' ), $args['phone'] );
			$content .= '<br>';
		}

		if ( ! empty( $args['email'] ) ) {
			$content .= sprintf( esc_html__( ' Email: %s', 'realpress' ), $args['email'] );
			$content .= '<br>';
		}

		if ( ! empty( $args['message'] ) ) {
			$content .= sprintf( esc_html__( ' Message: %s', 'realpress' ), $args['message'] );
			$content .= '<br>';
		}

		return apply_filters( 'realpress/agent-contact-form/email/content', $content, $args );
	}
}
