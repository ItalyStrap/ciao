<?php // phpcs:ignoreFile
declare(strict_types=1);

namespace ItalyStrap\ExperimentalTheme;

use Auryn\InjectorException;
use ItalyStrap\Config\Config;
use ItalyStrap\Event\EventDispatcher;
use ItalyStrap\Theme\SupportSubscriber;
use RuntimeException;
use Throwable;
use function get_stylesheet_directory;
use function get_template_directory;
use function ItalyStrap\Factory\injector;
use function remove_theme_support;

require get_stylesheet_directory() . '/vendor/autoload.php';
require_once get_template_directory() . '/src/bootstrap.php';

try {
	$injector = injector();

	/** @var EventDispatcher $event_dispatcher */
	$event_dispatcher = $injector->make( EventDispatcher::class );

//	$event_dispatcher->addListener(
//		'wp_enqueue_scripts',
//		function () {
//			wp_dequeue_style( 'wp-block-library' );
//		}
//	);

	/**
	 * Only load styles for used blocks
	 * @link https://make.wordpress.org/core/2021/07/01/block-styles-loading-enhancements-in-wordpress-5-8/
	 */
//	$event_dispatcher->addListener( 'should_load_separate_core_block_assets', '__return_true' );

	$event_dispatcher->addListener( 'after_setup_theme', function () {

//		remove_theme_support('wp-block-styles' );
//		remove_theme_support('editor-styles' );

		register_block_style(
			'core/group',
			[
				'name'  => 'hero-xl',
				'label' => __( 'Spacer Vertical XL', 'ciao' ),
				'inline_style' => '.is-style-hero-xl {padding: var(--wp--custom--spacer--xl) 0;}',
			]
		);

		register_block_style(
			'core/group',
			[
				'name'  => 'hero-l',
				'label' => __( 'Spacer Vertical L', 'ciao' ),
				'inline_style' => '.is-style-hero-l {padding: var(--wp--custom--spacer--l) 0;}',
			]
		);

		register_block_style(
			'core/spacer',
			[
				'name'  => 'spacer-v-l',
				'label' => __( 'Spacer Vertical Large', 'ciao' ),
				'inline_style' =>
					'.is-style-spacer-v-l {
	padding: var(--wp--custom--spacer--l) 0;
}',
			]
		);

		register_block_style(
			'core/button',
			[
				'name'  => 'fill-shadow',
				'label' => __( 'Fill shadow', 'ciao' ),
			]
		);

		register_block_style(
			'core/navigation',
			[
				'name'  => 'fixed-top',
				'label' => __( 'Fixed Top', 'ciao' ),
//				'inline_style' =>
//					'.is-style-fixed-top {
//  --site-blocks-mt: var(--wp--custom--navbar--height--min);
//  position: fixed;
//  top: 0;
//  right: 0;
//  left: 0;
//  z-index: 1030;
//  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
//}.wp-site-blocks{margin-top:var(--site-blocks-mt, 0)}',
			]
		);

		register_block_style(
			'core/column',
			[
				'name'         => 'column-border',
				'label'        => __( 'Inner borders', 'ciao' ),
				'inline_style' =>
					'.is-style-column-border {
	border: 1px solid currentColor;
	padding: 1.25em 2.375em;
}',
			]
		);

		/** @var Config $theme_json */
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
	throw new RuntimeException($exception->getMessage());
} catch ( Throwable $exception ) {
	throw new RuntimeException($exception->getMessage());
}
