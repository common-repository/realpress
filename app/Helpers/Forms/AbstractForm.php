<?php

namespace RealPress\Helpers\Forms;

use RealPress\Helpers\Template;

/**
 * AbstractForm
 */
abstract class  AbstractForm {
	/**
	 * @var string id of field, require unique
	 */
	public $id = '';
	/**
	 * @var string class of field
	 */
	public $class;
	/**
	 * @var string $description of field
	 */
	public $description;
	/**
	 * @var string title of field
	 */
	public $title;
	/**
	 * @var string value of field
	 */
	public $data;
	/**
	 * key to get the value of field
	 * @var
	 */
	public $name;
	/**
	 * @var path file template of form
	 */
	public $path_view = '';

	public $key;

	public function render() {
		Template::instance()->get_admin_template( $this->path_view, array( 'field' => $this ) );
	}

	public function set_args( $args ): self {
		$properties = array_keys( get_object_vars( $this ) );

		foreach ( $properties as $property ) {
			$this->{$property} = $args[ $property ] ?? $this->{$property} ?? '';
			if ( ! empty( $this->{$property} ) && in_array( $property, array( 'id', 'class' ) ) ) {
				$this->{$property} = REALPRESS_PREFIX . '_' . $this->{$property};
			}
		}

		return $this;
	}
}
