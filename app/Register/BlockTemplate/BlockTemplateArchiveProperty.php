<?php

namespace RealPress\Register\BlockTemplate;

/**
 * Class BlockTemplate
 *
 * Handle register, render block template
 */
class BlockTemplateArchiveProperty extends AbstractBlockTemplate {
	public $slug                          = 'archive-realpress-property';
	public $name                     = 'realpress/archive-property';
	public $title                         = 'Archive Properties (RealPress)';
	public $description                   = 'Archive Property Block Template';
	public $path_html_block_template_file = 'html/archive-property.html';

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
//		Debug::var_dump($attributes);

		return parent::render_content_block_template( $attributes );
	}
}
