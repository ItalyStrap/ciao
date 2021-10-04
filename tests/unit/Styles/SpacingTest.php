<?php
declare(strict_types=1);

namespace ItalyStrap\Tests\Styles;

use Codeception\Test\Unit;
use ItalyStrap\ExperimentalTheme\Styles\Spacing;
use ItalyStrap\Tests\BaseUnitTrait;

class SpacingTest extends Unit {

	use BaseUnitTrait, CommonTests;

	protected function getInstance(): Spacing {
		$sut = new Spacing();
		$this->assertInstanceOf( Spacing::class, $sut, '' );
		return $sut;
	}

	public function methodsProvider(): \Generator {
		yield 'Top' => [
			'top',
			'25px'
		];

		yield 'Right' => [
			'right',
			'25px'
		];

		yield 'Bottom' => [
			'bottom',
			'25px'
		];

		yield 'Left' => [
			'left',
			'25px'
		];
	}

	/**
	 * @dataProvider methodsProvider
	 * @test
	 */
	public function itShouldReturnAnArray( string $method, string $value ) {

		$sut = $this->getInstance();
//		$sut->top('25px')
//			->right('25px')
//			->bottom( '25px' )
//			->left('25px');

		codecept_debug( \get_class_methods( $sut ) );

		\call_user_func( [ $sut, $method ], $value );

		$this->assertIsArray( $sut->toArray(), '' );
	}

	/**
	 * @test
	 */
	public function itShouldReturnTheCorrectValue() {

		$sut = $this->getInstance();
		$sut->top('25px')
			->right('25px')
			->bottom( '50px' )
			->left( '5rem' );

		$this->assertEquals(
			[
				'top'		=> '25px',
				'right'		=> '25px',
				'bottom'	=> '50px',
				'left'		=> '5rem',
			],
			$sut->toArray()
		);
	}

	/**
	 * @test
	 */
	public function itShouldBeImmutable() {

		$sut = $this->getInstance();
		$sut->top('25px')
			->left('25px');

		$this->expectException( \RuntimeException::class );
		$sut->top( '22' );
	}

	/**
	 * @test
	 */
	public function itShouldBeImmutableAlsoIfICloneIt() {

		$sut = $this->getInstance();
		$sut->top('25px')
			->left('25px');

		$sut_cloned = clone $sut;

		$this->assertNotEmpty( $sut->toArray(), '' );
		$this->assertEmpty( $sut_cloned->toArray(), '' );

		$sut_cloned->left('20px');
	}
}