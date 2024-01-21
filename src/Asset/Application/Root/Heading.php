<?php

declare(strict_types=1);

namespace ItalyStrap\ExperimentalTheme\Asset\Application\Root;

use ItalyStrap\ExperimentalTheme\JsonData;
use ItalyStrap\ThemeJsonGenerator\Application\Config\Blueprint;
use ItalyStrap\ThemeJsonGenerator\Domain\Input\Styles\Color;
use ItalyStrap\ThemeJsonGenerator\Domain\Input\Styles\Spacing;
use ItalyStrap\ThemeJsonGenerator\Domain\Input\Styles\Typography;

class Heading
{
    private Color $color;
    private Typography $typography;
    private Spacing $spacing;

    public function __construct(
        Color $color,
        Spacing $spacing,
        Typography $typography
    ) {
        $this->color = $color;
        $this->typography = $typography;
        $this->spacing = $spacing;
    }

    public function __invoke(Blueprint $blueprint): void
    {

        $blueprint->setElementStyle('h1', [
            'typography' => $this->typography
                ->fontSize(JsonData::FONT_SIZE_H1),
        ]);

        $blueprint->setElementStyle('h2', [
            'typography' =>  $this->typography
                ->fontSize(JsonData::FONT_SIZE_H2),
        ]);

        $blueprint->setElementStyle('h3', [
            'typography' => $this->typography
                ->fontSize(JsonData::FONT_SIZE_H3),
        ]);

        $blueprint->setElementStyle('h4', [
            'typography' => $this->typography
                ->fontSize(JsonData::FONT_SIZE_H4),
        ]);

        $blueprint->setElementStyle('h5', [
            'typography' => $this->typography
                ->fontSize(JsonData::FONT_SIZE_H5),
        ]);

        $blueprint->setElementStyle('h6', [
            'typography' => $this->typography
                ->fontSize(JsonData::FONT_SIZE_H6),
        ]);

        $blueprint->setElementStyle('heading', [
            'typography' => $this->typography
                ->fontFamily(JsonData::FONT_FAMILY_BASE)
                ->fontWeight('700')
                ->lineHeight(JsonData::LINE_HEIGHT_XS),
            'spacing'   => [
                'margin'    => $this->spacing
                    ->top(JsonData::SPACER_S)
                    ->bottom('0'),
            ],
            'color' => $this->color
                ->text(JsonData::COLOR_HEADING_TEXT),
        ]);
    }
}
