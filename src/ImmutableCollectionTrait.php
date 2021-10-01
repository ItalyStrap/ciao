<?php
declare(strict_types=1);

namespace ItalyStrap\ExperimentalTheme;

trait ImmutableCollectionTrait
{
	/**
	 * @var array<string, string>
	 */
	private array $collection = [];

	final private function setCollection( string $key, string $value ): self {
		$this->assertIsImmutable( $key );
		$this->collection[ $key ] = $value;
		return $this;
	}

	final private function assertIsImmutable( string $key ): void {
		if ( \array_key_exists( $key, $this->collection ) ) {
			throw new \RuntimeException( \sprintf(
				'The key "%s" is already provided',
				$key
			) );
		}
	}
}