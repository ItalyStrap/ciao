<?php

declare(strict_types=1);

namespace ItalyStrap\ExperimentalTheme\Asset\Application\Root\Collection;

use ItalyStrap\ExperimentalTheme\JsonData;
use ItalyStrap\ThemeJsonGenerator\Application\Config\Blueprint;
use ItalyStrap\ThemeJsonGenerator\Domain\Input\Settings\PresetsInterface;

class Duotone
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
            ->add(new \ItalyStrap\ThemeJsonGenerator\Domain\Input\Settings\Color\Duotone(
                "black-to-white",
                "Black to White",
                $this->collection->get(JsonData::COLOR_BODY_COLOR),
                $this->collection->get(JsonData::COLOR_BODY_BG)
            ))
            ->add(new \ItalyStrap\ThemeJsonGenerator\Domain\Input\Settings\Color\Duotone(
                "white-to-black",
                "White to Black",
                $this->collection->get(JsonData::COLOR_BODY_BG),
                $this->collection->get(JsonData::COLOR_BODY_COLOR)
            ))
            ->add(new \ItalyStrap\ThemeJsonGenerator\Domain\Input\Settings\Color\Duotone(
                "base-to-white",
                "Base to White",
                $this->collection->get(JsonData::COLOR_BASE),
                $this->collection->get(JsonData::COLOR_BODY_BG)
            ))
            ->add(new \ItalyStrap\ThemeJsonGenerator\Domain\Input\Settings\Color\Duotone(
                "base-to-black",
                "Base to Black",
                $this->collection->get(JsonData::COLOR_BASE),
                $this->collection->get(JsonData::COLOR_BODY_COLOR)
            ));
    }
}
