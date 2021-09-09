<?php
declare(strict_types=1);

namespace ItalyStrap\ExperimentalTheme;

class Preset implements Collection {

	/**
	 * @var array[]
	 */
	private $collection;

	/**
	 * @var string
	 */
	private $category;

	/**
	 * @var string
	 */
	private $key;

	/**
	 * @param array[] $collection
	 * @param string $category
	 * @param string $key
	 */
	public function __construct( array $collection, string $category, string $key = '' ) {
		$this->collection = $collection;
		$this->category = $category;
		$this->key = '' === $key ? $category : $key ;
	}

	/**
	 * @link https://stackoverflow.com/a/40514305/7486194
	 * @param string $string
	 * @param string $us
	 * @return string
	 */
	private function camelToUnderscore( string $string, string $us = '-' ): string {
		return \strtolower( \preg_replace(
			'/(?<=\d)(?=[A-Za-z])|(?<=[A-Za-z])(?=\d)|(?<=[a-z])(?=[A-Z])/', $us, $string ) );
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
	public function propFor( string $slug ): string {

		foreach ( $this->collection as $item ) {
			if ( \in_array( $slug, $item, true ) ) {
				return \sprintf(
					'--wp--preset--%s--%s',
					$this->camelToUnderscore( $this->category() ),
					$this->camelToUnderscore( $slug )
				);
			}
		}

		throw new \RuntimeException("{$slug} does not exists." );
	}

	/**
	 * @inerhitDoc
	 */
	public function varFor( string $slug ): string {
		return \sprintf(
			'var(%s)',
			$this->propFor( $slug )
		);
	}

	/**
	 * @inerhitDoc
	 */
	public function value( string $slug ): string {

		/**
		 * @var $item array
		 */
		foreach ( $this->toArray() as $item ) {
			if ( \in_array( $slug, $item, true ) ) {
				return $item[ $this->key ];
			}
		}

		throw new \RuntimeException("Value of {$slug} does not exists." );
	}

	/**
	 * @inerhitDoc
	 */
	public function toArray(): array {

		foreach ( $this->collection as $key => $item ) {

			\preg_match(
				'/{{(.*?)}}/i',
				$item[$this->key],
				$matches
			);

			if ( \array_key_exists( 1, $matches ) ) {
				$this->collection[ $key ][ $this->key ] = \str_replace(
					$matches[0],
					$this->varFor( (string) $matches[1] ),
					$this->collection[ $key ][ $this->key ]
				);
			}
		}

		return $this->collection;
	}
}