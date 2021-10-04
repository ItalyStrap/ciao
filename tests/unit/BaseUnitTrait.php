<?php
declare(strict_types=1);

namespace ItalyStrap\Tests;

trait BaseUnitTrait {

	/**
	 * @var \UnitTester
	 */
	protected $tester;

	protected function _before()
	{
	}

	protected function _after()
	{
	}

	abstract protected function getInstance();

	/**
	 * @test
	 */
	public function itShouldBeInstantiable() {
		$this->getInstance();
	}
}