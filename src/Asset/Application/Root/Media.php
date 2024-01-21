<?php

declare(strict_types=1);

namespace ItalyStrap\ExperimentalTheme\Asset\Application\Root;

use ItalyStrap\ExperimentalTheme\JsonData;
use ItalyStrap\ThemeJsonGenerator\Application\Config\Blueprint;
use ItalyStrap\ThemeJsonGenerator\Domain\Input\Styles\Spacing;

class Media
{
    private Spacing $spacing;

    public function __construct(
        Spacing $spacing
    ) {
        $this->spacing = $spacing;
    }

    public function __invoke(Blueprint $blueprint)
    {
        /**
         * .wp-block-site-logo {figure element}
         */
        $blueprint->setBlockStyle('core/site-logo', [
            'spacing' => [
                'margin' => $this->spacing->shorthand(['0px']),
                'padding' => $this->spacing->shorthand(['0px']),
            ],
        ]);

        /**
         * .wp-block-image {figure element}
         */
        $blueprint->setBlockStyle('core/image', [
            'spacing' => [
                'margin' => $this->spacing
                    ->top(JsonData::SPACER_M)
                    ->bottom('0px'),
            ],
        ]);

        /**
         * .wp-block-post-featured-image {figure element}
         */
        $blueprint->setBlockStyle('core/post-featured-image', [
            'spacing' => [
                'margin' => $this->spacing
                    ->top(JsonData::SPACER_M)
                    ->bottom('0px'),
            ],
        ]);

        /**
         * .wp-block-gallery {figure element}
         */
        $blueprint->setBlockStyle('core/gallery', [
            'spacing' => [
                'margin' => $this->spacing
                    ->top(JsonData::SPACER_M)
                    ->bottom('0px'),
            ],
        ]);
    }
}
