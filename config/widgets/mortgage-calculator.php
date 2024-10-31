<?php

use RealPress\Helpers\Fields\Text;
use RealPress\Helpers\Fields\Number;

return apply_filters(
	'realpress/config/widgets/mortgage-calculator',
	array(
		'title'                 => array(
			'type'    => new Text(),
			'id'      => 'title',
			'title'   => esc_html__( 'Title', 'realpress' ),
			'default' => '',
		),
		'default_total_amount'  => array(
			'type'    => new Number(),
			'id'      => 'title',
			'title'   => esc_html__( 'Default Total Amount', 'realpress' ),
			'min'     => 0,
			'default' => '1000',
		),
		'default_down_payment'  => array(
			'type'    => new Number(),
			'id'      => 'title',
			'title'   => esc_html__( 'Default Down Payment', 'realpress' ),
			'min'     => 0,
			'default' => '5',
		),
		'default_loan_terms'    => array(
			'type'    => new Number(),
			'id'      => 'title',
			'title'   => esc_html__( 'Default Loan Terms(Years)', 'realpress' ),
			'min'     => 0,
			'default' => '5',
		),
		'default_interest_rate' => array(
			'type'    => new Number(),
			'id'      => 'title',
			'title'   => esc_html__( 'Default Interest Rate(%)', 'realpress' ),
			'min'     => 0,
			'default' => '10',
		),
	),
);

