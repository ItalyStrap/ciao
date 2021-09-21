<?php
declare(strict_types=1);

namespace ItalyStrap\ExperimentalTheme;

use ItalyStrap\Config\Config;
use ItalyStrap\Config\ConfigInterface;

final class Custom implements CollectionInterface
{
	use Collectible, ConvertCase;

	/**
	 * @var array[]
	 */
	private $collection;

	/**
	 * @var string
	 */
	private $category;

	/**
	 * @var Config|ConfigInterface
	 */
	private $config;

	public function __construct(
		array $collection,
		ConfigInterface $config = null
	) {
		$this->collection = $collection;
		$this->category = 'custom';
		$this->config = $config ?? new Config();
	}

	/**
	 * @inerhitDoc
	 */
	public function category(): string {
		return $this->category;
	}

	/**
	 * @inerhitDoc
	 */
	public function propOf( string $slug ): string {
		$config = clone $this->config;
		$config->merge( $this->collection );

		if ( ! $config->has( $slug ) ) {
			throw new \RuntimeException("{$slug} does not exists." );
		}

		$keys = \explode( '.', $slug );

		$property = '';
		foreach ( $keys as $word ) {
			$property .= '--' . $word;
		}

		return \sprintf(
			'--wp--%s%s',
			$this->category(),
			$this->camelToUnderscore( $property )
		);
	}

	/**
	 * @inerhitDoc
	 */
	public function varOf( string $slug ): string {
		return \sprintf(
			'var(%s)',
			$this->propOf( $slug )
		);
	}

	/**
	 * @inerhitDoc
	 */
	public function value( string $slug ): string {
		$this->toArray();

		if ( $this->config->has( $slug ) ) {
			return $this->config->get( $slug );
		}

		throw new \RuntimeException("Value of {$slug} does not exists." );
	}

	/**
	 * @inerhitDoc
	 */
	public function toArray(): array {

		$this->config->merge( $this->collection );

		foreach ( $this->config as $key => $item ) {

			$item = (array) $item;

			\array_walk_recursive($item, function ( &$input, $index ) {
				if (  \strpos( (string) $input, '{{' ) !== false ) {
					$input = $this->replacePlaceholder( $input );
				}
			});

			if ( \count( $item ) === 1 && \array_key_exists( 0, $item ) ) {
				$item = $item[0];
			}

			$this->config->add(
				$key,
				$item
			);
		}

		return $this->config->toArray();
	}

	/**
	 * @param string $item
	 * @param $matches
	 * @return array
	 */
	private function replacePlaceholder( string $item ): string {
		\preg_match_all(
			'/(?:{{.*?}})+/',
			$item,
			$matches
		);

		foreach ($matches[ 0 ] as $match) {
			$item = \str_replace(
				$match,
				$this->findCssVariable( \str_replace( ['{{', '}}'], '', $match ) ),
				$item
			);
		}
		return $item;
	}

	/**
	 * @param string $slug_or_default
	 * @return mixed|string
	 */
	private function findCssVariable( string $slug_or_default ) {

		/** @var array $splitted_values */
		$splitted_values = \explode( '|', $slug_or_default, 2 );

		$value = $splitted_values[ 1 ] ?? '';

		try {
			$value = $this->varOf( $splitted_values[ 0 ] );
		} catch (\RuntimeException $exception) {
			// fail in silence
		}

		if ( false !== \strpos( $splitted_values[0], '.' ) ) {
			$search_in_collection = \explode('.', $splitted_values[0] );
			foreach ( $this->collection_of_collections as $collection ) {
				if ( $collection->category() === $search_in_collection[ 0 ] ) {
					$value = $collection->varOf( $search_in_collection[ 1 ] );
				}
			}
		}

		return $value;
	}
}