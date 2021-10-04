<?php
declare(strict_types=1);

namespace ItalyStrap\ExperimentalTheme\Styles;

final class Spacing implements ArrayableInterface  {

	use ImmutableCollectionTrait, CollectionToArray;

	const TOP = 'top';
	const RIGHT = 'right';
	const BOTTOM = 'bottom';
	const LEFT = 'left';

	public function top( string $value ): self {
		$this->setCollection( self::TOP, $value );
		return $this;
	}

	public function right( string $value ): self {
		$this->setCollection( self::RIGHT, $value );
		return $this;
	}

	public function bottom( string $value ): self {
		$this->setCollection( self::BOTTOM, $value );
		return $this;
	}

	public function left( string $value ): self {
		$this->setCollection( self::LEFT, $value );
		return $this;
	}
}