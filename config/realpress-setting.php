<?php

use RealPress\Helpers\Fields\Checkbox;
use RealPress\Helpers\Fields\Select;
use RealPress\Helpers\Fields\Text;
use RealPress\Helpers\Fields\Number;
use RealPress\Helpers\Fields\WPDropdownPage;

$currency           = include 'currency.php';
$post_type_settings = include 'property-type.php';
$taxonomies         = $post_type_settings['taxonomies'];

$int_number                        = '^\d+$';
$taxonomy_url_settings             = array();
$taxonomy_advanced_search_settings = array();
if ( ! empty( $taxonomies ) ) {
	foreach ( $taxonomies as $taxonomy => $args ) {
		$taxonomy_url_settings[ $taxonomy ] = array(
			'type'     => new Text(),
			'id'       => $taxonomy . '_taxonomy',
			'title'    => sprintf( esc_html__( '%s Slug:', 'realpress' ), $args['labels']['name'] ),
			'class'    => 'col-12',
			'default'  => $taxonomy,
			'required' => true,
		);

		$key                                       = $taxonomy;
		$taxonomy_advanced_search_settings[ $key ] = array(
			'id'    => 'advanced_search_' . $taxonomy,
			'label' => $args['labels']['name'],
		);
	}
}
$email_settings        = include 'email-settings.php';
$yelp_categories       = include 'yelp-category.php';
$yelp_category_options = array();
foreach ( $yelp_categories as $key => $value ) {
	$yelp_category_options[ $key ] = $value['name'];
}

