<?php

declare(strict_types=1);

namespace ItalyStrap\ExperimentalTheme\Asset\Application\Root\Collection;

use ItalyStrap\ThemeJsonGenerator\Application\Config\Blueprint;
use ItalyStrap\ThemeJsonGenerator\Domain\Input\Settings\PresetsInterface;
use ItalyStrap\ThemeJsonGenerator\Domain\Input\Settings\Typography\FontSize;

class FontSizes
{
    private PresetsInterface $collection;

    public function __construct(
        PresetsInterface $collection
    ) {
        $this->collection = $collection;
    }

    public function __invoke(Blueprint $blueprint): void
    {
        $this->collection
            ->add(new FontSize('base', 'Base font size 16px', 'clamp(1rem, 2vw, 1.5rem)'))
            ->add(new FontSize('h1', 'Used in H1 titles', 'calc( {{fontSize.base}} * 2.8125)'))
            ->add(new FontSize('h2', 'Used in H2 titles', 'calc( {{fontSize.base}} * 2.1875)'))
            ->add(new FontSize('h3', 'Used in H3 titles', 'calc( {{fontSize.base}} * 1.625)'))
            ->add(new FontSize('h4', 'Used in H4 titles', 'calc( {{fontSize.base}} * 1.5)'))
            ->add(new FontSize('h5', 'Used in H5 titles', 'calc( {{fontSize.base}} * 1.125)'))
            ->add(new FontSize('h6', 'Used in H6 titles', '{{fontSize.base}}'))
            ->add(new FontSize('small', 'Small font size', 'calc( {{fontSize.base}} * 0.875)'))
            ->add(new FontSize('x-small', 'Extra Small font size', 'calc( {{fontSize.base}} * 0.75)'));
    }
}
