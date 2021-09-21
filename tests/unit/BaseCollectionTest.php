<?php
declare(strict_types=1);

namespace ItalyStrap\Tests;

use Codeception\Test\Unit;
use ItalyStrap\ExperimentalTheme\CollectionInterface;

abstract class BaseCollectionTest extends Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

	/**
	 * @var \string[][]
	 */
	protected $collection;

	/**
	 * @var string
	 */
	protected $category;

	/**
	 * @var string
	 */
	protected $key = '';
    
    protected function _before()
    {
    }

    protected function _after()
    {
    }

	abstract protected function getInstance(): CollectionInterface;

	abstract public function valueProvider();

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
}