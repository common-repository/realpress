<?php

use RealPress\Helpers\Fields\Text;
use RealPress\Helpers\Fields\ColorPicker;

return apply_filters(
	'realpress/config/term-metabox',
	array(
		'realpress-energy-class' => array(
			'global_performance_index'    => array(
				'name'        => 'global_performance_index',
				'type'        => new Text(),
				'id'          => 'global_performance_index',
				'title'       => esc_html__( 'Global energy performance index', 'realpress' ),
				'description' => esc_html__( 'For example: 80.42 kWh / m²a', 'realpress' ),
				'default'     => '',
			),
			'renewable_performance_index' => array(
				'name'        => 'renewable_performance_index',
				'type'        => new Text(),
				'id'          => 'renewable_performance_index',
				'title'       => esc_html__( 'Renewable energy performance index', 'realpress' ),
				'description' => esc_html__( 'For example: 80.42 kWh / m²a', 'realpress' ),
				'default'     => '',
			),
			'performance_of_building'     => array(
				'name'    => 'performance_of_building',
				'type'    => new Text(),
				'id'      => 'performance_of_building',
				'title'   => esc_html__( 'Energy performance of the building', 'realpress' ),
				'default' => '',
			),
			'epc_current_rating'          => array(
				'name'    => 'epc_current_rating',
				'type'    => new Text(),
				'id'      => 'epc_current_rating',
				'title'   => esc_html__( 'EPC current rating', 'realpress' ),
				'class'   => 'col-12',
				'default' => '',
			),
			'epc_potential_rating'        => array(
				'name'    => 'epc_potential_rating',
				'type'    => new Text(),
				'id'      => 'epc_potential_rating',
				'title'   => esc_html__( 'EPC potential rating', 'realpress' ),
				'class'   => 'col-12',
				'default' => '',
			),
			'color'                       => array(
				'name'    => 'color',
				'type'    => new ColorPicker(),
				'id'      => 'energy_class_color',
				'title'   => esc_html__( 'Color', 'realpress' ),
				'default' => '#904141',
			),
		),
		'realpress-labels'       => array(
			'color' => array(
				'name'    => 'color',
				'type'    => new ColorPicker(),
				'id'      => 'labels_color',
				'title'   => esc_html__( 'Color', 'realpress' ),
				'default' => '#904141',
			),
		),
		'realpress-status'       => array(
			'color' => array(
				'name'    => 'color',
				'type'    => new ColorPicker(),
				'id'      => 'labels_color',
				'title'   => esc_html__( 'Color', 'realpress' ),
				'default' => '#904141',
			),
		),
	)
);
