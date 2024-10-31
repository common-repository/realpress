<?php

namespace RealPress\Helpers\Fields;

/**
 * Class Textarea
 * @package RealPress\Helpers\AbstractForm
 */
class Textarea extends AbstractField {
	public $path_view = 'fields/textarea.php';
	/**
	 * @var int
	 */
	public $rows = 3;
	public $placeholder;

	public function __construct() {
	}
}
