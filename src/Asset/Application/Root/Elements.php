<?php

declare(strict_types=1);

namespace ItalyStrap\ExperimentalTheme\Asset\Application\Root;

use ItalyStrap\ExperimentalTheme\JsonData;
use ItalyStrap\ThemeJsonGenerator\Application\Config\Blueprint;
use ItalyStrap\ThemeJsonGenerator\Domain\Input\Styles\Border;
use ItalyStrap\ThemeJsonGenerator\Domain\Input\Styles\Color;
use ItalyStrap\ThemeJsonGenerator\Domain\Input\Styles\Spacing;
use ItalyStrap\ThemeJsonGenerator\Domain\Input\Styles\Typography;

class Elements
{
    private Color $color;
    private Typography $typography;
    private Border $border;
    private Spacing $spacing;

    public function __construct(
        Color $color,
        Typography $typography,
        Border $border,
        Spacing $spacing
    ) {
        $this->color = $color;
        $this->typography = $typography;
        $this->border = $border;
        $this->spacing = $spacing;
    }

    public function __invoke(Blueprint $blueprint)
    {
        $blueprint->setElementStyle('link', [
            'color' => $this->color
                ->text(JsonData::COLOR_LINK_TEXT)
                ->background('transparent'),
        ]);

        $blueprint->setBlockStyle('core/paragraph', [
            'spacing'   => [
                'margin'    => $this->spacing
                    ->top(JsonData::SPACER_M)
                    ->bottom('0px'),
            ],
        ]);

//        $blueprint->setBlockStyle('core/list', [
//            'spacing'   => [
//                'margin'    => $this->spacing
//                    ->top(JsonData::SPACER_M)
//                    ->bottom('0px'),
//            ],
//        ]);

        /**
         * .wp-block-file
         */
        $blueprint->setBlockStyle('core/file', [
            'spacing'   => [
                'margin'    => $this->spacing
                    ->top(JsonData::SPACER_M),
            ],
            'typography' => $this->typography
                ->fontFamily(JsonData::FONT_FAMILY_BASE)
                ->fontSize(JsonData::FONT_SIZE_BASE)
                ->lineHeight(JsonData::LINE_HEIGHT_S),
            'elements' => [
                'link' => [ // .wp-block-file a
                    'color' => $this->color
                        ->text(JsonData::COLOR_BASE)
                        ->background('transparent'),
                ],
            ],
        ]);

        /**
         * .wp-block-code
         */
        $blueprint->setBlockStyle('core/code', [
            'typography' => $this->typography
                ->fontFamily(JsonData::FONT_FAMILY_MONOSPACE),
            'spacing' => [
                'margin'    => $this->spacing
                    ->top(JsonData::SPACER_L),
                'padding' => $this->spacing
                    ->shorthand([JsonData::SPACER_V, JsonData::SPACER_H]),
            ],
            'border' => $this->border
                ->color(JsonData::COLOR_BORDER)
                ->radius('0px')
                ->style('solid')
                ->width('1px'),
        ]);

        /**
         * .wp-block-quote
         */
        $blueprint->setBlockStyle('core/quote', [
            'border' => $this->border
                ->color(JsonData::COLOR_BODY_COLOR)
                ->style('solid')
                ->width('0 0 0 1px'),
            'spacing' => [
                'margin'    => $this->spacing
                    ->top(JsonData::SPACER_L),
                'padding'   => $this->spacing
                    ->top(JsonData::SPACER_H),
            ],
            'typography' => $this->typography
                ->fontSize(JsonData::FONT_SIZE_BASE)
                ->fontStyle('normal'),
        ]);
    }
}
