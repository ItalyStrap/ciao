<?php

declare(strict_types=1);

namespace ItalyStrap\ExperimentalTheme\Asset\Application\Root;

use ItalyStrap\ThemeJsonGenerator\Application\Config\Blueprint;
use ItalyStrap\ThemeJsonGenerator\Domain\Input\Styles\Spacing;

class Containers
{
    private Spacing $spacing;

    public function __construct(
        Spacing $spacing
    ) {
        $this->spacing = $spacing;
    }

    public function __invoke(Blueprint $blueprint)
    {
//        $blueprint->setBlockStyle('overblocks/container', [
//            'spacing'   => [
//                'margin'    => $this->spacing->shorthand(['0']),
//            ],
//        ]);

        $blueprint->setBlockStyle('core/group', [
            'spacing'   => [
                'margin'    => $this->spacing->shorthand(['0 !important']),
            ],
        ]);

//        $blueprint->setBlockStyle('core/column', [
//            'spacing'   => [
//                'margin'    => $this->spacing->shorthand(['0']),
//            ],
//        ]);

        $blueprint->setBlockStyle('core/template-part', [
            'spacing'   => [
                'margin'    => $this->spacing->shorthand(['0 !important']),
                'padding'   => $this->spacing->shorthand(['0 !important']),
            ],
        ]);
    }
}
