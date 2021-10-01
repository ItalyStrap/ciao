<?php
declare(strict_types=1);

namespace ItalyStrap\ExperimentalTheme;

use Auryn\InjectorException;
use ItalyStrap\Event\EventDispatcher;
use Throwable;
use function get_template_directory;
use function ItalyStrap\Factory\injector;

require_once get_template_directory() . '/src/bootstrap.php';

function dm_remove_wp_block_library_css(){
	\wp_dequeue_style( 'wp-block-library' );
}

try {
	$injector = injector();

	/** @var EventDispatcher $event_dispatcher */
	$event_dispatcher = $injector->make( EventDispatcher::class );

//	$event_dispatcher->addListener(
//		'wp_enqueue_scripts',
//		__NAMESPACE__ . '\dm_remove_wp_block_library_css'
//	);

	$event_dispatcher->addListener( 'after_setup_theme', function () {

		\remove_theme_support('wp-block-styles' );
		\remove_theme_support('editor-styles' );

		register_block_style(
			'core/button',
			[
				'name'  => 'fill-shadow',
				'label' => __( 'Fill shadow', 'bdtr' ),
			]
		);

//		d( get_theme_support('align-wide') );

//	\add_theme_support( 'align-wide' );

//	add_theme_support(
//		'editor-color-palette',
//		[
//			[
//				'name'  => __( 'Primary', 'italystrap' ),
//				'slug'  => 'primary',
//				//				'color' => twentynineteen_hsl_hex( 'default' === get_theme_mod( 'primary_color' ) ? 199 : get_theme_mod( 'primary_color_hue', 199 ), 100, 33 ),
//				'color' => '#333',
//			],
//			[
//				'name'  => __( 'Success', 'italystrap' ),
//				'slug'  => 'success',
//				//				'color' => twentynineteen_hsl_hex( 'default' === get_theme_mod( 'primary_color' ) ? 199 : get_theme_mod( 'primary_color_hue', 199 ), 100, 23 ),
//				'color' => '#5cb85c',
//			]
//		]
//	);

		/** @var \ItalyStrap\Config\Config $theme_json */
//		$theme_json = new \ItalyStrap\Config\Config( WP_Theme_JSON_Resolver::get_theme_data()->get_raw_data() );
//		$theme_json = new \ItalyStrap\Config\Config( \WP_Theme_JSON_Resolver::get_theme_data()->get_raw_data() );

//		d(\WP_Theme_JSON_Resolver::get_core_data());
//		d(\WP_Theme_JSON_Resolver::get_theme_data());
//		d(\WP_Theme_JSON_Resolver::get_merged_data());
//		d(\WP_Theme_JSON_Resolver::get_merged_data()->get_raw_data());
//		d(\WP_Theme_JSON_Resolver::get_merged_data()->get_stylesheet());
//		d(\WP_Theme_JSON_Resolver::get_merged_data()->get_settings());


//		echo '<pre>';
//		var_dump( $theme_json->get('settings.defaults.color.palette') );
//		var_dump( $theme_json->get('styles.root.color') );
//		echo '</pre>';
//		echo '<pre>';
//		echo $theme_json->count();
//		foreach ( $theme_json as $key => $value ) {
//			var_dump( $key );
//			var_dump( $value );
//		}
//		echo '</pre>';

//		$instance = WP_Block_Type_Registry::get_instance();
//
//		\add_action('init', function () use ( $instance ) {
//			echo '<pre>';
//			var_dump($instance->get_all_registered());
//			echo '</pre>';
//			die();
//		}, 11);

	}, PHP_INT_MAX );

	// yes, I know this is very bad but for now this is for experimental purpose.
} catch ( InjectorException $exception ) {
	throw new \RuntimeException($exception->getMessage());
} catch ( Throwable $exception ) {
	throw new \RuntimeException($exception->getMessage());
}