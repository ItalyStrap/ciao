<?php

declare(strict_types=1);

namespace ItalyStrap\ExperimentalTheme\Asset\Application\Root\Collection;

use ItalyStrap\ExperimentalTheme\JsonData;
use ItalyStrap\ThemeJsonGenerator\Application\Config\Blueprint;
use ItalyStrap\ThemeJsonGenerator\Domain\Input\Settings\PresetsInterface;
use ItalyStrap\ThemeJsonGenerator\Domain\Input\Settings\Color\Utilities\LinearGradient;

class Gradient
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
            ->add(new \ItalyStrap\ThemeJsonGenerator\Domain\Input\Settings\Color\Gradient(
                'light-to-dark',
                'Black to white',
                new LinearGradient(
                    '160deg',
                    $this->collection->get(JsonData::COLOR_LIGHT),
                    $this->collection->get(JsonData::COLOR_DARK)
                )
            ))
            ->add(new \ItalyStrap\ThemeJsonGenerator\Domain\Input\Settings\Color\Gradient(
                'base-to-white',
                'Base to white',
                new LinearGradient(
                    '135deg',
                    $this->collection->get(JsonData::COLOR_BASE),
                    $this->collection->get(JsonData::COLOR_BASE_DARK)
                )
            ));
    }
}
