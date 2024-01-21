<?php

declare(strict_types=1);

namespace ItalyStrap\ExperimentalTheme\Asset\Application\Root;

use ItalyStrap\ExperimentalTheme\JsonData;
use ItalyStrap\ThemeJsonGenerator\Application\Config\Blueprint;
use ItalyStrap\ThemeJsonGenerator\Domain\Input\Styles\Color;
use ItalyStrap\ThemeJsonGenerator\Domain\Input\Styles\Spacing;
use ItalyStrap\ThemeJsonGenerator\Domain\Input\Styles\Typography;

class Navigation
{
    private Color $color;
    private Typography $typography;
    private Spacing $spacing;

    public function __construct(
        Color $color,
        Typography $typography,
        Spacing $spacing
    ) {
        $this->color = $color;
        $this->typography = $typography;
        $this->spacing = $spacing;
    }

    public function __invoke(Blueprint $blueprint)
    {

        $blueprint->setBlockSettings('core/navigation', [
            'color' => [
                'custom' => false,
            ],
        ]);

        /**
         * .wp-block-navigation
         */
        $blueprint->setBlockStyle('core/navigation', [
            'color' => $this->color
                ->text(JsonData::COLOR_BODY_COLOR)
                ->background(JsonData::COLOR_BODY_BG),
            'spacing' => [
                'padding' => $this->spacing->vertical('1.1rem'),
            ],
            'typography' => $this->typography
                ->fontSize(JsonData::FONT_SIZE_X_SMALL)
                ->fontWeight('400')
                ->textTransform('uppercase'),
        ]);
    }
}
