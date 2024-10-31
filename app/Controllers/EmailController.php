<?php

namespace RealPress\Controllers;

use RealPress\Helpers\Settings;
use RealPress\Models\UserModel;

class EmailController {
	private $user_id;

	public function __construct() {
		add_action( 'user_register', array( $this, 'register_new_user' ) );
		add_action( 'transition_post_status', array( $this, 'send_email_review_property' ), 10, 3 );
		add_action( 'save_post', array( $this, 'handle_save_property' ), 10, 2 );
		add_action(
			'realpress/agent/become-an-agent/request',
			array(
				$this,
				'request_become_an_agent',
			),
			10,
			2
		);
		add_action(
			'realpress/agent/become-an-agent/approve',
			array( $this, 'send_email_approve_become_an_agent' )
		);
		add_action(
			'realpress/agent/become-an-agent/reject',
			array( $this, 'send_email_reject_become_an_agent' )
		);
	}

	/**
	 * @return int|mixed|string
	 */
	private function to() {
		return UserModel::get_field( $this->user_id, 'user_email' );
	}

	/**
	 * @return false|mixed|void
	 */
	private function to_admin() {
		return get_option( 'admin_email' );
	}

	/**
	 * @param $content
	 * @param string $post_id
	 *
	 * @return array|string|string[]
	 */
	private function generate_replace( $content, string $post_id = '' ) {
		$display_name   = UserModel::get_field( $this->user_id, 'display_name' );
		$post_title     = '';
		$post_permalink = '';

		if ( ! empty( $post_id ) ) {
			$post_title     = get_the_title( $post_id );
			$post_permalink = get_permalink( $post_id );
		}

		return str_replace(
			array(
				'{{user_name}}',
				'{{post_title}}',
				'{{post_permalink}}',
				'{{site_url}}',
				'{{site_title}}',
				'{{admin_email}}',
			),
			array(
				$display_name,
				$post_title,
				$post_permalink,
				get_site_url(),
				get_bloginfo( 'name' ),
				get_option( 'admin_email' ),
			),
			$content
		);
	}

	/**
	 * @param $user_id
	 *
	 * @return void
	 */
	public function register_new_user( $user_id ) {
		$this->user_id = $user_id;
		$this->send_register_account_to_admin( $user_id );
		$this->send_regiter_account_to_user( $user_id );
	}

	/**
	 * @param $user_id
	 *
	 * @return void
	 */
	private function send_register_account_to_admin( $user_id ) {
		$enable = Settings::get_setting_detail( 'group:email:section:register_new_user:object:admin:fields:enable' );

		if ( empty( $enable ) ) {
			return;
		}

		$subject = Settings::get_setting_detail( 'group:email:section:register_new_user:object:admin:fields:subject' );

		if ( empty( $subject ) ) {
			return;
		}

		$content = Settings::get_setting_detail( 'group:email:section:register_new_user:object:admin:fields:content' );

		if ( empty( $content ) ) {
			return;
		}

		$subject = $this->generate_replace( $subject );
		$content = $this->generate_replace( $content );
		wp_mail( $this->to_admin(), $subject, $content, $this->get_headers() );
	}

	/**
	 * @param $user_id
	 *
	 * @return void
	 */
	private function send_regiter_account_to_user( $user_id ) {
		$enable = Settings::get_setting_detail( 'group:email:section:register_new_user:object:user:fields:enable' );

		if ( empty( $enable ) ) {
			return;
		}

		$subject = Settings::get_setting_detail( 'group:email:section:register_new_user:object:user:fields:subject' );

		if ( empty( $subject ) ) {
			return;
		}

		$content = Settings::get_setting_detail( 'group:email:section:register_new_user:object:user:fields:content' );

		if ( empty( $content ) ) {
			return;
		}

		$subject = $this->generate_replace( $subject );
		$content = $this->generate_replace( $content );

		wp_mail( $this->to(), $subject, $content, $this->get_headers() );
	}

	/**
	 * @param $new_status
	 * @param $old_status
	 * @param $post
	 *
	 * @return void
	 */
	public function send_email_review_property( $new_status, $old_status, $post ) {
		if ( $old_status !== 'auto-draft' || $new_status !== 'pending' ) {
			return;
		}

		if ( Settings::get_setting_detail( 'group:property:fields:approved_method' ) === 'automatic_publish' ) {
			return;
		}

		if ( $post->post_type !== REALPRESS_PROPERTY_CPT ) {
			return;
		}

		if ( $post->post_status !== 'pending' ) {
			return;
		}
		$this->user_id = get_post_field( 'post_author', $post );

		$this->send_email_review_property_to_user( $post->ID );
		$this->send_email_review_property_to_admin( $post->ID );
	}

