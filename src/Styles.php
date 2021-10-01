<?php
declare(strict_types=1);

namespace ItalyStrap\ExperimentalTheme;


class Styles
{

	public function borderValues(
		string $color,
		string $radius,
		string $style,
		string $with
	): array {
		return [
			'color' => $color,
			'radius' => $radius,
			'style' => $style,
			'width' => $with,
		];
	}
}