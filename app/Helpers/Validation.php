<?php

namespace RealPress\Helpers;

use RealPress\Helpers\Forms\AdditionalField;
use RealPress\Helpers\Forms\FloorPlan;
use RealPress\Helpers\Fields\FileUpload;
use RealPress\Helpers\Fields\Number;

/**
 * Class Validation
 * @package RealPress\Helpers
 */
class Validation {
	/**
	 * @param $value
	 * @param $type
	 *
	 * @return array|mixed
	 */
	public static function filter_fields( $value, $field ) {
		if ( empty( $value ) ) {
			return $value;
		}

		if ( $field['type'] instanceof AdditionalField ) {
			$value = self::filter_additional_fields( $value );
		}

		if ( $field['type'] instanceof FloorPlan ) {
			foreach ( $value as $key => $floor_plan ) {
				if ( empty( $floor_plan['image']['image_id'] ) ) {
					continue;
				}
				$plan_image_field = $field['fields']['image'] ?? array();

				if ( ! empty( $plan_image_field['max_file_size'] ) ) {
					$is_valid_image = self::is_valid_max_file_size( $floor_plan['image']['image_id'], $plan_image_field['max_file_size'] );
					if ( ! $is_valid_image ) {
						$value[ $key ]['image'] = array();
					}
				}
			}
		}

		if ( $field['type'] instanceof FileUpload ) {
			if ( empty( $field['multiple'] ) ) {
				if ( ! empty( $field['max_file_size'] ) ) {
					$is_valid_max_file_size = self::is_valid_max_file_size( $value['image_id'], $field['max_file_size'] );
					if ( ! $is_valid_max_file_size ) {
						$value = array();
					}
				}

				if ( isset( $field['max_size'] ) && ! empty( $field['max_size'] ) ) {
					$is_valid_max_size = self::is_valid_max_size( $value['image_id'], $field['max_size'] );
					if ( ! $is_valid_max_size ) {
						$value = array();
					}
				}
			} else {
				$value          = explode( ',', $value );
				$attachment_ids = array();
				foreach ( $value as $attachment_id ) {
					if ( ! empty( $field['max_file_size'] ) ) {
						$is_valid_max_file_size = self::is_valid_max_file_size( $attachment_id, $field['max_file_size'] );
						if ( ! $is_valid_max_file_size ) {
							continue;
						}
					}

					if ( ! empty( $field['max_size'] ) ) {
						$is_valid_max_size = self::is_valid_max_size( $attachment_id, $field['max_size'] );
						if ( ! $is_valid_max_size ) {
							continue;
						}
					}

					$attachment_ids[] = $attachment_id;
				}
				$value = implode( ',', $attachment_ids );
			}
		}

		if ( $field['type'] instanceof Number ) {
			if ( ! self::is_valid_number( $value, $field ) ) {
				$value = '';
			};
		}

		return $value;
	}

	/**
	 * @param array $value
	 *
	 * @return array
	 */
	public static function filter_additional_fields( array $value ) {
		foreach ( $value as $key => $fields ) {
			if ( empty( $fields['label'] ) || empty( $fields['value'] ) ) {
				unset( $value[ $key ] );
			}
		}

		return array_values( $value );
	}

	/**
	 * @param $attachment_id
	 * @param $max_file_size
	 *
	 * @return bool
	 */
	public static function is_valid_max_file_size( $attachment_id, $max_file_size ) {
		if ( empty( $attachment_id ) ) {
			return true;
		}
		$file_size  = 0;
		$attachment = wp_get_attachment_metadata( $attachment_id );

		if ( $attachment ) {
			$file_size = $attachment['filesize'];
		}

		if ( empty( $max_file_size ) ) {
			return true;
		}

		$max_file_size = $max_file_size * 1024;

		if ( $file_size <= $max_file_size ) {
			return true;
		}

		return false;
	}

	public static function is_valid_max_size( $attachment_id, array $max_size ) {
		if ( empty( $attachment_id ) || empty( $max_size ) ) {
			return true;
		}
		$attachment = wp_get_attachment_metadata( $attachment_id );

		if ( $attachment['width'] <= $max_size['width'] && $attachment['height'] <= $max_size['height'] ) {
			return true;
		}

		return false;
	}

	/**
	 * @param $value
	 * @param $cb
	 *
	 * @return array|mixed|string
	 */
	public static function sanitize_params_submitted( $value, $type_content = 'text' ) {
		$value = wp_unslash( $value );

		if ( is_string( $value ) ) {
			$value = trim( $value );
			switch ( $type_content ) {
				case 'html':
					$value = General::ksesHTML( $value );
					break;
				case 'textarea':
					$value = implode( '\n', array_map( 'sanitize_textarea_field', explode( '\n', $value ) ) );
					break;
				case 'key':
					$value = sanitize_key( $value );
					break;
				default:
					$value = sanitize_text_field( $value );
			}
		} elseif ( is_array( $value ) ) {
			return array_map( [ __CLASS__, 'sanitize_params_submitted' ], $value );
		}

		return $value;
	}

	/**
	 * @param $value
	 * @param $field
	 *
	 * @return bool
	 */
	public static function is_valid_number( $value, $field ) {
		if ( is_numeric( $value ) ) {
			if ( isset( $field['min'] ) ) {
				if ( ! is_numeric( $field['min'] ) || $value < $field['min'] ) {
					return false;
				}
			}

			if ( isset( $field['max'] ) ) {
				if ( ! is_numeric( $field['max'] ) || $value > $field['max'] ) {
					return false;
				}
			}
		}

		return true;
	}
}