	/**
	 * @param $post_id
	 *
	 * @return void
	 */
	private function send_email_review_property_to_user( $post_id ) {
		$enable = Settings::get_setting_detail( 'group:email:section:request_review_property:object:agent:fields:enable' );

		if ( empty( $enable ) ) {
			return;
		}

		$subject = Settings::get_setting_detail( 'group:email:section:request_review_property:object:agent:fields:subject' );

		if ( empty( $subject ) ) {
			return;
		}

		$content = Settings::get_setting_detail( 'group:email:section:request_review_property:object:agent:fields:content' );

		if ( empty( $content ) ) {
			return;
		}

		$subject = $this->generate_replace( $subject, $post_id );
		$content = $this->generate_replace( $content, $post_id );

		wp_mail( $this->to(), $subject, $content, $this->get_headers() );
	}

	/**
	 * @param $post_id
	 *
	 * @return void
	 */
	private function send_email_review_property_to_admin( $post_id ) {
		$enable = Settings::get_setting_detail( 'group:email:section:request_review_property:object:admin:fields:enable' );

		if ( empty( $enable ) ) {
			return;
		}

		$subject = Settings::get_setting_detail( 'group:email:section:request_review_property:object:admin:fields:subject' );

		if ( empty( $subject ) ) {
			return;
		}

		$content = Settings::get_setting_detail( 'group:email:section:request_review_property:object:admin:fields:content' );

		if ( empty( $content ) ) {
			return;
		}


		$subject = $this->generate_replace( $subject, $post_id );
		$content = $this->generate_replace( $content, $post_id );

		wp_mail( $this->to(), $subject, $content, $this->get_headers() );
	}

	/**
	 * @param $post_id
	 * @param $post
	 *
	 * @return void
	 */
	public function handle_save_property( $post_id, $post ) {
		if ( $post->post_type !== REALPRESS_PROPERTY_CPT ) {
			return;
		}

		$this->user_id = get_post_field( 'post_author', $post_id );
		if ( $post->post_status === 'publish' ) {
			$this->send_email_approved_property( $post_id );
		} elseif ( $post->post_status === 'reject' ) {
			$this->send_email_reject_property( $post_id );
		}
	}

	/**
	 * @param $post_id
	 *
	 * @return void
	 */
	private function send_email_approved_property( $post_id ) {
		$enable = Settings::get_setting_detail( 'group:email:section:approve_property:object:agent:fields:enable' );

		if ( empty( $enable ) ) {
			return;
		}

		$subject = Settings::get_setting_detail( 'group:email:section:approve_property:object:agent:fields:subject' );

		if ( empty( $subject ) ) {
			return;
		}

		$content = Settings::get_setting_detail( 'group:email:section:approve_property:object:agent:fields:content' );

		if ( empty( $content ) ) {
			return;
		}

		$subject = $this->generate_replace( $subject, $post_id );
		$content = $this->generate_replace( $content, $post_id );

		wp_mail( $this->to(), $subject, $content, $this->get_headers() );
	}

	/**
	 * @param $post_id
	 *
	 * @return void
	 */
	private function send_email_reject_property( $post_id ) {
		$enable = Settings::get_setting_detail( 'group:email:section:reject_property:object:agent:fields:enable' );

		if ( empty( $enable ) ) {
			return;
		}

		$subject = Settings::get_setting_detail( 'group:email:section:reject_property:object:agent:fields:subject' );

		if ( empty( $subject ) ) {
			return;
		}

		$content = Settings::get_setting_detail( 'group:email:section:reject_property:object:agent:fields:content' );

		if ( empty( $content ) ) {
			return;
		}

		$subject = $this->generate_replace( $subject, $post_id );
		$content = $this->generate_replace( $content, $post_id );

		wp_mail( $this->to(), $subject, $content, $this->get_headers() );
	}

	/**
	 * @param $user_id
	 * @param $args
	 *
	 * @return void
	 */
	public function request_become_an_agent( $user_id, $args ) {
		$this->user_id = $user_id;
		$this->send_email_become_agent_request_to_user( $user_id );
		$this->send_email_become_agent_request_to_admin( $user_id, $args );
	}

