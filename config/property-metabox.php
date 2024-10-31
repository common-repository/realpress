<?php

use RealPress\Helpers\Fields\Text;
use RealPress\Helpers\Fields\FileUpload;
use RealPress\Helpers\Fields\Radio;
use RealPress\Helpers\Fields\Textarea;
use RealPress\Helpers\Fields\Number;
use RealPress\Helpers\Fields\Checkbox;
use RealPress\Helpers\Forms\FloorPlan;
use RealPress\Helpers\Forms\TaxonomyPostMeta;
use RealPress\Helpers\Forms\AddressMap;
use RealPress\Helpers\Forms\AdditionalField;
use RealPress\Helpers\Settings;
use RealPress\Helpers\Fields\WPDropDownUser;

$maximum_file_size = Settings::get_setting_detail( 'group:property:fields:maximum_file_size' );

return apply_filters(
	'realpress/config/property-metabox',
	array(
		'name'       => esc_html__( 'Property Infomation', 'realpress' ),
		'id'         => 'realpress_property_section',
		'show_names' => true, // Show field names on the left
		'priority'   => 'low',
		'context'    => 'advanced',
		'group'      => array(
			'information' => array(
				'id'      => 'information',
				'title'   => esc_html__( 'Information Property', 'realpress' ),
				'section' => array(
					'general'             => array(
						'fields' => array(
							'price'                  => array(
								'type'          => new Number(),
								'min'           => 0,
								'id'            => 'price',
								'title'         => esc_html__( 'Price', 'realpress' ),
								'description'   => esc_html__( 'Only digits', 'realpress' ),
								'class'         => 'col-6',
								'default'       => 10,
								'is_single_key' => true, //This field is saved only as meta key
							),
							'text_after_price'       => array(
								'type'        => new Text(),
								'id'          => 'text_after_price',
								'title'       => esc_html__( 'Text After The Price', 'realpress' ),
								'description' => esc_html__( 'For example: /monthly, /year ...', 'realpress' ),
								'class'       => 'col-6',
								'default'     => '/monthly',
							),
							'area_size'              => array(
								'type'          => new Number(),
								'min'           => 0,
								'id'            => 'area_size',
								'title'         => esc_html__( 'Area Size', 'realpress' ),
								'description'   => esc_html__( 'Only digits', 'realpress' ),
								'class'         => 'col-6',
								'default'       => 100,
								'is_single_key' => true, //This field is saved only as meta key
							),
							'area_size_postfix'      => array(
								'type'        => new Text(),
								'id'          => 'area_size_postfix',
								'title'       => esc_html__( 'Area Size Postfix', 'realpress' ),
								'description' => esc_html__( 'For example: Sq Ft', 'realpress' ),
								'class'       => 'col-6',
								'default'     => 'Sq Ft',
							),
							'land_area_size'         => array(
								'type'        => new Number(),
								'min'         => 0,
								'id'          => 'land_area_size',
								'title'       => esc_html__( 'Land Area Size', 'realpress' ),
								'description' => esc_html__( 'Only digits', 'realpress' ),
								'class'       => 'col-6',
								'default'     => 100,
							),
							'land_area_size_postfix' => array(
								'type'        => new Text(),
								'id'          => 'land_area_size_postfix',
								'title'       => esc_html__( 'Land Area Size Postfix', 'realpress' ),
								'description' => esc_html__( 'For example: Sq Ft', 'realpress' ),
								'class'       => 'col-6',
								'default'     => 'Sq Ft',
							),
							'rooms'                  => array(
								'type'          => new Number(),
								'min'           => 0,
								'id'            => 'rooms',
								'title'         => esc_html__( 'Rooms', 'realpress' ),
								'description'   => esc_html__( 'Only digits', 'realpress' ),
								'class'         => 'col-6',
								'default'       => 100,
								'is_single_key' => true, //This field is saved only as meta key
							),
							'bedrooms'               => array(
								'type'          => new Number(),
								'min'           => 0,
								'id'            => 'bedrooms',
								'title'         => esc_html__( 'Bedrooms', 'realpress' ),
								'description'   => esc_html__( 'Only digits', 'realpress' ),
								'class'         => 'col-6',
								'default'       => 100,
								'is_single_key' => true, //This field is saved only as meta key
							),
							'bathrooms'              => array(
								'type'          => new Number(),
								'min'           => 0,
								'id'            => 'bathrooms',
								'title'         => esc_html__( 'Bathrooms', 'realpress' ),
								'description'   => esc_html__( 'Only digits', 'realpress' ),
								'class'         => 'col-6',
								'default'       => 100,
								'is_single_key' => true, //This field is saved only as meta key
							),
							'property_id'            => array(
								'type'        => new Text(),
								'id'          => 'property_id',
								'title'       => esc_html__( 'Property ID', 'realpress' ),
								'description' => esc_html__( 'For example: HZ24', 'realpress' ),
								'class'       => 'col-6',
								'default'     => 'HZ24',
							),
							'year_built'             => array(
								'type'          => new Number(),
								'min'           => 0,
								'id'            => 'year_built',
								'title'         => esc_html__( 'Year Built', 'realpress' ),
								'description'   => esc_html__( 'Only digits', 'realpress' ),
								'class'         => 'col-6',
								'default'       => 2022,
								'is_single_key' => true, //This field is saved only as meta key
							),
						),
					),
					'additional-features' => array(
						'type'    => new AdditionalField(),
						'title'   => esc_html__( 'Additional details:', 'realpress' ),
						'class'   => 'col-12',
						'fields'  => array(
							'label' => array(
								'type'  => new Text(),
								'title' => esc_html__( 'Label', 'realpress' ),
							),
							'value' => array(
								'type'  => new Text(),
								'title' => esc_html__( 'Value', 'realpress' ),
							),
						),
						'default' => array(
							array(
								'label' => 'Label',
								'value' => 'Value',
							),
						),
					),
				),
			),
			'taxonomy'    => array(
				'id'      => 'taxonomy',
				'title'   => esc_html__( 'Taxonomy Property', 'realpress' ),
				'section' => array(
					'taxonomy' => array(
						'type'    => new TaxonomyPostMeta(),
						'title'   => esc_html__( '', 'realpress' ),
						'fields'  => array(),
						'class'   => 'col-4',
						'default' => '',
					),
				),
			),
			'floor_plan'  => array(
				'id'      => 'floor_plan',
				'title'   => esc_html__( 'Floor Plan', 'realpress' ),
				'section' => array(
					'floor_plan' => array(
						'type'        => new FloorPlan(),
						'id'          => 'floor_plan',
						'title'       => esc_html__( 'Floor', 'realpress' ),
						'class'       => 'col-12',
						'description' => '',
						'fields'      => array(
							'title'       => array(
								'id'    => 'title',
								'type'  => new Text(),
								'title' => esc_html__( 'Plan title', 'realpress' ),
								'class' => 'col-6',
							),
							'price'       => array(
								'id'          => 'price',
								'type'        => new Number(),
								'min'         => 0,
								'title'       => esc_html__( 'Price', 'realpress' ),
								'description' => esc_html__( 'Only digits', 'realpress' ),
								'class'       => 'col-6',
							),
							'size'        => array(
								'id'          => 'size',
								'type'        => new Text(),
								'min'         => 0,
								'title'       => esc_html__( 'Plan Size', 'realpress' ),
								'description' => esc_html__( 'For example: 100 Sq Ft', 'realpress' ),
								'class'       => 'col-6',
							),
							'rooms'       => array(
								'id'          => 'rooms',
								'type'        => new Number(),
								'min'         => 0,
								'title'       => esc_html__( 'Rooms', 'realpress' ),
								'description' => esc_html__( 'For example: 5', 'realpress' ),
								'class'       => 'col-6',
							),
							'bedrooms'    => array(
								'id'          => 'bedrooms',
								'type'        => new Number(),
								'min'         => 0,
								'title'       => esc_html__( 'Bedrooms', 'realpress' ),
								'description' => esc_html__( 'For example: 4', 'realpress' ),
								'class'       => 'col-6',
							),
							'bathrooms'   => array(
								'id'          => 'bathrooms',
								'type'        => new Number(),
								'min'         => 0,
								'title'       => esc_html__( 'Bathrooms', 'realpress' ),
								'description' => esc_html__( 'For example: 2', 'realpress' ),
								'class'       => 'col-6',
							),
							'image'       => array(
								'id'            => 'image',
								'type'          => new FileUpload(),
								'title'         => esc_html__( 'Plan Image', 'realpress' ),
								'description'   => sprintf(
									esc_html__( 'The maximum file size is %s KB', 'realpress' ),
									$maximum_file_size
								),
								'button_title'  => esc_html__( 'Select Image', 'realpress' ),
								'class'         => 'col-12',
								'max_file_size' => $maximum_file_size,
								'multiple'      => false,
							),
							'description' => array(
								'id'          => 'description',
								'type'        => new Textarea(),
								'title'       => esc_html__( 'Description', 'realpress' ),
								'description' => esc_html__( '', 'realpress' ),
								'class'       => 'col-12',
							),
						),
						'default'     => array(
							array(
								'title'       => 'New Plan Title',
								'price'       => 100,
								'size'        => '100 Sq Ft',
								'rooms'       => '5',
								'bedrooms'    => '4',
								'bathrooms'   => '2',
								'image'       => '',
								'description' => '',
							),
						),
					),
				),
			),
			'agent'       => array(
				'id'      => 'agent',
				'title'   => esc_html__( 'Agent', 'realpress' ),
				'section' => array(
					'agent_information' => array(
						'title'  => esc_html__( 'Choose the information do you want to display in Agent data container', 'realpress' ),
						'fields' => array(
							'enable'      => array(
								'type'    => new Checkbox(),
								'id'      => 'information_enable',
								'label'   => esc_html__( 'Enable/Disable', 'realpress' ),
								'class'   => 'col-12',
								'default' => '',
							),
							'information' => array(
								'type'        => new Radio(),
								'id'          => 'information',
								'description' => esc_html__( '', 'realpress' ),
								'options'     => array(
									'author'            => array(
										'label' => esc_html__( 'Author Info', 'realpress' ),
										'id'    => 'author',
									),
									'agent'             => array(
										'label' => esc_html__( 'Agent Info', 'realpress' ),
										'id'    => 'agent',
									),
									'show_custom_field' => array(
										'label' => esc_html__( 'Show Custom Field', 'realpress' ),
										'id'    => 'show_custom_field',
									),
								),
								'default'     => 'author',
							),

						),
					),
					'agent_user'        => array(
						'title'  => esc_html__( 'Select Agent', 'realpress' ),
						'fields' => array(
							'agent_user' => array(
								'type'    => new WPDropDownUser(),
								'title'   => '',
								'id'      => 'agent_user',
								'class'   => '',
								'args'    => array(
									'id'                => 'realpress_agent_user',
									'name'              => 'agent_user',
									'role__in'          => array( REALPRESS_AGENT_ROLE ),
									'class'             => 'realpress-select2',
									'option_none_value' => '',
									'show_option_none'  => 'Select a user',
								),
								'default' => '',
							),
						),
					),
					'additional_agents' => array(
						'type'                  => new AdditionalField(),
						'title'                 => esc_html__( '', 'realpress' ),
						'id'                    => 'additional_agents',
						'default_fields_number' => 1,
						'class'                 => 'col-12',
						'fields'                => array(
							'label' => array(
								'type'  => new Text(),
								'title' => esc_html__( 'Label', 'realpress' ),
								'class' => 'additional-input-field',
							),
							'value' => array(
								'type'  => new Text(),
								'title' => esc_html__( 'Value', 'realpress' ),
								'class' => 'additional-input-field',
							),
						),
						'default'               => array(
							array(
								'label' => 'Label',
								'value' => 'Value',
							),
						),
					),
				),
			),
			'media'       => array(
				'id'      => 'media',
				'title'   => esc_html__( 'Media', 'realpress' ),
				'section' => array(
					'gallery' => array(
						'fields' => array(
							'gallery' => array(
								'type'          => new FileUpload(),
								'multiple'      => true,
								'max_number'    => Settings::get_setting_detail( 'group:property:fields:maximum_images' ),
								'id'            => 'add_gallery',
								'title'         => esc_html__( 'Gallery', 'realpress' ),
								'button_title'  => esc_html__( '+ ADD GALLERY', 'realpress' ),
								'description'   => sprintf(
									esc_html__(
										'You can upload maximum %1$s images. The maximum file size is %2$s KB',
										'realpress'
									),
									Settings::get_setting_detail( 'group:property:fields:maximum_images' ),
									$maximum_file_size,
								),
								'max_file_size' => $maximum_file_size,
								'default'       => '',
							),
						),
					),
					'video'   => array(
						'fields' => array(
							'video' => array(
								'type'        => new Textarea(),
								'id'          => 'video',
								'title'       => esc_html__( 'Video', 'realpress' ),
								'description' => esc_html__( 'For example: <iframe width ="853" height ="480" src="#"></iframe> ', 'realpress' ),
								'class'       => 'col-12',
								'sanitize'    => 'html',
								'default'     => '',
							),
						),
					),
					'360-vr'  => array(
						'fields' => array(
							'360_vr' => array(
								'type'        => new Textarea(),
								'id'          => '360_vr',
								'title'       => esc_html__( '360 Virtual Tour', 'realpress' ),
								'description' => esc_html__( 'For example: <iframe width ="853" height ="480" src="#"></iframe> ', 'realpress' ),
								'class'       => 'col-12',
								'sanitize'    => 'html',
								'default'     => '',
							),
						),
					),
				),
			),
			'map'         => array(
				'id'      => 'map',
				'title'   => esc_html__( 'Map', 'realpress' ),
				'section' => array(
					'enable_map' => array(
						'fields' => array(
							'enable' => array(
								'type'          => new Checkbox(),
								'id'            => 'enable_map',
								'label'         => esc_html__( 'Enable/Disable', 'realpress' ),
								'class'         => 'col-12',
								'is_single_key' => true,
								'default'       => '',
							),
						),
					),
					'map'        => array(
						'type'        => new AddressMap(),
						'id'          => 'address',
						'map_id'      => 'address_map',
						'description' => '',
						'class'       => 'col-12',
						'fields'      => array(
							'name' => array(
								'type'    => new Text(),
								'id'      => 'name',
								'title'   => esc_html__( 'Address name', 'realpress' ),
								'class'   => 'col-4',
								'default' => '',
							),
							'lat'  => array(
								'type'          => new Number(),
								'id'            => 'lat',
								'title'         => esc_html__( 'Lat', 'realpress' ),
								'class'         => 'col-4',
								'is_single_key' => true, //This field is saved only as meta key
								'default'       => '',
							),
							'lon'  => array(
								'type'          => new Number(),
								'id'            => 'lon',
								'title'         => esc_html__( 'Lon', 'realpress' ),
								'class'         => 'col-4',
								'is_single_key' => true, //This field is saved only as meta key
								'default'       => '',
							),
						),
					),
				),
			),
		),
	)
);

