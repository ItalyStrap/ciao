<?php

declare(strict_types=1);

namespace ItalyStrap\ExperimentalTheme\Asset\Application\Root;

use ItalyStrap\ExperimentalTheme\JsonData;
use ItalyStrap\ThemeJsonGenerator\Application\Config\Blueprint;
use ItalyStrap\ThemeJsonGenerator\Domain\Input\Styles\Border;
use ItalyStrap\ThemeJsonGenerator\Domain\Input\Styles\Color;

class SpacerSeparator
{
    private Color $color;
    private Border $border;

    public function __construct(
        Color $color,
        Border $border
    ) {
        $this->color = $color;
        $this->border = $border;
    }

    public function __invoke(Blueprint $blueprint)
    {
        /**
         * <!-- wp:spacer -->
         * <div style="height:100px" aria-hidden="true" class="wp-block-spacer"></div>
         * <!-- /wp:spacer -->
         *
         * .wp-block-spacer
         */
        $blueprint->setBlockStyle('core/spacer', [
            'color' => $this->color
                ->text(JsonData::COLOR_BODY_COLOR),
            'border' => $this->border
                ->color('currentColor')
                ->style('solid')
                ->width('0 0 0 0'),
        ]);

        /**
         * <!-- wp:separator -->
         * <hr class="wp-block-separator"/>
         * <!-- /wp:separator -->
         *
         * .wp-block-separator
         */
        $blueprint->setBlockStyle('core/separator', [
//            'color' => $this->color
//                ->text(JsonData::COLOR_GRAY_700),
            'border' => $this->border
                ->color(JsonData::COLOR_GRAY_700)
                ->style('solid')
                ->width('0 0 1px 0'),
        ]);
    }
}
