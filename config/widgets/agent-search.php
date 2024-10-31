<?php
use RealPress\Helpers\Fields\Text;

return apply_filters(
	'realpress/config/widgets/agent-search',
	array(
		'title' => array(
			'type'    => new Text(),
			'id'      => 'title',
			'title'   => esc_html__( 'Title', 'realpress' ),
			'default' => '',
		),
	),
);
