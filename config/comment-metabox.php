<?php

use RealPress\Helpers\Fields\Select;

return apply_filters(
	'realpress/config/property-comment-metabox',
	array(
		'name'       => esc_html__( 'Review Details', 'realpress' ),
		'id'         => 'realpress_property_review_meta',
		'show_names' => true, // Show field names on the left
		'priority'   => 'low',
		'context'    => 'normal',
		'fields'     => array(
			'review_stars' => array(
				'name'          => 'review_stars',
				'type'          => new Select(),
				'id'            => 'review_stars',
				'title'         => esc_html__( 'Select a property', 'realpress' ),
				'options'       => array(
					'1' => esc_html__( '1 Star - Poor', 'realpress' ),
					'2' => esc_html__( '2 Star - Fair', 'realpress' ),
					'3' => esc_html__( '3 Star - Average', 'realpress' ),
					'4' => esc_html__( '4 Star - Good', 'realpress' ),
					'5' => esc_html__( '5 Star - Excellent', 'realpress' ),
				),
				'default'       => '5',
				'is_single_key' => true,
			),
		),
	)
);
