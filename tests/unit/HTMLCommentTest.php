<?php

declare(strict_types=1);

namespace ItalyStrap\Tests;

use ItalyStrap\Config\Config;
use tad\FunctionMocker\FunctionMocker;

class HTMLCommentTest extends \Codeception\Test\Unit
{
    use BaseUnitTrait;

    private function SomeFeature()
    {

//      \tad\FunctionMockerLe\define('esc_html', fn( string $tag ) => $tag );

		// phpcs:ignore
		\tad\FunctionMockerLe\define('esc_html', static function ( string $tag ): string {
            return $tag;
        });

		// phpcs:ignore
		\tad\FunctionMockerLe\define('esc_attr', static function ( string $tag ): string {
            return $tag;
        });

		// phpcs:ignore
		\tad\FunctionMockerLe\define('apply_filters', static function ( ...$params ) {
            return $params[1];
        });

        /**
         * <!-- wp:spacer -->
         * <div style="height:100px" aria-hidden="true" class="wp-block-spacer"></div>
         * <!-- /wp:spacer -->
         */

//      $block_name = 'spacer';
        $block_name = 'paragraph';

        $result = $this->createBlockByName('spacer', [
            'style' => 'height:100px',
            'aria-hidden' => "true",
        ]);

//      codecept_debug( $result );

        $path = codecept_absolute_path('');

        $block_json = dirname($path, 3) . '/wp-includes/blocks/' . $block_name . '/block.json';

        if (! \is_readable($block_json)) {
            throw new \RuntimeException("File {$block_json} does not exists");
        }

//      codecept_debug( $block_json );

        $json_content = \json_decode(\file_get_contents($block_json));

//      codecept_debug( $json_content );

        $json_config = new Config($json_content);

//      codecept_debug( $json_config->get( 'attributes' )->height );
//      codecept_debug( $json_config->get( 'attributes.height.default' ) );
//      codecept_debug( $json_config->get( 'attributes.content.selector' ) );
    }

    /**
     * @param \ItalyStrap\HTML\Tag $tag
     * @return string
     */
    private function createBlockByName(string $block_name, array $attr = []): string
    {

        $tags_used_in_blocks = [
            'spacer'    => 'div',
        ];

        $allowed_attributes_in_comment = [
            'spacer'    => false,
        ];

        $default_attr = [
            'class' => 'wp-block-' . $block_name,
        ];

        $comment_attr = [];
        if ($allowed_attributes_in_comment[ $block_name ]) {
            $comment_attr = $attr;
        }

        $tag = new \ItalyStrap\HTML\Tag(new \ItalyStrap\HTML\Attributes());
        $comment_open = $this->coreCommentOpen("wp:{$block_name}", $block_name, $comment_attr);

        $open = $tag->open(
            "wp:{$block_name}",
            $tags_used_in_blocks[ $block_name ],
            \array_merge_recursive($default_attr, $attr),
        );

        $close = $tag->close("wp:{$block_name}");

        $comment_close = $this->coreCommentClose("wp:{$block_name}", $block_name);


        $result = \sprintf(
            '%s%s%s%s',
            $comment_open . PHP_EOL,
            $open,
            $close . PHP_EOL,
            $comment_close . PHP_EOL
        );
        return $result;
    }

    private function coreCommentOpen(string $context, string $block_name, array $attr = []): string
    {
        return \sprintf(
            '<!-- wp:%s%s-->',
            $block_name,
            empty($attr) ? ' ' : ' ' . \json_encode($attr) . ' '
        );
    }

    private function coreCommentClose(string $context, string $block_name): string
    {
        return \sprintf(
            '<!-- /wp:%s -->',
            $block_name
        );
    }

    /**
     * @test
     */
    public function itShouldCloseCommentBasicFormatOk()
    {
        $comment_open = $this->coreCommentClose('wp:spacer', 'spacer');

        $this->assertStringMatchesFormat(
            '<!-- /wp:spacer -->',
            $comment_open,
            ''
        );
    }

    /**
     * @test
     */
    public function itShouldOpenCommentBasicFormatOk()
    {
        $comment_open = $this->coreCommentOpen('wp:spacer', 'spacer');

        $this->assertStringMatchesFormat(
            '<!-- wp:spacer -->',
            $comment_open,
            ''
        );
    }

    /**
     * @test
     */
    public function itShouldOpenCommentBasicFormatOkWithAttr()
    {
        $comment_open = $this->coreCommentOpen('wp:spacer', 'spacer', [
            'height'    => 1,
            'className' => 'is-style-spacer-v-l',
        ]);

        $this->assertStringMatchesFormat(
            '<!-- wp:spacer {"height":1,"className":"is-style-spacer-v-l"} -->',
            $comment_open,
            ''
        );
    }

    protected function getInstance()
    {
    }
}
