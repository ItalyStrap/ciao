<?php

declare(strict_types=1);

namespace ItalyStrap\ExperimentalTheme\Asset\Application\Root;

use ItalyStrap\ExperimentalTheme\JsonData;
use ItalyStrap\ThemeJsonGenerator\Application\Config\Blueprint;
use ItalyStrap\ThemeJsonGenerator\Domain\Input\Settings\PresetsInterface;
use ItalyStrap\ThemeJsonGenerator\Domain\Input\Styles\Border;
use ItalyStrap\ThemeJsonGenerator\Domain\Input\Styles\Color;
use ItalyStrap\ThemeJsonGenerator\Domain\Input\Styles\Spacing;
use ItalyStrap\ThemeJsonGenerator\Domain\Input\Styles\Typography;

class TermDescription
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
        /**
         * .wp-block-term-description
         */
        $blueprint->setBlockStyle('core/term-description', [
            'typography' => $this->typography
                ->fontSize(JsonData::FONT_SIZE_X_SMALL),
            'spacing'   => [
                'margin'    => $this->spacing->shorthand(['0px !important']),
            ],
            'color' => $this->color
                ->text(JsonData::COLOR_GRAY_400),
        ]);
    }
}
