<?php
declare(strict_types=1);

namespace ItalyStrap\ExperimentalTheme;

final class Color {

	use ImmutableCollectionTrait, ToArray;

	const BACKGROUND = 'background';
	const GRADIENT = 'gradient';
	const TEXT = 'text';

	public function background( string $value ): self {
		$this->setCollection( self::BACKGROUND, $value );
		return $this;
	}

	public function gradient( string $value ): self {
		$this->setCollection( self::GRADIENT, $value );
		return $this;
	}

	public function text( string $value ): self {
		$this->setCollection( self::TEXT, $value );
		return $this;
	}
}