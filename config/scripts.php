<?php

use RealPress\Helpers\SourceAsset;

$source_asset = SourceAsset::getInstance();

return apply_filters(
	'realpress/config/scripts',
	array(
		'admin'    => array(
			'register'       => array(
				'realpress-js-color'     => array(
					'src' => $source_asset->get_asset_js_lib_file_url( 'jscolor' ),
				),
				'realpress-global'       => array(
					'src'  => $source_asset->get_asset_admin_file_url( 'js', 'realpress-global' ),
					'deps' => array( 'wp-api-fetch' ),
				),
				'realpress-settings'     => array(
					'src'     => $source_asset->get_asset_admin_file_url( 'js', 'realpress-settings' ),
					'screens' => array(
						REALPRESS_PROPERTY_SETTING_PAGE,
					),
				),
				'realpress-property'     => array(
					'src'     => $source_asset->get_asset_admin_file_url( 'js', 'realpress-property' ),
					'screens' => array(
						REALPRESS_ADMIN_SINGLE_PROPERTY_PAGE,
					),
				),
				'realpress-user-profile' => array(
					'src'     => $source_asset->get_asset_admin_file_url( 'js', 'realpress-user-profile' ),
					'screens' => array(
						REALPRESS_USER_PROFILE_PAGE,
					),
				),
//				'realpress-edit-block'   => array(
//					'src' => $source_asset->get_asset_admin_file_url( 'js', 'realpress-edit-block' ),
//				),
			),
			'js-translation' => array(
				'realpress-property' => array(
					'src' => REALPRESS_URL . 'languages',
				),
			),
		),
		'frontend' => array(
			'register' => array(
				'realpress-global'           => array(
					'src'  => $source_asset->get_asset_frontend_file_url( 'js', 'realpress-global' ),
					'deps' => array( 'wp-api-fetch' ),
				),
				'realpress-single-property'  => array(
					'src'     => $source_asset->get_asset_frontend_file_url( 'js', 'realpress-single-property' ),
					'deps'    => array( 'wp-api-fetch' ),
					'screens' => array(
						REALPRESS_SINGLE_PROPERTY_PAGE,
					),
				),
				'realpress-archive-property' => array(
					'src'     => $source_asset->get_asset_frontend_file_url( 'js', 'realpress-archive-property' ),
					'deps'    => array( 'wp-api-fetch' ),
					'screens' => array(
						REALPRESS_PROPERTY_ARCHIVE_PAGE,
					),
				),
				'realpress-wishlist'         => array(
					'src'     => $source_asset->get_asset_frontend_file_url( 'js', 'realpress-wishlist' ),
					'deps'    => array( 'wp-api-fetch' ),
					'screens' => array(
						REALPRESS_WISHLIST_PAGE,
					),
				),
				'realpress-agent-list'       => array(
					'src'     => $source_asset->get_asset_frontend_file_url( 'js', 'realpress-agent-list' ),
					'deps'    => array( 'wp-api-fetch' ),
					'screens' => array(
						REALPRESS_AGENT_LIST_PAGE,
					),
				),
				'realpress-agent-detail'     => array(
					'src'     => $source_asset->get_asset_frontend_file_url( 'js', 'realpress-agent-detail' ),
					'deps'    => array( 'wp-api-fetch' ),
					'screens' => array(
						REALPRESS_AGENT_DETAIL_PAGE,
					),
				),
				'realpress-become-an-agent'  => array(
					'src'     => $source_asset->get_asset_frontend_file_url( 'js', 'realpress-become-an-agent' ),
					'deps'    => array( 'wp-api-fetch' ),
					'screens' => array(
						REALPRESS_BECOME_AN_AGENT_PAGE,
					),
				),
			),
		),
	),
);
