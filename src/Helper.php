<?php
declare(strict_types=1);

namespace ItalyStrap\ExperimentalTheme;

final class Helper {

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
}