return apply_filters(
	'realpress/config/realpress-setting',
	array(
		'page_title'  => esc_html__( 'Real Estate Settings', 'realpress' ),
		'menu_title'  => esc_html__( 'Settings', 'realpress' ),
		'parent_slug' => 'edit.php?post_type=' . REALPRESS_PROPERTY_CPT,
		'slug'        => 'realpress-setting',
		'capability'  => 'administrator',
		'name'        => 'realpress_option_settings',
		'group'       => array(
			'currency'        => array(
				'id'     => 'currency',
				'title'  => esc_html__( 'Currency', 'realpress' ),
				'fields' => array(
					'code'                => array(
						'type'       => new Select(),
						'id'         => 'currency_code',
						'title'      => esc_html__( 'Currency:', 'realpress' ),
						'class'      => 'col-12',
						'options'    => $currency['currency-code'],
						'is_select2' => true,
						'default'    => 'USD',
					),
					'position'            => array(
						'type'    => new Select(),
						'id'      => 'currency_position',
						'title'   => esc_html__( 'Currency position:', 'realpress' ),
						'class'   => 'col-12',
						'options' => array(
							'left'        => esc_html__( 'Left ($69,69)', 'realpress' ),
							'right'       => esc_html__( 'Right (69,69$)', 'realpress' ),
							'left_space'  => esc_html__( 'Left with space ($ 69,69)', 'realpress' ),
							'right_space' => esc_html__( 'Right with space (69,69 $)', 'realpress' ),
						),
						'default' => 'left',
					),
					'thousands_separator' => array(
						'type'    => new Text(),
						'id'      => 'thousands_separator',
						'title'   => esc_html__( 'Thousands separator:', 'realpress' ),
						'class'   => 'col-12',
						'default' => ',',
					),
					'decimals_separator'  => array(
						'type'    => new Text(),
						'id'      => 'decimals_separator',
						'title'   => esc_html__( 'Decimals separator:', 'realpress' ),
						'class'   => 'col-12',
						'default' => '.',
					),
					'number_of_decimals'  => array(
						'type'     => new Number(),
						'id'       => 'number_of_decimals',
						'title'    => esc_html__( 'Number of decimals:', 'realpress' ),
						'min'      => 0,
						'class'    => 'col-12',
						'default'  => 2,
						'required' => true,
					),
				),
			),
			'page'            => array(
				'id'     => 'page',
				'title'  => esc_html__( 'Page', 'realpress' ),
				'fields' => array(
					'agent_list_page'           => array(
						'type'              => new WPDropdownPage(),
						'id'                => 'agent_list_page',
						'title'             => esc_html__( 'Agent List Page:', 'realpress' ),
						'class'             => 'col-12',
						'args'              => array(
							'id'                => 'realpress_agent_list_page',
							'name'              => 'agent_list_page',
							'class'             => 'realpress-select2',
							'option_none_value' => '',
							'show_option_none'  => 'Select a page',
							'sort_column'       => 'date',
						),
						'allow_create_page' => true,
						'default'           => '',
					),
					'terms_and_conditions_page' => array(
						'type'              => new WPDropdownPage(),
						'id'                => 'terms_and_conditions_page',
						'title'             => esc_html__( 'Terms and Conditions Page:', 'realpress' ),
						'class'             => 'col-12',
						'args'              => array(
							'id'                => 'realpress_terms_and_conditions_page',
							'name'              => 'terms_and_conditions_page',
							'class'             => 'realpress-select2',
							'option_none_value' => '',
							'show_option_none'  => 'Select a page',
							'sort_column'       => 'date',
						),
						'allow_create_page' => true,
						'default'           => '',
					),
					'become_an_agent_page'      => array(
						'type'              => new WPDropdownPage(),
						'id'                => 'become_an_agent_page',
						'title'             => esc_html__( 'Become an Agent Page:', 'realpress' ),
						'class'             => 'col-12',
						'args'              => array(
							'id'                => 'realpress_become_an_agent_page',
							'name'              => 'become_an_agent_page',
							'class'             => 'realpress-select2',
							'option_none_value' => '',
							'show_option_none'  => 'Select a page',
							'sort_column'       => 'date',
						),
						'allow_create_page' => true,
						'default'           => '',
					),
					'wishlist_page'      => array(
						'type'              => new WPDropdownPage(),
						'id'                => 'wishlist_page',
						'title'             => esc_html__( 'Wish List Page:', 'realpress' ),
						'class'             => 'col-12',
						'args'              => array(
							'id'                => 'realpress_wishlist_page',
							'name'              => 'wishlist_page',
							'class'             => 'realpress-select2',
							'option_none_value' => '',
							'show_option_none'  => 'Select a page',
							'sort_column'       => 'date',
						),
						'allow_create_page' => true,
						'default'           => '',
					),
				),
			),
			'slug'            => array(
				'id'     => 'slug',
				'title'  => esc_html__( 'URL Slug', 'realpress' ),
				'fields' => array_merge(
					array(
						'property' => array(
							'type'     => new Text(),
							'id'       => 'property_slug',
							'title'    => esc_html__( 'Property Slug:', 'realpress' ),
							'class'    => 'col-12',
							'default'  => REALPRESS_PROPERTY_CPT,
							'required' => true,
						),
					),
					$taxonomy_url_settings,
					array(
						'agent' => array(
							'type'     => new Text(),
							'id'       => 'agent_slug',
							'title'    => esc_html__( 'Agent Slug', 'realpress' ),
							'class'    => 'col-12',
							'default'  => REALPRESS_AGENT_ROLE,
							'required' => true,
						),
					)
				),
			),
			'property'        => array(
				'id'     => 'property',
				'title'  => esc_html__( 'Property', 'realpress' ),
				'fields' => array(
//					'approved_method'   => array(
//						'type'    => new Radio(),
//						'id'      => 'property_approved_method',
//						'title'   => esc_html__( 'Property Approved Method', 'realpress' ),
//						'options' => array(
//							'review'            => array(
//								'label'       => esc_html__( 'Review Property', 'realpress' ),
//								'id'          => 'review',
//								'description' => esc_html__( 'Property created by Agents will be pending in review first', 'realpress' ),
//							),
//							'automatic_publish' => array(
//								'label'       => esc_html__( 'Automatically publish', 'realpress' ),
//								'id'          => 'automatic_publish',
//								'description' => esc_html__( 'Property created by Agents will automatically publish', 'realpress' ),
//							),
//						),
//						'class'   => 'col-12',
//						'default' => 'review',
//					),
//					'page_layout'       => array(
//						'type'    => new Select(),
//						'id'      => 'property_page_layout',
//						'title'   => esc_html__( 'Property Page Layout:', 'realpress' ),
//						'class'   => 'col-12',
//						'options' => array(
//							'grid' => esc_html__( 'Grid', 'realpress' ),
//							'list' => esc_html__( 'List', 'realpress' ),
//						),
//						'default' => 'grid',
//					),
					'property_per_page' => array(
						'type'        => new Number(),
						'id'          => 'property_per_page',
						'title'       => esc_html__( 'Property Per Page:', 'realpress' ),
						'min'         => 1,
						'class'       => 'col-12',
						'description' => esc_html__( 'Number of property displayed per page', 'realpress' ),
						'default'     => 10,
						'required'    => true,
					),
					'maximum_images'    => array(
						'type'        => new Number(),
						'id'          => 'maximum_images',
						'title'       => esc_html__( 'Maximum Images:', 'realpress' ),
						'min'         => 0,
						'class'       => 'col-12',
						'description' => esc_html__( 'Maximum number of images allowed for gallery of single property', 'realpress' ),
						'default'     => 10,
						'required'    => true,
					),
					'maximum_file_size' => array(
						'type'        => new Number(),
						'id'          => 'maximum_file_size',
						'title'       => esc_html__( 'Maximum File Size(KB):', 'realpress' ),
						'min'         => 0,
						'class'       => 'col-12',
						'description' => esc_html__( 'Maximum size of the image that can be uploaded to the property', 'realpress' ),
						'default'     => 500,
						'required'    => true,
					),
				),
			),
			'email'           => $email_settings,
			'agent'           => array(
				'id'     => 'agent',
				'title'  => esc_html__( 'Agent', 'realpress' ),
				'fields' => array(
//					'registration'            => array(
//						'type'    => new Checkbox(),
//						'id'      => 'agent_registration',
//						'title'   => esc_html__( 'Agent registration:', 'realpress' ),
//						'label'   => esc_html__( 'Enable the option in registration form', 'realpress' ),
//						'class'   => 'col-12',
//						'default' => '',
//					),
					'automatically_approve'   => array(
						'type'    => new Checkbox(),
						'id'      => 'automatically_approve',
						'title'   => esc_html__( 'Automatically approve:', 'realpress' ),
						'label'   => esc_html__( 'Automatic approve the user become an Agent', 'realpress' ),
						'class'   => 'col-12',
						'default' => '',
					),
//					'page_layout'             => array(
//						'type'    => new Select(),
//						'id'      => 'agent_page_layout',
//						'title'   => esc_html__( 'Agent page layout:', 'realpress' ),
//						'class'   => 'col-12',
//						'options' => array(
//							'grid'     => esc_html__( 'Grid', 'realpress' ),
//							'list'     => esc_html__( 'List', 'realpress' ),
//							'carousel' => esc_html__( 'Carousel', 'realpress' ),
//						),
//						'default' => 'grid',
//					),
					'agent_per_page'          => array(
						'type'        => new Number(),
						'id'          => 'agent_per_page',
						'title'       => esc_html__( 'Agent per page:', 'realpress' ),
						'class'       => 'col-12',
						'min'         => 1,
						'description' => esc_html__( 'Number of Agent displayed per page', 'realpress' ),
						'default'     => 10,
						'required'    => true,
					),
					'avatar_dimension_width'  => array(
						'type'        => new Number(),
						'id'          => 'avatar_dimension_width',
						'title'       => esc_html__( 'Avatar dimension width(px)', 'realpress' ),
						'class'       => 'col-12',
						'description' => esc_html__( 'Example : 500 (Not include unit, space)', 'realpress' ),
						'min'         => 0,
						'default'     => 500,
						'required'    => true,
					),
					'avatar_dimension_height' => array(
						'type'        => new Number(),
						'id'          => 'avatar_dimension_height',
						'title'       => esc_html__( 'Avatar dimension height(px)', 'realpress' ),
						'class'       => 'col-12',
						'description' => esc_html__( 'Example : 500 (Not include unit, space)', 'realpress' ),
						'min'         => 0,
						'default'     => 500,
						'required'    => true,
					),
//					'registration_shortcode'  => array(
//						'type'    => new Checkbox(),
//						'id'      => 'agent_registration_shortcode',
//						'title'   => esc_html__( 'Agent registration shortcode:', 'realpress' ),
//						'label'   => esc_html__( 'Enable the option to use a shortcode to become an Agent', 'realpress' ),
//						'class'   => 'col-12',
//						'default' => '',
//					),
//					'default_fields'          => array(
//						'type'     => new Checkbox(),
//						'id'       => 'agent_default_fields',
//						'title'    => esc_html__( 'Enable default fields:', 'realpress' ),
//						'class'    => 'col-12',
//						'multiple' => true,
//						'options'  => array(
//							'first_name'  => array(
//								'id'    => 'first_name',
//								'label' => esc_html__( 'First Name', 'realpress' ),
//							),
//							'last_name'   => array(
//								'id'    => 'last_name',
//								'label' => esc_html__( 'Last Name', 'realpress' ),
//							),
//							'age'         => array(
//								'id'    => 'age',
//								'label' => esc_html__( 'Age', 'realpress' ),
//							),
//							'exprerience' => array(
//								'id'    => 'exprerience',
//								'label' => esc_html__( 'Exprerience', 'realpress' ),
//							),
//							'details'     => array(
//								'id'    => 'details',
//								'label' => esc_html__( 'Details', 'realpress' ),
//							),
//						),
//						'default'  => array( 'first_name', 'last_name' ),
//					),
//					'custom_fields'           => array(
//						'type'    => new AdditionalField(),
//						'id'      => 'agent_custom_fields',
//						'title'   => esc_html__( 'Custom register fields:', 'realpress' ),
//						'class'   => 'col-12',
//						'fields'  => array(
//							'label'    => array(
//								'type'  => new Text(),
//								'title' => esc_html__( 'Label', 'realpress' ),
//							),
//							'type'     => array(
//								'type'    => new Select(),
//								'title'   => esc_html__( 'Type', 'realpress' ),
//								'options' => array(
//									'text'     => esc_html__( 'Text', 'realpress' ),
//									'select'   => esc_html__( 'Select', 'realpress' ),
//									'textarea' => esc_html__( 'Textarea', 'realpress' ),
//									'checkbox' => esc_html__( 'Checkbox', 'realpress' ),
//								),
//							),
//							'required' => array(
//								'type'  => new Checkbox(),
//								'title' => esc_html__( 'Is required ?', 'realpress' ),
//							),
//						),
//						'default' => array(
//							array(
//								'label'    => 'Label',
//								'type'     => 'text',
//								'required' => 1,
//							),
//						),
//					),
				),
			),
			'advanced_search' => array(
				'id'     => 'advanced_search',
				'title'  => esc_html__( 'Advanced Search', 'realpress' ),
				'fields' => array(
					'enable'          => array(
						'type'    => new Checkbox(),
						'id'      => 'advanced_search_enable',
						'title'   => esc_html__( 'Mode', 'realpress' ),
						'label'   => esc_html__( 'Enable/Disable', 'realpress' ),
						'class'   => 'col-12',
						'default' => '',
					),
					'advanced_search' => array(
						'title'    => esc_html__( 'Advanced Search', 'realpress' ),
						'type'     => new Checkbox(),
						'multiple' => true,
						'sortable' => true,
						'class'    => 'col-12',
						'options'  => array_merge(
							array(
								'title'      => array(
									'id'    => 'title',
									'label' => esc_html__( 'Title', 'realpress' ),
								),
								'price'      => array(
									'id'    => 'price',
									'label' => esc_html__( 'Price', 'realpress' ),
								),
								'rooms'      => array(
									'id'    => 'rooms',
									'label' => esc_html__( 'Rooms', 'realpress' ),
								),
								'bedrooms'   => array(
									'id'    => 'bedrooms',
									'label' => esc_html__( 'Bedrooms', 'realpress' ),
								),
								'bathrooms'  => array(
									'id'    => 'bathrooms',
									'label' => esc_html__( 'Bathrooms', 'realpress' ),
								),
								'year_built' => array(
									'id'    => 'year_built',
									'label' => esc_html__( 'Year Built', 'realpress' ),
								),
							),
							$taxonomy_advanced_search_settings
						),
						'default'  => array( 'title', 'price' ),
					),
					'min_price'       => array(
						'type'    => new Number(),
						'id'      => 'min_price',
						'title'   => esc_html__( 'Min Price:', 'realpress' ),
						'min'     => 0,
						'class'   => 'col-12',
						'default' => 0,
					),
					'max_price'       => array(
						'type'    => new Number(),
						'id'      => 'max_price',
						'title'   => esc_html__( 'Max Price:', 'realpress' ),
						'min'     => 0,
						'class'   => 'col-12',
						'default' => 250,
					),
					'redirect_to'     => array(
						'type'        => new WPDropdownPage(),
						'id'          => 'redirect_to',
						'title'       => esc_html__( 'Redirect to Page:', 'realpress' ),
						'class'       => 'col-12',
						'args'        => array(
							'id'                => 'realpress_redirect_to',
							'name'              => 'redirect_to',
							'class'             => 'realpress-select2',
							'option_none_value' => '',
							'show_option_none'  => 'Select a page',
							'sort_column'       => 'date',
						),
						'description' => esc_html__( 'If no page is selected, it will redirect to the Property Archive page ', 'realpress' ),
						'default'     => '',
					),
				),
			),
			'walk_score'      => array(
				'id'     => 'walk_score',
				'title'  => esc_html__( 'Walkscore', 'realpress' ),
				'fields' => array(
					'enable' => array(
						'type'    => new Checkbox(),
						'id'      => 'walk_score_enable',
						'title'   => esc_html__( 'Mode', 'realpress' ),
						'label'   => esc_html__( 'Enable/Disable', 'realpress' ),
						'class'   => 'col-12',
						'default' => '',
					),
					'api'    => array(
						'type'        => new Text(),
						'id'          => 'walk_score_api',
						'title'       => esc_html__( 'Walkscore API', 'realpress' ),
						'class'       => 'col-12',
						'description' => __( 'Get API <a target="_blank" href="https://www.walkscore.com/professional/api.php">here</a>', 'realpress' ),
						'default'     => '',
					),
				),
			),
			'yelp_nearby'     => array(
				'id'     => 'yelp_nearby',
				'title'  => esc_html__( 'Yelp Nearby Places', 'realpress' ),
				'fields' => array(
					'enable'        => array(
						'type'        => new Checkbox(),
						'id'          => 'yelp_nearby_enable',
						'title'       => esc_html__( 'Mode', 'realpress' ),
						'label'       => esc_html__( 'Enable/Disable', 'realpress' ),
						'class'       => 'col-12',
						'description' => __( 'Yelp is not working for all countries. See <a target="_blank" href="https://www.yelp.com/locations">here</a> the list of countries where Yelp is available.', 'realpress' ),
						'default'     => '',
					),
					'api'           => array(
						'type'        => new Text(),
						'id'          => 'yelp_nearby_api',
						'title'       => esc_html__( 'Yelp API Key', 'realpress' ),
						'class'       => 'col-12',
						'description' => __( 'Get API key <a target="_blank" href="https://www.yelp.com/login?return_url=%2Fdevelopers%2Fv3%2Fmanage_app">here</a>', 'realpress' ),
						'default'     => '',
					),
					'category'      => array(
						'type'        => new Select(),
						'id'          => 'yelp_nearby_category',
						'title'       => esc_html__( 'Yelp Categories:', 'realpress' ),
						'class'       => 'col-12',
						'options'     => $yelp_category_options,
						'is_select2'  => true,
						'is_multiple' => true,
						'default'     => array(),
					),
					'limit'         => array(
						'type'     => new Number(),
						'id'       => 'yelp_result_limit',
						'title'    => esc_html__( 'Yelp Result Limit:', 'realpress' ),
						'class'    => 'col-12',
						'min'      => 1,
						'default'  => 3,
						'required' => true,
					),
					'distance_unit' => array(
						'type'    => new Select(),
						'id'      => 'yelp_distance_unit',
						'title'   => esc_html__( 'Yelp Distance Unit:', 'realpress' ),
						'class'   => 'col-12',
						'options' => array(
							'miles' => esc_html__( 'Miles', 'realpress' ),
							'km'    => esc_html__( 'Km', 'realpress' ),
						),
						'default' => 'miles',
					),
				),
			),
			'advanced'        => array(
				'id'     => 'advanced',
				'title'  => esc_html__( 'Advanced Settings', 'realpress' ),
				'fields' => array(
					'debug_mode' => array(
						'type'    => new Checkbox(),
						'id'      => 'debug_mode',
						'title'   => esc_html__( 'Debug Mode:', 'realpress' ),
						'class'   => 'col-12',
						'label'   => esc_html__( 'Enable/Disable', 'realpress' ),
						'default' => '',
					),
				),
			),
		),
	)
);
