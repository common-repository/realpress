<?php

use RealPress\Helpers\Forms\EmailSettings;
use RealPress\Helpers\Fields\Checkbox;
use RealPress\Helpers\Fields\Text;
use RealPress\Helpers\Fields\WPEditor;

return array(
	'id'      => 'email',
	'title'   => esc_html__( 'Email', 'realpress' ),
	'icon'    => 'dashicons dashicons-email-alt',
	'type'    => new EmailSettings(),
	'section' => array(
		'register_new_user'       => array(
			'id'     => 'register_new_user',
			'title'  => esc_html__( 'Register new user', 'realpress' ),
			'object' => array(
				'admin' => array(
					'fields' => array(
						'enable'  => array(
							'type'    => new Checkbox(),
							'title'   => esc_html__( 'Email', 'realpress' ),
							'id'      => 'admin_register_new_user_enable',
							'label'   => esc_html__( 'Enable/Disable', 'realpress' ),
							'default' => '',
						),
						'subject' => array(
							'type'    => new Text(),
							'id'      => 'admin_register_new_user_subject',
							'title'   => esc_html__( 'Subject', 'realpress' ),
							'default' => esc_html__( '[{{site_title}}] New User Registration.', 'realpress' ),
						),
						'content' => array(
							'type'        => new WPEditor(),
							'id'          => 'admin_register_new_user_content',
							'title'       => esc_html__( 'Content', 'realpress' ),
							'description' => esc_html__( '{{user_name}}, {{site_url}}, {{site_title}}, {{admin_email}}', 'realpress' ),
							'default'     => esc_html__(
								'New user registration on {{site_url}}.
								Username: {{user_name}}',
							),
							'sanitize'    => 'html',
						),
					),
				),
				'user'  => array(
					'fields' => array(
						'enable'  => array(
							'type'    => new Checkbox(),
							'id'      => 'users_register_new_user_enable',
							'title'   => esc_html__( 'Email', 'realpress' ),
							'label'   => esc_html__( 'Enable/Disable', 'realpress' ),
							'default' => '',
						),
						'subject' => array(
							'type'    => new Text(),
							'id'      => 'users_register_new_user_subject',
							'title'   => esc_html__( 'Subject', 'realpress' ),
							'default' => 'Welcome to {{site_url}}!',
						),
						'content' => array(
							'type'        => new WPEditor(),
							'id'          => 'users_register_new_user_content',
							'title'       => esc_html__( 'Content', 'realpress' ),
							'description' => esc_html__( '{{user_name}}, {{site_url}}, {{site_title}}, {{admin_email}}', 'realpress' ),
							'default'     => esc_html__(
								'Hi there,
									Welcome to {{site_title}}!
									If you have any problems, please contact us.
									Thank you!'
							),
							'sanitize'    => 'html',
						),
					),
				),
			),
		),
		'request_review_property' => array(
			'id'     => 'request_review_property',
			'title'  => esc_html__( 'Request review property of Agent', 'realpress' ),
			'object' => array(
				'admin' => array(
					'fields' => array(
						'enable'  => array(
							'type'    => new Checkbox(),
							'id'      => 'admin_request_review_property_enable',
							'title'   => esc_html__( 'Email', 'realpress' ),
							'label'   => esc_html__( 'Enable/Disable', 'realpress' ),
							'default' => '',
						),
						'subject' => array(
							'type'    => new Text(),
							'id'      => 'admin_request_review_property_subject',
							'title'   => esc_html__( 'Subject', 'realpress' ),
							'default' => esc_html__( '[{{site_title}}] New Property Submission.', 'realpress' ),
						),
						'content' => array(
							'type'        => new WPEditor(),
							'id'          => 'admin_request_review_property_content',
							'title'       => esc_html__( 'Content', 'realpress' ),
							'description' => esc_html__( '{{user_name}}, {{site_url}}, {{site_title}}, {{admin_email}}, {{post_title}}, {{post_permalink}}', 'realpress' ),
							'default'     => esc_html__(
								'New Property Submission on {{site_title}} by {{user_name}}.
								The property title is {{post_title}}.'
							),
							'sanitize'    => 'html',
						),
					),
				),
				'agent' => array(
					'fields' => array(
						'enable'  => array(
							'type'    => new Checkbox(),
							'id'      => 'agent_request_review_property_enable',
							'title'   => esc_html__( 'Email', 'realpress' ),
							'label'   => esc_html__( 'Enable/Disable', 'realpress' ),
							'default' => '',
						),
						'subject' => array(
							'type'    => new Text(),
							'id'      => 'agent_request_review_property_subject',
							'title'   => esc_html__( 'Subject', 'realpress' ),
							'default' => esc_html__(
								'[{{site_title}}] New Property Submission.'
							),
						),
						'content' => array(
							'type'        => new WPEditor(),
							'id'          => 'agent_request_review_property_content',
							'title'       => esc_html__( 'Content', 'realpress' ),
							'description' => esc_html__( '{{user_name}}, {{site_url}}, {{site_title}}, {{admin_email}}, {{post_title}}, {{post_permalink}}', 'realpress' ),
							'default'     => esc_html__(
								'Congratulations! Your property - {{post_title}} has been submitted successfully.
								We will review it and contact you shortly.'
							),
							'sanitize'    => 'html',
						),
					),
				),
			),
		),
		'reject_property'         => array(
			'id'     => 'reject_property',
			'title'  => esc_html__( 'Reject property of Agent', 'realpress' ),
			'object' => array(
				'agent' => array(
					'fields' => array(
						'enable'  => array(
							'type'    => new Checkbox(),
							'id'      => 'reject_review_property_enable',
							'title'   => esc_html__( 'Email', 'realpress' ),
							'label'   => esc_html__( 'Enable/Disable', 'realpress' ),
							'default' => '',
						),
						'subject' => array(
							'type'    => new Text(),
							'id'      => 'reject_review_property_subject',
							'title'   => esc_html__( 'Subject', 'realpress' ),
							'default' => esc_html__(
								'[{{site_title}}] Your property submission rejected.'
							),
						),
						'content' => array(
							'type'        => new WPEditor(),
							'id'          => 'reject_review_property_content',
							'title'       => esc_html__( 'Content', 'realpress' ),
							'description' => esc_html__( '{{user_name}}, {{site_url}}, {{site_title}}, {{admin_email}}, {{post_title}}, {{post_permalink}}', 'realpress' ),
							'default'     => esc_html__(
								'Hi {{user_name}}! 
								Unfortunately, Your property - {{post_title}} - has been rejected.'
							),
							'sanitize'    => 'html',
						),
					),
				),
			),
		),
		'approve_property'        => array(
			'id'     => 'approve_property',
			'title'  => esc_html__( 'Approved property of Agent', 'realpress' ),
			'object' => array(
				'agent' => array(
					'fields' => array(
						'enable'  => array(
							'type'    => new Checkbox(),
							'id'      => 'approved_property_of_agent_enable',
							'title'   => esc_html__( 'Email', 'realpress' ),
							'label'   => esc_html__( 'Enable/Disable', 'realpress' ),
							'default' => '',
						),
						'subject' => array(
							'type'    => new Text(),
							'id'      => 'approved_property_of_agent_subject',
							'title'   => esc_html__( 'Subject', 'realpress' ),
							'default' => esc_html__(
								'[{{site_title}}] Your property submission approved.'
							),
						),
						'content' => array(
							'type'        => new WPEditor(),
							'id'          => 'approved_property_of_agent_content',
							'title'       => esc_html__( 'Content', 'realpress' ),
							'description' => esc_html__( '{{user_name}}, {{site_url}}, {{site_title}}, {{admin_email}}, {{post_title}}, {{post_permalink}}', 'realpress' ),
							'default'     => esc_html__(
								'Congratulations! Your property - {{post_title}} - has been approved.'
							),
							'sanitize'    => 'html',
						),
					),
				),
			),
		),
		'request_become_an_agent' => array(
			'id'     => 'request_become_an_agent',
			'title'  => esc_html__( 'Request become an Agent', 'realpress' ),
			'object' => array(
				'admin' => array(
					'fields' => array(
						'enable'  => array(
							'type'    => new Checkbox(),
							'id'      => 'admin_request_become_an_agent_enable',
							'title'   => esc_html__( 'Email', 'realpress' ),
							'label'   => esc_html__( 'Enable/Disable', 'realpress' ),
							'default' => '',
						),
						'subject' => array(
							'type'    => new Text(),
							'id'      => 'admin_request_become_an_agent_subject',
							'title'   => esc_html__( 'Subject', 'realpress' ),
							'default' => esc_html__(
								'[{{site_title}}] Request to become an Agent.'
							),
						),
						'content' => array(
							'type'        => new WPEditor(),
							'id'          => 'admin_request_become_an_agent_content',
							'title'       => esc_html__( 'Content', 'realpress' ),
							'description' => esc_html__( '{{user_name}}, {{site_url}}, {{site_title}}, {{admin_email}}, {{first_name}}, {{last_name}}, {{agency_name}}, {{phone_number}}, {{additional_info}}', 'realpress' ),
							'default'     => esc_html__(
								'User {{first_name}} {{last_name}} has requested to become an Agent at {{site_title}}.
									Agency Name: {{agency_name}}
									Phone: {{phone_number}}
									Additional info: {{additional_info}}
									Please login to {{site_title}} and access admin user manager to manage the requesting.'
							),
							'sanitize'    => 'html',
						),
					),
				),
				'user'  => array(
					'fields' => array(
						'enable'  => array(
							'type'    => new Checkbox(),
							'id'      => 'users_request_become_an_agent_enable',
							'title'   => esc_html__( 'Email', 'realpress' ),
							'label'   => esc_html__( 'Enable/Disable', 'realpress' ),
							'default' => '',
						),
						'subject' => array(
							'type'    => new Text(),
							'id'      => 'users_request_become_an_agent_subject',
							'title'   => esc_html__( 'Subject', 'realpress' ),
							'default' => esc_html__(
								'[{{site_title}}] Become an Agent Submission.'
							),
						),
						'content' => array(
							'type'        => new WPEditor(),
							'id'          => 'users_request_become_an_agent_content',
							'title'       => esc_html__( 'Content', 'realpress' ),
							'description' => esc_html__( '{{user_name}}, {{site_url}}, {{site_title}}, {{admin_email}}', 'realpress' ),
							'default'     => esc_html__(
								'Congratulations! Become an Agent at {{site_title}} has been submitted successfully.
									We will review and contact you shortly.'
							),
							'sanitize'    => 'html',
						),
					),
				),
			),
		),
		'approve_become_an_agent' => array(
			'id'     => 'approve_become_an_agent',
			'title'  => esc_html__( 'Approved become an Agent', 'realpress' ),
			'object' => array(
				'user' => array(
					'fields' => array(
						'enable'  => array(
							'type'    => new Checkbox(),
							'id'      => 'approved_become_an_agent_enable',
							'title'   => esc_html__( 'Email', 'realpress' ),
							'label'   => esc_html__( 'Enable/Disable', 'realpress' ),
							'default' => '',
						),
						'subject' => array(
							'type'    => new Text(),
							'id'      => 'approved_become_an_agent_subject',
							'title'   => esc_html__( 'Subject', 'realpress' ),
							'default' => esc_html__(
								'[{{site_title}}] Your request to become an Agent approved.'
							),
						),
						'content' => array(
							'type'        => new WPEditor(),
							'id'          => 'approved_become_an_agent_content',
							'title'       => esc_html__( 'Content', 'realpress' ),
							'description' => esc_html__( '{{user_name}}, {{site_url}}, {{site_title}}, {{admin_email}}', 'realpress' ),
							'default'     => esc_html__(
								'Congratulations! You become an Agent at {{site_title}} has been approved.
									Please login to {{site_title}} and start submitting property.'
							),
							'sanitize'    => 'html',
						),
					),
				),
			),
		),
		'reject_become_an_agent'  => array(
			'id'     => 'reject_become_an_agent',
			'title'  => esc_html__( 'Reject become an Agent', 'realpress' ),
			'object' => array(
				'user' => array(
					'fields' => array(
						'enable'  => array(
							'type'    => new Checkbox(),
							'id'      => 'reject_become_an_agent_enable',
							'title'   => esc_html__( 'Email', 'realpress' ),
							'label'   => esc_html__( 'Enable/Disable', 'realpress' ),
							'default' => '',
						),
						'subject' => array(
							'type'    => new Text(),
							'id'      => 'reject_become_an_agent_subject',
							'title'   => esc_html__( 'Subject', 'realpress' ),
							'default' => esc_html__(
								'[{{site_title}}] Your request to become an Agent rejected.'
							),
						),
						'content' => array(
							'type'        => new WPEditor(),
							'id'          => 'reject_become_an_agent_content',
							'title'       => esc_html__( 'Content', 'realpress' ),
							'description' => esc_html__( '{{user_name}}, {{site_url}}, {{site_title}}, {{admin_email}}', 'realpress' ),
							'default'     => esc_html__(
								' Hi {{user_name}}!
								Unfortunately, Your Become an Agent request at {{site_title}} has been rejected.'
							),
							'sanitize'    => 'html',
						),
					),
				),
			),
		),
	),
);
