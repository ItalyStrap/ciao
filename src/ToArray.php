<?php
declare(strict_types=1);

namespace ItalyStrap\ExperimentalTheme;

trait ToArray
{
	public function toArray(): array {
		return $this->collection;
	}
}