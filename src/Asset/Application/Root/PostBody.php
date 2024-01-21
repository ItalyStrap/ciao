<?php

declare(strict_types=1);

namespace ItalyStrap\ExperimentalTheme\Asset\Application\Root;

use ItalyStrap\ThemeJsonGenerator\Application\Config\Blueprint;
use ItalyStrap\ThemeJsonGenerator\Domain\Input\Styles\Color;

class PostBody
{
    private Color $color;

    public function __construct(
        Color $color
    ) {
        $this->color = $color;
    }

    public function __invoke(Blueprint $blueprint)
    {
        /**
         * .wp-block-post-content
         */
        $blueprint->setBlockStyle('core/post-content', [
            'color' => $this->color
                ->text('inherit'),
        ]);

        /**
         * .wp-block-post-excerpt
         */
        $blueprint->setBlockStyle('core/post-excerpt', [
            'color' => $this->color
                ->text('inherit'),
        ]);
    }
}