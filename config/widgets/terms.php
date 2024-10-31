<?php

use RealPress\Helpers\Fields\Select;
use RealPress\Helpers\Fields\Text;
use RealPress\Helpers\Fields\Number;

$post_type_settings = include REALPRESS_CONFIG_DIR . 'property-type.php';
$taxonomies         = $post_type_settings['taxonomies'];
$taxonomy_options   = array();
foreach ( $taxonomies as $taxonomy => $args ) {
	$taxonomy_options[ $taxonomy ] = $args['labels']['name'];
}

return apply_filters(
	'realpress/config/widgets/terms',
	array(
		'title'    => array(
			'type'    => new Text(),
			'id'      => 'title',
			'title'   => esc_html__( 'Title', 'realpress' ),
			'default' => '',
		),
		'taxonomy' => array(
			'type'    => new Select(),
			'id'      => 'taxonomy',
			'title'   => esc_html__( 'Taxonomy', 'realpress' ),
			'options' => $taxonomy_options,
			'default' => '',
		),
		'number'   => array(
			'type'    => new Number(),
			'id'      => 'number',
			'title'   => esc_html__( 'Number', 'realpress' ),
			'default' => 10,
			'min'     => 1,
		),
		'orderby'  => array(
			'type'    => new Select(),
			'id'      => 'orderby',
			'title'   => esc_html__( 'Order By', 'realpress' ),
			'options' => array(
				'name'  => esc_html__( 'Name', 'realpress' ),
				'slug'  => esc_html__( 'Slug', 'realpress' ),
				'count' => esc_html__( 'Count', 'realpress' ),
			),
			'default' => 'name',
		),
		'order'    => array(
			'type'    => new Select(),
			'id'      => 'order',
			'title'   => esc_html__( 'Order', 'realpress' ),
			'options' => array(
				'asc'  => esc_html__( 'ASC', 'realpress' ),
				'desc' => esc_html__( 'DESC', 'realpress' ),
			),
			'default' => 'ASC',
		),
	),
);
