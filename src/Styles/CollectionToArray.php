<?php
declare(strict_types=1);

namespace ItalyStrap\ExperimentalTheme\Styles;

trait CollectionToArray {

	public function toArray(): array {
		return \array_filter( $this->collection );
	}
}
