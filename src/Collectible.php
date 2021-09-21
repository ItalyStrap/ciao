<?php
declare(strict_types=1);

namespace ItalyStrap\ExperimentalTheme;

trait Collectible
{
	/**
	 * @var CollectionInterface[]
	 */
	private $collection_of_collections = [];

	public function withCollection( CollectionInterface ...$collections ): void {
		$this->collection_of_collections = \array_merge_recursive(
			$this->collection_of_collections,
			$collections
		);
	}

}