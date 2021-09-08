<?php
declare(strict_types=1);

namespace ItalyStrap\Tests;

use Codeception\Test\Unit;
use ItalyStrap\ExperimentalTheme\JsonData;

class ColorPaletteCollectionTest extends Unit {

	/**
	 * @var \UnitTester
	 */
	protected $tester;
	
	protected function _before() {
		$this->collection = [
			[
				'slug'	=> 'primary',
				'color'	=> '#ffffff',
			],
		];
		$this->category = 'color';
	}

	protected function _after() {
	}

	protected function getInstance() {
		$sut = new JsonData( $this->collection, $this->category );
		$this->assertInstanceOf( JsonData::class, $sut, '' );
		return $sut;
	}

	/**
	 * @test
	 */
	public function itShouldReturnValue() {

		$sut = $this->getInstance();

		$this->assertIsString( $sut->value( 'primary' ) );

		$this->assertStringContainsString(
			'#ffffff',
			$sut->value('primary' ),
			''
		);
	}

	/**
	 * @test
	 */
	public function itShouldReturnVariableCss() {
		$sut = $this->getInstance();

		$this->assertStringContainsString(
			'--wp--preset--color--primary',
			$sut->cssProp('primary' ),
			''
		);
	}

	/**
	 * @test
	 */
	public function itShouldReturnVarFunctionCssWithVariableCss() {
		$sut = $this->getInstance();

		$this->assertStringContainsString(
			'var(--wp--preset--color--primary)',
			$sut->cssFuncVar('primary' ),
			''
		);
	}

	/**
	 * @test
	 */
	public function itShouldThrownExceptionIfValueDoesNotExist() {
		$sut = $this->getInstance();
		$this->expectException( \RuntimeException::class );
		$this->expectExceptionMessage('Value of secondary does not exists.');
		$prop = $sut->value('secondary' );
	}

	/**
	 * @test
	 */
	public function itShouldThrownExceptionIfPropDoesNotExist() {
		$sut = $this->getInstance();
		$this->expectException( \RuntimeException::class );
		$this->expectExceptionMessage('secondary does not exists.');
		$prop = $sut->cssProp('secondary' );
	}

	/**
	 * @test
	 */
	public function itShouldReturnTheCollection() {
		$sut = $this->getInstance();
		$collection = $sut->collection();

		$this->assertEquals($this->collection, $collection, '');
	}

	/**
	 * @test
	 */
	public function itShouldConvertCamelCaseToKebabCase() {
		$test_values = [
			'Foo'       => 'foo',
			'FooBar'    => 'foo-bar',
			'Foo123'    => 'foo-123',
			'FooBar123' => 'foo-bar-123',
			'Foo123Bar' => 'foo-123-bar',

			'foo'       => 'foo',
			'fooBar'    => 'foo-bar',
			'foo123'    => 'foo-123',
			'123Foo'    => '123-foo',
			'fooBar123' => 'foo-bar-123',
			'foo123Bar' => 'foo-123-bar',
			'123FooBar' => '123-foo-bar',
		];

		foreach ( $test_values as $key => $value ) {
			$result = $this->camelToUnderscore( $key );

			$this->assertStringContainsString(
				$value,
				$result,
				''
			);
		}
	}

	/**
	 * @link https://stackoverflow.com/a/40514305/7486194
	 * @param $string
	 * @param string $us
	 * @return string
	 */
	private function camelToUnderscore( $string, $us = '-' ) {
		return strtolower(preg_replace(
			'/(?<=\d)(?=[A-Za-z])|(?<=[A-Za-z])(?=\d)|(?<=[a-z])(?=[A-Z])/', $us, $string));
	}
}
