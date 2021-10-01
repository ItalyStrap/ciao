<?php
declare(strict_types=1);

namespace ItalyStrap\Tests;

use Codeception\Test\Unit;
use ItalyStrap\ExperimentalTheme\Spacing;
use UnitTester;

class SpacingTest extends Unit
{

    /**
     * @var UnitTester
     */
    protected $tester;
    
    protected function _before()
    {
    }

    protected function _after()
    {
    }

	protected function getInstance() {
		$sut = new Spacing();
		$this->assertInstanceOf( Spacing::class, $sut, '' );
		return $sut;
	}

	/**
	 * @test
	 */
	public function itShouldBeInstantiable() {
		$this->getInstance();
	}

	public function spacingProvider() {
		yield 'Top'	=> [
			[
				'25'
			],
			''
		];
	}

	/**
	 * @dataProvider spacingProvider
	 * @test
	 */
	public function itShouldReturn( $value, $message ) {

		$sut = $this->getInstance();
		$sut
			->top('25px')
			->left('25px')
		;

//		call_user_func( [ $sut, 'top' ], '' );
	}

	/**
	 * @test
	 */
	public function itShouldReturnTheCorrectValue() {

		$sut = $this->getInstance();
		$sut
			->top('25px')
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
		$sut
			->top('25px')
			->left('25px')
		;

		$this->expectException( \RuntimeException::class );
		$sut->top( '22' );
	}
}