	/**
	 * @param $user_id
	 *
	 * @return void
	 */
	public function send_email_become_agent_request_to_user( $user_id ) {
		$enable = Settings::get_setting_detail( 'group:email:section:request_become_an_agent:object:user:fields:enable' );

		if ( empty( $enable ) ) {
			return;
		}

		$subject = Settings::get_setting_detail( 'group:email:section:request_become_an_agent:object:user:fields:subject' );

		if ( empty( $subject ) ) {
			return;
		}

		$content = Settings::get_setting_detail( 'group:email:section:request_become_an_agent:object:user:fields:content' );

		if ( empty( $content ) ) {
			return;
		}

		$subject = $this->generate_replace( $subject );
		$content = $this->generate_replace( $content );

		wp_mail( $this->to(), $subject, $content, $this->get_headers() );
	}

	/**
	 * @param $user_id
	 * @param $args
	 *
	 * @return void
	 */
	public function send_email_become_agent_request_to_admin( $user_id, $args ) {
		$enable = Settings::get_setting_detail( 'group:email:section:request_become_an_agent:object:admin:fields:enable' );

		if ( empty( $enable ) ) {
			return;
		}

		$subject = Settings::get_setting_detail( 'group:email:section:request_become_an_agent:object:admin:fields:subject' );

		if ( empty( $subject ) ) {
			return;
		}

		$content = Settings::get_setting_detail( 'group:email:section:request_become_an_agent:object:admin:fields:content' );

		if ( empty( $content ) ) {
			return;
		}

		$subject    = $this->generate_replace( $subject );
		$content    = $this->generate_replace( $content );
		$first_name = UserModel::get_field( $user_id, 'first_name' );
		if ( empty( $first_name ) ) {
			$first_name = $args['first_name'];
		}
		$last_name = UserModel::get_field( $user_id, 'last_name' );
		if ( empty( $last_name ) ) {
			$last_name = $args['last_name'];
		}
		$content = str_replace(
			array( '{{first_name}}', '{{last_name}}', '{{agency_name}}', '{{phone_number}}', '{{additional_info}}' ),
			array( $first_name, $last_name, $args['agency_name'], $args['phone_number'], $args['additional_info'] ),
			$content
		);

		wp_mail( $this->to(), $subject, $content, $this->get_headers() );
	}

	/**
	 * @param $user_id
	 *
	 * @return void
	 */
	public function send_email_approve_become_an_agent( $user_id ) {
		$this->user_id = $user_id;

		$enable = Settings::get_setting_detail( 'group:email:section:approve_become_an_agent:object:user:fields:enable' );

		if ( empty( $enable ) ) {
			return;
		}

		$subject = Settings::get_setting_detail( 'group:email:section:approve_become_an_agent:object:user:fields:subject' );

		if ( empty( $subject ) ) {
			return;
		}

		$content = Settings::get_setting_detail( 'group:email:section:approve_become_an_agent:object:user:fields:content' );

		if ( empty( $content ) ) {
			return;
		}

		$subject = $this->generate_replace( $subject );
		$content = $this->generate_replace( $content );

		wp_mail( $this->to(), $subject, $content, $this->get_headers() );
	}

	/**
	 * @param $user_id
	 *
	 * @return void
	 */
	public function send_email_reject_become_an_agent( $user_id ) {
		$this->user_id = $user_id;

		$enable = Settings::get_setting_detail( 'group:email:section:reject_become_an_agent:object:user:fields:enable' );

		if ( empty( $enable ) ) {
			return;
		}

		$subject = Settings::get_setting_detail( 'group:email:section:reject_become_an_agent:object:user:fields:subject' );

		if ( empty( $subject ) ) {
			return;
		}

		$content = Settings::get_setting_detail( 'group:email:section:reject_become_an_agent:object:user:fields:content' );

		if ( empty( $content ) ) {
			return;
		}

		$subject = $this->generate_replace( $subject );
		$content = $this->generate_replace( $content );

		wp_mail( $this->to(), $subject, $content, $this->get_headers() );
	}

	/**
	 * @return mixed|void
	 */
	private function get_headers() {
		return apply_filters( 'realpress/email/headers', array( 'Content-Type: text/html;' ) );
	}
}
