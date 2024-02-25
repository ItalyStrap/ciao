<?php

declare(strict_types=1);

namespace ItalyStrap\ExperimentalTheme\Asset\Application\Root;

use ItalyStrap\ExperimentalTheme\JsonData;
use ItalyStrap\ThemeJsonGenerator\Application\Config\Blueprint;
use ItalyStrap\ThemeJsonGenerator\Domain\Input\Styles\Color;
use ItalyStrap\ThemeJsonGenerator\Domain\Input\Styles\Typography;

class Title
{
    private Color $color;
    private Typography $typography;

    public function __construct(
        Color $color,
        Typography $typography
    ) {
        $this->color = $color;
        $this->typography = $typography;
    }

    public function __invoke(Blueprint $blueprint): void
    {

        $blueprint->setBlockStyle('core/site-title', [
            'color' => $this->color
                ->text(JsonData::COLOR_HEADING_TEXT),
            'typography' => $this->typography
                ->fontSize(JsonData::FONT_SIZE_H1)
                ->fontWeight('600'),
        ]);

        $blueprint->setBlockStyle('core/post-title', [ // .wp-block-post-title
            'color' => $this->color
                ->text(JsonData::COLOR_HEADING_TEXT),
            'typography' => $this->typography
                ->fontSize(JsonData::FONT_SIZE_H1),
            'elements' => [
                'link' => [ // .wp-block-post-title a
                    'color' => $this->color
                        ->text('inherit')
                        ->background('transparent'),
                ],
            ],
        ]);

        /**
         * Title for queried object {Author page}
         * <!-- wp:query-title {"type":"author"} /-->
         * .wp-block-query-title
         */
        $blueprint->setBlockStyle('core/query-title', [
            'color' => $this->color
                ->text(JsonData::COLOR_GRAY_400),
            'typography' => $this->typography
                ->fontSize(JsonData::FONT_SIZE_H5)
                ->fontWeight('700'),
        ]);
    }
}
