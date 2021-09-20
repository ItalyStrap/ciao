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

		$this->assertStringMatchesFormat(
			$expected,
			$sut->category(),
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
	public function itShouldReturnValidValue() {

		$expected = '#ffffff';

		$this->collection = [
			[
				'slug'	=> 'primary',
				'color'	=> $expected,
			],
		];

		$this->category = 'color';

		$sut = $this->getInstance();

		$this->assertIsString( $sut->value( 'primary' ) );

		$this->assertStringMatchesFormat(
			$expected,
			$sut->value('primary' ),
			''
		);
	}

	public function variableProvider() {
		yield 'Primary color' => [
			'--wp--preset--color--primary',
			'primary',
			'#ffffff',
		];

		yield 'Secondary color' => [
			'--wp--preset--color--secondary',
			'secondary',
			'#000000',
		];

		yield 'Foo color' => [
			'--wp--preset--color--foo',
			'Foo',
			'#000000',
		];

		yield 'FooBar color' => [
			'--wp--preset--color--foo-bar',
			'FooBar',
			'#000000',
		];

		yield 'Foo123 color' => [
			'--wp--preset--color--foo-123',
			'Foo123',
			'#000000',
		];

		yield 'Foo123Bar color' => [
			'--wp--preset--color--foo-123-bar',
			'Foo123Bar',
			'#000000',
		];

		yield 'foo color' => [
			'--wp--preset--color--foo',
			'foo',
			'#000000',
		];

		yield 'fooBar color' => [
			'--wp--preset--color--foo-bar',
			'fooBar',
			'#000000',
		];

		yield 'foo123 color' => [
			'--wp--preset--color--foo-123',
			'foo123',
			'#000000',
		];

		yield '123Foo color' => [
			'--wp--preset--color--123-foo',
			'123Foo',
			'#000000',
		];

		yield 'fooBar123 color' => [
			'--wp--preset--color--foo-bar-123',
			'fooBar123',
			'#000000',
		];

		yield 'foo123Bar color' => [
			'--wp--preset--color--foo-123-bar',
			'foo123Bar',
			'#000000',
		];

		yield '123FooBar color' => [
			'--wp--preset--color--123-foo-bar',
			'123FooBar',
			'#000000',
		];
	}

	/**
	 * @dataProvider variableProvider
	 * @test
	 */
	public function itShouldReturnVariableCssFor( string $expected, string $prop, string $value ) {

		$this->collection = [
			[
				'slug'	=> $prop,
				'color'	=> $value,
			],
		];

		$this->category = 'color';

		$sut = $this->getInstance();

		$this->assertStringMatchesFormat(
			$expected,
			$sut->propOf( $prop ),
			''
		);
	}

	/**
	 * @test
	 */
	public function itShouldReturnVarFunctionCssWithVariableCss() {
		$sut = $this->getInstance();

		$this->assertStringMatchesFormat(
			'var(--wp--preset--color--primary)',
			$sut->varOf('primary' ),
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
		$val = $sut->value('secondary' );
	}

	/**
	 * @test
	 */
	public function itShouldThrownExceptionIfPropDoesNotExist() {
		$sut = $this->getInstance();
		$this->expectException( \RuntimeException::class );
		$this->expectExceptionMessage('secondary does not exists.');
		$prop = $sut->propOf('secondary' );
	}

	public function placeholderProvider() {

		/**
		 * [
		 * 	// expected
		 *  // slug
		 *  // value
		 * ]
		 */

		yield 'Base with CSS property' => [
			'calc(var(--wp--preset--font-size--base)*2)',
			'h1',
			'calc({{base}}*2)',
		];

		yield 'With Default Value 20px' => [
			'calc(20px*2)',
			'h2',
			'calc({{propInexistent|20px}}*2)',
		];

		yield 'Accept only the first two value separated from |' => [
			'20px|15',
			'h2',
			'{{propInexistent|20px|15}}',
		];
	}

	/**
	 * @dataProvider placeholderProvider
	 * @test
	 */
	public function itShouldReplaceStringPlaceholder(
		string $expected,
		string $slug,
		string $value
	) {

		$this->collection = [
			[
				'slug'	=> 'base',
				'size'	=> '20px',
			],
			[
				'slug'	=> $slug,
				'size'	=> $value,
			],
		];

		$this->category = 'fontSize';
		$this->key = 'size';

		$sut = $this->getInstance();

		$this->assertStringMatchesFormat(
			$expected,
			$sut->value( $slug ),
			''
		);
	}

	/**
	 * @test
	 */
	public function itShouldGetValueFromOtherCollection() {
		$expected = 'linear-gradient(160deg,var(--wp--preset--color--text),var(--wp--preset--color--background))';

		$this->collection = [
			[
				'slug'	=> 'background',
				'color'	=> '#ffffff',
			],
			[
				'slug'	=> 'text',
				'color'	=> '#000000',
			],
		];

		$this->category = 'color';
		$this->key = 'color';

		$palette = $this->getInstance();

		$this->collection = [
			[
				'slug'	=> 'black-to-white',
				'gradient'	=> \sprintf(
					'linear-gradient(160deg,%s,%s)',
					'{{color.text}}',
					'{{color.background}}'
				),
			],
		];

		$this->category = 'gradient';
		$this->key = 'gradient';

		$gradient = $this->getInstance();

		$gradient->withCollection( $palette );
//		$gradient->withCollection( $palette, $palette, $palette );

		$this->assertStringMatchesFormat(
			$expected,
			$gradient->value('black-to-white' ),
			''
		);
	}
}
