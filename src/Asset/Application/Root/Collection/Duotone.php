<?php

declare(strict_types=1);

namespace ItalyStrap\ExperimentalTheme\Asset\Application\Root\Collection;

use ItalyStrap\ExperimentalTheme\JsonData;
use ItalyStrap\ThemeJsonGenerator\Application\Config\Blueprint;
use ItalyStrap\ThemeJsonGenerator\Domain\Input\Settings\PresetsInterface;

class Duotone
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
            ->add(new \ItalyStrap\ThemeJsonGenerator\Domain\Input\Settings\Color\Duotone(
                "black-to-white",
                "Black to White",
                $this->presets->get(JsonData::COLOR_BODY_COLOR),
                $this->presets->get(JsonData::COLOR_BODY_BG)
            ))
            ->add(new \ItalyStrap\ThemeJsonGenerator\Domain\Input\Settings\Color\Duotone(
                "white-to-black",
                "White to Black",
                $this->presets->get(JsonData::COLOR_BODY_BG),
                $this->presets->get(JsonData::COLOR_BODY_COLOR)
            ))
            ->add(new \ItalyStrap\ThemeJsonGenerator\Domain\Input\Settings\Color\Duotone(
                "base-to-white",
                "Base to White",
                $this->presets->get(JsonData::COLOR_BASE),
                $this->presets->get(JsonData::COLOR_BODY_BG)
            ))
            ->add(new \ItalyStrap\ThemeJsonGenerator\Domain\Input\Settings\Color\Duotone(
                "base-to-black",
                "Base to Black",
                $this->presets->get(JsonData::COLOR_BASE),
                $this->presets->get(JsonData::COLOR_BODY_COLOR)
            ));
    }
}
