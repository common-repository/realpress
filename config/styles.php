<?php

use RealPress\Helpers\SourceAsset;

$source_asset = SourceAsset::getInstance();

return apply_filters(
	'realpress/config/style',
	array(
		'admin'    => array(
			'realpress-admin' => array(
				'src' => $source_asset->get_asset_admin_file_url(
					'css',
					'realpress-admin',
				),
			),
		),
		'frontend' => array(
			'realpress-global'           => array(
				'src' => $source_asset->get_asset_frontend_file_url(
					'css',
					'realpress-global'
				),
			),
			'realpress-single-property'  => array(
				'src'     => $source_asset->get_asset_frontend_file_url(
					'css',
					'realpress-single-property',
				),
				'screens' => array(
					REALPRESS_SINGLE_PROPERTY_PAGE,
				),
			),
			'realpress-archive-property' => array(
				'src'     => $source_asset->get_asset_frontend_file_url(
					'css',
					'realpress-archive-property',
				),
				'screens' => array(
					REALPRESS_PROPERTY_ARCHIVE_PAGE,
				),
			),
			'realpress-agent-list'       => array(
				'src'     => $source_asset->get_asset_frontend_file_url(
					'css',
					'realpress-agent-list',
				),
				'screens' => array(
					REALPRESS_AGENT_LIST_PAGE,
				),
			),
			'realpress-agent-detail'     => array(
				'src'     => $source_asset->get_asset_frontend_file_url(
					'css',
					'realpress-agent-detail',
				),
				'screens' => array(
					REALPRESS_AGENT_DETAIL_PAGE,
				),
			),
			'realpress-become-an-agent'  => array(
				'src'     => $source_asset->get_asset_frontend_file_url(
					'css',
					'realpress-become-an-agent',
				),
				'screens' => array(
					REALPRESS_BECOME_AN_AGENT_PAGE,
				),
			),
			'realpress-wishlist'  => array(
				'src'     => $source_asset->get_asset_frontend_file_url(
					'css',
					'realpress-wishlist',
				),
				'screens' => array(
					REALPRESS_WISHLIST_PAGE,
				),
			),
		),
	)
);
