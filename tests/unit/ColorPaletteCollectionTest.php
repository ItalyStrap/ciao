<?php
declare(strict_types=1);

namespace ItalyStrap\Tests;

use Codeception\Test\Unit;
use ItalyStrap\ExperimentalTheme\Preset;

class ColorPaletteCollectionTest extends Unit {

	/**
	 * @var \UnitTester
	 */
	protected $tester;

	/**
	 * @var \string[][]
	 */
	private $collection;

	/**
	 * @var string
	 */
	private $category;

	/**
	 * @var string
	 */
	private $key = '';

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
		$sut = new Preset( $this->collection, $this->category, $this->key );
		$this->assertInstanceOf( Preset::class, $sut, '' );
		return $sut;
	}

	/**
	 * @test
	 */
	public function itShouldHaveCategory() {
		$expected = 'expected';
		$this->category = $expected;
		$sut = $this->getInstance();

		$this->assertStringContainsString(
			$expected,
			$sut->category(),
			''
		);
	}

	/**
	 * @test
	 */
	public function itShouldReturnValidValue() {

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
			$sut->propFor('primary' ),
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
			$sut->varFor('primary' ),
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
		$prop = $sut->propFor('secondary' );
	}

	/**
	 * @test
	 */
	public function itShouldReplaceStringPlaceholder() {

		$this->collection = [
			[
				'slug'	=> 'base',
				'size'	=> '20px',
			],
			[
				'slug'	=> 'h1',
				'size'	=> 'calc({{base}}*2)',
			],
		];

		$this->category = 'fontSize';
		$this->key = 'size';

		$sut = $this->getInstance();

		$this->assertStringContainsString(
			'calc(var(--wp--preset--font-size--base)*2)',
			$sut->value('h1' ),
			''
		);
	}

	/**
	 * @test
	 */
	public function itShouldReturnTheCollection() {
		$sut = $this->getInstance();
		$collection = $sut->toArray();

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
