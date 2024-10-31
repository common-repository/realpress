<?php

namespace RealPress\Helpers;

use NumberFormatter;

/**
 * Price
 */
class Price {
	public static function get_formatted_price( $price, string $text_after_price = '' ) {
		if ( ! is_numeric( $price ) ) {
			return '';
		}
		$currency_symbol     = self::get_currency_symbol();
		$currency_position   = Settings::get_setting_detail( 'group:currency:fields:position' );
		$thousands_separator = Settings::get_setting_detail( 'group:currency:fields:thousands_separator' );
		$decimal_separator   = Settings::get_setting_detail( 'group:currency:fields:decimals_separator' );
		$number_of_decimals  = Settings::get_setting_detail( 'group:currency:fields:number_of_decimals' );

		if ( empty( $number_of_decimals ) ) {
			$number_of_decimals = 0;
		}

		$formatted_price = number_format( $price, $number_of_decimals, $decimal_separator, $thousands_separator );

		switch ( $currency_position ) {
			case 'left':
				$formatted_price = $currency_symbol . $formatted_price;
				break;
			case 'right':
				$formatted_price = $formatted_price . $currency_symbol;
				break;
			case 'left_space':
				$formatted_price = $currency_symbol . ' ' . $formatted_price;
				break;
			case 'right_space':
				$formatted_price = $formatted_price . ' ' . $currency_symbol;
				break;
			default:
				break;
		}

		return $formatted_price . $text_after_price;
	}

	/**
	 * @param string $currency_code
	 *
	 * @return array|false|mixed|\stdClass|string
	 */
	public static function get_currency_symbol( string $currency_code = '' ) {
		if ( empty( $currency_code ) ) {
			$currency_code = Settings::get_setting_detail( 'group:currency:fields:code' );
		}

		if ( class_exists( 'NumberFormatter' ) ) {
			$fmt = new \NumberFormatter( get_locale(), NumberFormatter::CURRENCY );

			return $fmt->getSymbol( NumberFormatter::CURRENCY_SYMBOL );
		} else {
			$currency_symbols = Config::instance()->get( 'currency:currency-symbol' );
			if ( isset( $currency_symbols[ $currency_code ] ) ) {
				return $currency_symbols[ $currency_code ];
			}
		}

		return $currency_code;
	}
}