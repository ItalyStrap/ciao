<?php
declare(strict_types=1);

namespace ItalyStrap\ExperimentalTheme;


use ItalyStrap\Config\Config;
use ItalyStrap\Config\ConfigInterface;

final class Custom implements CollectionInterface
{
	/**
	 * @var array[]
	 */
	private $collection;

	/**
	 * @var string
	 */
	private $category;

	public function __construct(
		array $collection,
		string $category,
		ConfigInterface $config = null
	) {
		$this->collection = $collection;
		$this->category = $category;
		$this->config = $config ?? new Config();
	}

	/**
	 * @inerhitDoc
	 */
	public function category(): string {
		return $this->category;
	}

	public function propOf( string $slug ): string {
		$this->toArray();

		if ( ! $this->config->has( $slug ) ) {
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

	public function value( string $slug ): string {
		$this->toArray();

		if ( $this->config->has( $slug ) ) {
			return $this->config->get( $slug );
		}

		throw new \RuntimeException("Value of {$slug} does not exists." );
	}

	public function toArray(): array {
		$this->config->merge($this->collection);
		return $this->config->toArray();
	}

	public function withCollection( CollectionInterface ...$collections ): void {
		// TODO: Implement withCollection() method.
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
}