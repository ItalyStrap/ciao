<?php
declare(strict_types=1);

namespace ItalyStrap\Tests;

use Codeception\Test\Unit;
use ItalyStrap\ExperimentalTheme\JsonData;

class JsonDataTest extends Unit {

	use BaseUnitTrait;

	/**
	 * @test
	 * @throws \Spatie\Color\Exceptions\InvalidColorValue
	 */
	public function itShouldReturnAnArray() {
		$data = JsonData::getJsonData();
		$this->assertIsArray( $data, '' );
	}

	protected function getInstance() {
		// TODO: Implement getInstance() method.
	}
}
