<?php // phpcs:ignoreFile
declare(strict_types=1);

namespace ItalyStrap\Ciao;

use Auryn\InjectorException;
use ItalyStrap\Config\Config;
use ItalyStrap\Event\EventDispatcher;
use ItalyStrap\Finder\Finder;
use ItalyStrap\Finder\FinderFactory;
use ItalyStrap\View\View;
use RuntimeException;
use Throwable;
use function get_stylesheet_directory;
use function get_template_directory;
use function ItalyStrap\Factory\injector;

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

	if ( ! \ItalyStrap\Core\is_debug() ) {

		/**
		 * Only load styles for used blocks
		 * @link https://make.wordpress.org/core/2021/07/01/block-styles-loading-enhancements-in-wordpress-5-8/
		 */
		$event_dispatcher->addListener( 'should_load_separate_core_block_assets', '__return_true' );
	}



	$event_dispatcher->addListener( 'after_setup_theme', function () use ( $event_dispatcher, $injector ) {

//		remove_theme_support('wp-block-styles' );
//		remove_theme_support('editor-styles' );

		$finder = ( new FinderFactory() )->make();
		$finder->in( get_stylesheet_directory() . '/config/block_pattern' );

		/** @var View $view */
		$view = new View( $finder );

		/**
		 *
		 * @param string $pattern_name       Pattern name including namespace.
		 * @param array  $pattern_properties Array containing the properties of the pattern: title,
		 *                                   content, description, viewportWidth, categories, keywords.
		 */
		\register_block_pattern(
			'ciao/loop',
			[
				'title'	=> 'Loop for Ciao theme',
				'description'	=> 'A loop with left image and right excerpt',
				'viewportWidth'	=> '1000',
				'categories' => ['query'],
				'keywords' => '',
				'content'	=> $view->render( 'loop' ),
			]
		);

		register_block_style(
			'core/query',
			[
				'name'  => 'even-odd',
				'label' => __( 'Even odd effect', 'ciao' ),
			]
		);

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

		/**
		 * Just to remember this filter
		 * @link https://developer.wordpress.org/reference/hooks/render_block/
		 */
//		$event_dispatcher->addListener( 'render_block', function ( string $block_content, array $block ) {
//			if ( $block['blockName'] !== 'core/template-part' ) {
//				return $block_content;
//			}
//
//			d($block_content, $block);
//
//			return $block_content;
//		}, 10, 2 );

		/** @var Config $theme_json */
//		$theme_json = new \ItalyStrap\Config\Config( WP_Theme_JSON_Resolver::get_theme_data()->get_raw_data() );
//		$theme_json = new \ItalyStrap\Config\Config( \WP_Theme_JSON_Resolver::get_theme_data()->get_raw_data() );

//		d(\WP_Theme_JSON_Resolver::get_core_data());
//		d(\WP_Theme_JSON_Resolver::get_theme_data());
//		d(\WP_Theme_JSON_Resolver::get_merged_data());
//		d(\WP_Theme_JSON_Resolver::get_merged_data()->get_raw_data());
//		d(\WP_Theme_JSON_Resolver::get_merged_data()->get_stylesheet());
//		d(\WP_Theme_JSON_Resolver::get_merged_data()->get_settings());
	}, PHP_INT_MAX );

	// yes, I know this is very bad but for now this is for experimental purpose.
} catch ( InjectorException $exception ) {
	throw new RuntimeException($exception->getMessage());
} catch ( Throwable $exception ) {
	throw new RuntimeException($exception->getMessage());
}
