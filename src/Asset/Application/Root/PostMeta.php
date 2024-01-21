<?php

declare(strict_types=1);

namespace ItalyStrap\ExperimentalTheme\Asset\Application\Root;

use ItalyStrap\ExperimentalTheme\JsonData;
use ItalyStrap\ThemeJsonGenerator\Application\Config\Blueprint;
use ItalyStrap\ThemeJsonGenerator\Domain\Input\Styles\Border;
use ItalyStrap\ThemeJsonGenerator\Domain\Input\Styles\Color;
use ItalyStrap\ThemeJsonGenerator\Domain\Input\Styles\Spacing;
use ItalyStrap\ThemeJsonGenerator\Domain\Input\Styles\Typography;

class PostMeta
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
        $blueprint->setBlockStyle('core/post-date', [
            'color' => $this->color
                ->text(JsonData::COLOR_GRAY_200),
            'typography' => $this->typography
                ->fontSize(JsonData::FONT_SIZE_X_SMALL),
        ]);

        $blueprint->setBlockStyle('core/post-terms', [
            'color' => $this->color
                ->text(JsonData::COLOR_GRAY_200),
            'typography' => $this->typography
                ->fontSize(JsonData::FONT_SIZE_X_SMALL),
            'elements' => [
                'link' => [ // .wp-block-file a
                    'color' => $this->color
                        ->text(JsonData::COLOR_GRAY_200)
                        ->background('transparent'),
                    'typography' => $this->typography
                        ->textDecoration('none'),
                ],
            ],
        ]);

        $blueprint->setBlockStyle('core/post-author', [
            'border' => $this->border
                ->color(JsonData::COLOR_GRAY_700)
                ->style('solid')
                ->width('1px'),
            'color' => $this->color
                ->text(JsonData::COLOR_BODY_COLOR)
                ->background(JsonData::COLOR_GRAY_900),
            'typography' => $this->typography
                ->fontSize(JsonData::FONT_SIZE_SMALL),
            'spacing'   => [
//                          'margin'    => $this->spacing
//                                ->top(self::SPACER_M)
                'padding'   => $this->spacing
                    ->shorthand([JsonData::SPACER_M]),
            ],
        ]);
    }
}
