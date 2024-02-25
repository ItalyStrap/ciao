<?php

declare(strict_types=1);

namespace ItalyStrap\ExperimentalTheme\Asset\Application\Root\Collection;

use ItalyStrap\ExperimentalTheme\JsonData;
use ItalyStrap\ThemeJsonGenerator\Application\Config\Blueprint;
use ItalyStrap\ThemeJsonGenerator\Domain\Input\Settings\PresetsInterface;
use ItalyStrap\ThemeJsonGenerator\Domain\Input\Settings\Color\Utilities\LinearGradient;

class Gradient
{
    private PresetsInterface $presets;

    public function __construct(
        PresetsInterface $presets
    ) {
        $this->presets = $presets;
    }

    public function __invoke(Blueprint $blueprint): void
    {
        $this->presets
            ->add(new \ItalyStrap\ThemeJsonGenerator\Domain\Input\Settings\Color\Gradient(
                'light-to-dark',
                'Black to white',
                new LinearGradient(
                    '160deg',
                    $this->presets->get(JsonData::COLOR_LIGHT),
                    $this->presets->get(JsonData::COLOR_DARK)
                )
            ))
            ->add(new \ItalyStrap\ThemeJsonGenerator\Domain\Input\Settings\Color\Gradient(
                'base-to-white',
                'Base to white',
                new LinearGradient(
                    '135deg',
                    $this->presets->get(JsonData::COLOR_BASE),
                    $this->presets->get(JsonData::COLOR_BASE_DARK)
                )
            ));
    }
}
