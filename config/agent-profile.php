<?php

use RealPress\Helpers\Fields\Text;
use RealPress\Helpers\Fields\FileUpload;
use RealPress\Helpers\Settings;

$avatar_max_width  = Settings::get_setting_detail( 'group:agent:fields:avatar_dimension_width' );
$avatar_max_height = Settings::get_setting_detail( 'group:agent:fields:avatar_dimension_height' );

return apply_filters(
	'realpress/config/user-profile',
	array(
		'user_profile'   => array(
			'title'  => esc_html__( 'Profile Info', 'realpress' ),
			'fields' => array(
				'position'            => array(
					'type'    => new Text(),
					'id'      => 'position',
					'title'   => esc_html__( 'Position', 'realpress' ),
					'class'   => 'col-12',
					'default' => '',
				),
				'profile_picture'     => array(
					'type'        => new FileUpload(),
					'id'          => 'profile_picture',
					'title'       => esc_html__( 'Profile Picture', 'realpress' ),
					'class'       => 'col-12',
					'default'     => array(
						'image_id'  => '',
						'image_url' => '',
					),
					'description' => sprintf(
						esc_html__(
							'The maximum dimension is %1$s x %2$s px',
							'realpress'
						),
						$avatar_max_width,
						$avatar_max_height,
					),
					'max_size'    => array(
						'width'  => $avatar_max_width,
						'height' => $avatar_max_height,
					),
				),
				'mobile_number'       => array(
					'type'    => new Text(),
					'id'      => 'mobile_number',
					'title'   => esc_html__( 'Mobile Number', 'realpress' ),
					'class'   => 'col-12',
					'default' => '',
				),
				'company_name'        => array(
					'type'          => new Text(),
					'id'            => 'company_name',
					'title'         => esc_html__( 'Company Name', 'realpress' ),
					'class'         => 'col-12',
					'is_single_key' => true,
					'default'       => '',
				),
				'company_url'         => array(
					'type'    => new Text(),
					'id'      => 'company_url',
					'title'   => esc_html__( 'Company URL', 'realpress' ),
					'class'   => 'col-12',
					'default' => '',
				),
				'office_phone_number' => array(
					'type'    => new Text(),
					'id'      => 'office_phone_number',
					'title'   => esc_html__( 'Office Phone Number', 'realpress' ),
					'class'   => 'col-12',
					'default' => '',
				),
				'tax_number'          => array(
					'type'    => new Text(),
					'id'      => 'tax_number',
					'title'   => esc_html__( 'Tax Number', 'realpress' ),
					'class'   => 'col-12',
					'default' => '',
				),
				'address'             => array(
					'type'    => new Text(),
					'id'      => 'address',
					'title'   => esc_html__( 'Address', 'realpress' ),
					'class'   => 'col-12',
					'default' => '',
				),
				'license'             => array(
					'type'    => new Text(),
					'id'      => 'license',
					'title'   => esc_html__( 'License', 'realpress' ),
					'class'   => 'col-12',
					'default' => '',
				),
			),
		),
		'social_network' => array(
			'title'  => esc_html__( 'Social Network', 'realpress' ),
			'fields' => array(
				'facebook'    => array(
					'type'    => new Text(),
					'id'      => 'facebook',
					'title'   => esc_html__( 'Facebook', 'realpress' ),
					'class'   => 'col-12',
					'default' => '',
				),
				'twitter'     => array(
					'type'    => new Text(),
					'id'      => 'twitter',
					'title'   => esc_html__( 'Twitter', 'realpress' ),
					'class'   => 'col-12',
					'default' => '',
				),
				'google-plus' => array(
					'type'    => new Text(),
					'id'      => 'google-plus',
					'title'   => esc_html__( 'Google-plus', 'realpress' ),
					'class'   => 'col-12',
					'default' => '',
				),
				'instagram'   => array(
					'type'    => new Text(),
					'id'      => 'instagram',
					'title'   => esc_html__( 'Instagram', 'realpress' ),
					'class'   => 'col-12',
					'default' => '',
				),
				'pinterest'   => array(
					'type'    => new Text(),
					'id'      => 'pinterest',
					'title'   => esc_html__( 'Pinterest', 'realpress' ),
					'class'   => 'col-12',
					'default' => '',
				),
				'linkedin'    => array(
					'type'    => new Text(),
					'id'      => 'linkedin',
					'title'   => esc_html__( 'Linkedin', 'realpress' ),
					'class'   => 'col-12',
					'default' => '',
				),
				'skype'       => array(
					'type'    => new Text(),
					'id'      => 'skype',
					'title'   => esc_html__( 'Skype', 'realpress' ),
					'class'   => 'col-12',
					'default' => '',
				),
				'whatsapp'    => array(
					'type'    => new Text(),
					'id'      => 'whatsapp',
					'title'   => esc_html__( 'Whatsapp', 'realpress' ),
					'class'   => 'col-12',
					'default' => '',
				),
			),
		),
	)
);
