<?php

namespace RealPress\Register\BlockTemplate;

use RealPress\Helpers\Debug;
use RealPress\Helpers\Page;

/**
 * Class BlockTemplate
 *
 * Handle register, render block template
 */
class BlockTitleProperty extends AbstractBlockTemplate {
	public $slug = 'realpress-title-property';
	public $name = 'realpress/property-title';
	public $title = 'Single Property (RealPress)';
	public $description = 'Single Property Block Template';
	public $path_html_block_template_file = '';
	public $inner_block = REALPRESS_DIR . 'assets\src\js\admin\block\property\title\block.json';

	public function __construct() {
		parent::__construct();
	}

	/**
	 * Render content of block tag
	 *
	 * @param array $attributes | Attributes of block tag.
	 *
	 * @return false|string
	 */
	public function render_content_inner_block_template( array $attributes, $content, $block ) {
		ob_start();

		echo 'Page current: ' . esc_html( Page::get_current_page() );

		// Debug::var_dump( $attributes );
		Debug::var_dump( $attributes );

		return ob_get_clean();
	}
}
