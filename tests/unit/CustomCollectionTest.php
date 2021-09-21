<?php
declare(strict_types=1);

namespace ItalyStrap\Tests;

use ItalyStrap\ExperimentalTheme\CollectionInterface;
use ItalyStrap\ExperimentalTheme\Custom;

class CustomCollectionTest extends BaseCollectionTest
{
    /**
     * @var \UnitTester
     */
    protected $tester;

	protected function _before() {

		$this->collection = [
			'contentSize'	=> '60vw',
			'wideSize'	=> '80vw',
			'baseFontSize' => "1rem",
			'spacer' => [
				'base'	=> '1rem',
				'v'		=> 'calc(var(--wp--custom--spacer--base)*4)',
				'h'		=> 'calc(var(--wp--custom--spacer--base)*4)',
			],
			'lineHeight' => [
				'small' => 1.2,
				'medium' => 1.4,
				'large' => 1.8
			],
			'very' => [
				'indented' => [
					'multiDimensional'	=> [
						'inner'	=> 'element',
					],
				],
			],
		];

		$this->category = 'custom';
	}

    protected function _after()
    {
    }

	protected function getInstance(): CollectionInterface {
		$sut = new Custom( $this->collection, $this->category );
		$this->assertInstanceOf( CollectionInterface::class, $sut, '' );
		$this->assertInstanceOf( Custom::class, $sut, '' );
		return $sut;
	}

	/**
	 * @test
	 */
	public function itShouldWorksWithCustom() {

		$this->category = 'custom';

		$sut = $this->getInstance();
		$sut->value('contentSize');
		$sut->toArray();
	}

	public function valueProvider() {
		yield 'Custom content size' => [
			'60vw', // Expected
			'contentSize', // Slug
			'custom', // Category
		];

		yield 'Custom spacer base' => [
			'1rem', // Expected
			'spacer.base', // Slug
			'custom', // Category
		];
	}

	/**
	 * @dataProvider valueProvider
	 * @test
	 */
	public function itShouldReturnValidValue(
		string $expected,
		string $slug,
		string $category
	) {

		$this->collection = [
			'contentSize'	=> '60vw',
			'wideSize'	=> '80vw',
			'baseFontSize' => "1rem",
			'spacer' => [
				'base'	=> '1rem',
				'v'		=> 'calc(var(--wp--custom--spacer--base)*4)',
				'h'		=> 'calc(var(--wp--custom--spacer--base)*4)',
			],
			'lineHeight' => [
				'small' => 1.2,
				'medium' => 1.4,
				'large' => 1.8
			],
		];

		$this->category = $category;

		$sut = $this->getInstance();

		$this->assertIsString( $sut->value( $slug ) );

		$this->assertStringMatchesFormat(
			$expected,
			$sut->value( $slug ),
			''
		);
	}

	public function propertiesProvider() {
		yield 'Base font size' => [
			'--wp--custom--base-font-size',
			'baseFontSize'
		];
		yield 'Base spacer' => [
			'--wp--custom--spacer--base',
			'spacer.base'
		];
		yield 'Inner element' => [
			'--wp--custom--very--indented--multi-dimensional--inner',
			'very.indented.multiDimensional.inner'
		];
	}

	/**
	 * @dataProvider propertiesProvider
	 * @test
	 */
	public function itShouldReturnCssPropertyFor( string $expected, string $slug ) {

		$sut = $this->getInstance();

		$this->assertStringMatchesFormat(
			$expected,
			$sut->propOf( $slug ),
			''
		);
	}
}