<?php
declare(strict_types=1);

namespace ItalyStrap\Tests;

use Codeception\Test\Unit;
use ItalyStrap\ExperimentalTheme\JsonData;

class JsonDataTest extends Unit {

	use BaseUnitTrait;

	/**
	 * @test
	 */
	public function itShouldReturnAnArray() {
		$data = JsonData::getJsonData();
		$this->assertIsArray( $data, '' );
	}

	protected function getInstance() {
		// TODO: Implement getInstance() method.
	}

	public function DirContentList() {

		$root_dir = codecept_root_dir('');

		$blocks = dirname( dirname( $root_dir ) ) . '/plugins/gutenberg/build/block-library/blocks/';

		$dirs = \array_filter( glob( $blocks . '*' ), 'is_dir' );

		foreach ( $dirs as $dir ) {
			$block_json = $dir . '/block.json';
			if ( ! \is_readable( $dir . '/block.json' ) ) {
				continue;
			}
			$file = \json_decode( \file_get_contents( $block_json ) );
			codecept_debug( $file->name );

			codecept_debug( codecept_data_dir('') );

			$return = \file_put_contents( codecept_data_dir() . '/ciao.php', 'ciao' );
			codecept_debug( $return );
		}
	}
}
