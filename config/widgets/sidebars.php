<?php

return apply_filters(
	'realpress/config/widgets/sidebars',
	array(
		'realpress-single-property-sidebar'  => array(
			'name'          => esc_html__( 'Single Property Sidebar', 'realpress' ),
			'description'   => esc_html__( 'Displaying widget items on the sidebar area', 'realpress' ),
			'id'            => 'realpress-single-property-sidebar',
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		),
		'realpress-archive-property-sidebar' => array(
			'name'          => esc_html__( 'Archive Property Sidebar', 'realpress' ),
			'description'   => esc_html__( 'Displaying widget items on the sidebar area', 'realpress' ),
			'id'            => 'realpress-archive-property-sidebar',
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		),
		'realpress-agent-list-sidebar'       => array(
			'name'          => esc_html__( 'Agent List Sidebar', 'realpress' ),
			'description'   => esc_html__( 'Displaying widget items on the sidebar area', 'realpress' ),
			'id'            => 'realpress-agent-list-sidebar',
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		),
		'realpress-agent-detail-sidebar'     => array(
			'name'          => esc_html__( 'Agent Detail Sidebar', 'realpress' ),
			'description'   => esc_html__( 'Displaying widget items on the sidebar area', 'realpress' ),
			'id'            => 'realpress-agent-detail-sidebar',
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		),
	)
);

