<?php
declare(strict_types=1);

namespace ItalyStrap\ExperimentalTheme;


final class Helper
{
	public static function templateParts( string $name, string $area ): array {
		return [
			'name' => $name,
			'area' => $area,
		];
	}

	public static function customTemplates( string $name, string $title, array $post_types ): array {
		return [
			'name' 		=> $name,
			'area' 		=> $title,
			'postTypes'	=> $post_types,
		];
	}

	public static function spacing(
		string $top = '',
		string $right = '',
		string $bottom = '',
		string $left = ''
	): array {
		return \array_filter(
			[
				'top'		=> $top,
				'right'		=> $right,
				'bottom'	=> $bottom,
				'left'		=> $left,
			]
		);
	}

	public static function color(
		string $background = '',
		string $gradient = '',
		string $text = ''
	): array {
		return \array_filter(
			[
				'background' => $background,
				'gradient' => $gradient,
				'text' => $text,
			]
		);
	}

	public static function colorText( string $text = '' ): array {
		return self::color( '', '', $text );
	}

	public static function spacingTop( string $value = '' ): array {
		return \ItalyStrap\ExperimentalTheme\Factory\Spacing::top( $value )->toArray();
	}

	public static function spacingRight( string $value = '' ): array {
		return \ItalyStrap\ExperimentalTheme\Factory\Spacing::right( $value )->toArray();
	}

	public static function spacingBottom( string $value = '' ): array {
		return \ItalyStrap\ExperimentalTheme\Factory\Spacing::bottom( $value )->toArray();
	}

	public static function spacingLeft( string $value = '' ): array {
		return \ItalyStrap\ExperimentalTheme\Factory\Spacing::left( $value )->toArray();
	}

	public static function spacingVertical( string $value ): array {
		return \ItalyStrap\ExperimentalTheme\Factory\Spacing::vertical( $value )->toArray();
	}

	public static function spacingHorizontal( string $value ): array {
		return \ItalyStrap\ExperimentalTheme\Factory\Spacing::horizontal( $value )->toArray();
	}
}