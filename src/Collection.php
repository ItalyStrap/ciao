<?php
declare(strict_types=1);

namespace ItalyStrap\ExperimentalTheme;

interface Collection
{
	/**
	 * @return string
	 */
	public function category(): string;

	/**
	 * @param string $slug
	 * @return string
	 */
	public function propFor( string $slug ): string;

	/**
	 * @param string $slug
	 * @return string
	 */
	public function varFor( string $slug ): string;

	/**
	 * @param string $slug
	 * @return string
	 */
	public function value( string $slug ): string;

	/**
	 * @return array[]
	 */
	public function toArray(): array;
}