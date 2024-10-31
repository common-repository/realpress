<?php

namespace RealPress\Helpers\Fields;

/**
 * Class Select
 * @package RealPress\Helpers\AbstractForm
 */
class Select extends AbstractField {
	public $options;
	public $is_select2 = false;
	public $is_multiple = false;
	/**
	 * @var string path file template of field
	 */
	public $path_view = 'fields/select.php';

	public function __construct() {
	}
}
