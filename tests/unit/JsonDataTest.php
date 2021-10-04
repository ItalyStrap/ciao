<?php
declare(strict_types=1);

namespace ItalyStrap\Tests;

use Codeception\Test\Unit;
use ItalyStrap\ExperimentalTheme\JsonData;

class JsonDataTest extends Unit {

	/**
	 * @var \UnitTester
	 */
	protected $tester;
	
	protected function _before() {
	}

	protected function _after() {
	}

	/**
	 * @test
	 * @throws \Spatie\Color\Exceptions\InvalidColorValue
	 */
	public function itShouldReturnAnArray() {
		$data = JsonData::getJsonData();
		$this->assertIsArray( $data, '' );
	}
}
