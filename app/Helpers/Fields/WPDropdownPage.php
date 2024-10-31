<?php

namespace RealPress\Helpers\Fields;

/**
 * Class WPEditor
 * @package RealPress\Helpers\AbstractForm
 */
class WPDropdownPage extends AbstractField {
	public $path_view = 'fields/wp-dropdown-page.php';
	public $args;
	public $allow_create_page;
	public function __construct() {
	}
}
