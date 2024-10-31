<?php

namespace RealPress\Register\BlockTemplate;

/**
 * Class BlockTemplate
 *
 * Handle register, render block template
 */
class BlockTemplateSingleProperty extends AbstractBlockTemplate {
	public $slug = 'single-realpress-property';
	public $name = 'realpress/single-property';
	public $title = 'Single Property (RealPress)';
	public $description = 'Single Property Block Template';
	public $path_html_block_template_file = 'html/single-property.html';

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
	public function render_content_block_template( array $attributes ) {
		return parent::render_content_block_template( $attributes );
	}
}
