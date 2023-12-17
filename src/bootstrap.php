<?php // phpcs:ignoreFile

declare(strict_types=1);

namespace ItalyStrap\Ciao;

use Auryn\Injector;
use Auryn\InjectorException;
use ItalyStrap\Config\Config;
use ItalyStrap\Event\GlobalDispatcherInterface;
use ItalyStrap\Event\GlobalOrderedListenerProvider;
use ItalyStrap\Finder\FinderFactory;
use ItalyStrap\View\View;
use RuntimeException;
use Throwable;

use function get_stylesheet_directory;
use function get_template_directory;

require get_stylesheet_directory() . '/vendor/autoload.php';

(static function(Injector $injector) {

//    \add_filter(
//        'after_setup_theme',
//        function () use ($injector) {
//            \var_dump($injector->inspect());
//            die();
//        },
//        999
//    );

    try {

        /** @var GlobalOrderedListenerProvider $listenerRegister */
        $listenerRegister = $injector->make(GlobalOrderedListenerProvider::class);

//	$listenerRegister->addListener(
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
            $listenerRegister->addListener( 'should_load_separate_core_block_assets', '__return_true' );
        }



        $listenerRegister->addListener( 'after_setup_theme', function () use ( $listenerRegister, $injector ) {
//
//            $support = new \ItalyStrap\Theme\Support();
//		$support->remove('wp-block-styles');
//		$support->remove('editor-styles');

            $finder = ( new FinderFactory() )->make();
            $finder->in( get_stylesheet_directory() . '/config/block_pattern/views' );
            $view = new View( $finder );

            /**
             * https://developer.wordpress.org/block-editor/reference-guides/block-api/block-patterns/
             * @link https://developer.wordpress.org/themes/block-themes/converting-customizer-settings-to-block-patterns/
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
                    'viewportWidth'	=> '1200',
                    'categories' => ['query'],
                    'keywords' => '',
                    'content'	=> $view->render( 'loop' ),
                ]
            );

            \register_block_pattern(
                'ciao/paragraph',
                [
                    'title'	=> 'A fake paragraph',
                    'description'	=> 'A fake paragraph for testing',
                    'viewportWidth'	=> '1200',
                    'categories' => ['text'],
                    'keywords' => '',
                    'content'	=> $view->render(
                        'paragraph', [ 'content' => \rtrim( \str_repeat( 'Lorem Ipsum Dolor ', 10 ) ) ]
                    ),
                ]
            );

            register_block_style(
                'core/list',
                [
                    'name'  => 'list-group',
                    'label' => __( 'list-group effect', 'ciao' ),
                ]
            );

            register_block_style(
                'overblocks/container',
                [
                    'name'  => 'card',
                    'label' => __( 'Card effect', 'ciao' ),
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
//		$listenerRegister->addListener( 'render_block', function ( string $block_content, array $block ) {
//			if ( $block['blockName'] !== 'core/template-part' ) {
//				return $block_content;
//			}
//
//			d($block_content, $block);
//
//			return $block_content;
//		}, 110, 2 );
//
//		$listenerRegister->addListener( 'render_block_core/template-part', function ( string $block_content, array $block ) {
//
//			d($block_content, $block);
//
//			return $block_content;
//		}, 110, 2 );

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
})(require get_template_directory() . '/src/bootstrap.php');

