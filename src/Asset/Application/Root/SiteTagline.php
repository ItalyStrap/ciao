<?php

declare(strict_types=1);

namespace ItalyStrap\ExperimentalTheme\Asset\Application\Root;

use ItalyStrap\ExperimentalTheme\JsonData;
use ItalyStrap\ThemeJsonGenerator\Application\Config\Blueprint;
use ItalyStrap\ThemeJsonGenerator\Domain\Input\Styles\Color;
use ItalyStrap\ThemeJsonGenerator\Domain\Input\Styles\Typography;

class SiteTagline
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

    public function __invoke(Blueprint $blueprint)
    {
        $blueprint->setBlockStyle('core/site-tagline', [
            'color' => $this->color
                ->text(JsonData::COLOR_BODY_COLOR),
            'typography' => $this->typography
                ->fontSize(JsonData::FONT_SIZE_H3)
                ->fontWeight('600'),
        ]);
    }
}