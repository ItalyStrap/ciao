<?php
declare(strict_types=1);

namespace ItalyStrap\ExperimentalTheme\Factory;

use \ItalyStrap\ExperimentalTheme\Styles\Color as BaseColor;

final class Color {

	public static function make(): BaseColor {
		return new BaseColor();
	}

	public static function text( string $value ): BaseColor {
		return self::make()->text( $value );
	}

	public static function background( string $value ): BaseColor {
		return self::make()->background( $value );
	}

	public static function gradient( string $value ): BaseColor {
		return self::make()->gradient( $value );
	}
}