<?php

use RealPress\Helpers\Fields\Select;
use RealPress\Helpers\Fields\Text;
use RealPress\Helpers\Fields\Number;

return apply_filters(
	'realpress/config/widgets/property-list',
	array(
		'title'          => array(
			'type'    => new Text(),
			'id'      => 'title',
			'title'   => esc_html__( 'Title', 'realpress' ),
			'default' => '',
		),
		'posts_per_page' => array(
			'type'    => new Number(),
			'id'      => 'agents',
			'title'   => esc_html__( 'Number', 'realpress' ),
			'default' => 1,
			'min'     => 1,
		),
		'order_by'       => array(
			'type'    => new Select(),
			'id'      => 'agents',
			'title'   => esc_html__( 'Order By', 'realpress' ),
			'options' => array(
				'date'  => esc_html__( 'Date', 'realpress' ),
				'title' => esc_html__( 'Title', 'realpress' ),
				'rand'  => esc_html__( 'Random', 'realpress' ),
			),
			'default' => 'date',
		),
		'order'          => array(
			'type'    => new Select(),
			'id'      => 'agents',
			'title'   => esc_html__( 'Order', 'realpress' ),
			'options' => array(
				'DESC' => esc_html__( 'DESC', 'realpress' ),
				'ASC'  => esc_html__( 'ASC', 'realpress' ),
			),
			'default' => 'DESC',
		),
	),
);
