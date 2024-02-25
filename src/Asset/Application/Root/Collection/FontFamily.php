<?php

declare(strict_types=1);

namespace ItalyStrap\ExperimentalTheme\Asset\Application\Root\Collection;

use ItalyStrap\ThemeJsonGenerator\Application\Config\Blueprint;
use ItalyStrap\ThemeJsonGenerator\Domain\Input\Settings\PresetsInterface;

class FontFamily
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
            ->add(new \ItalyStrap\ThemeJsonGenerator\Domain\Input\Settings\Typography\FontFamily(
                'base',
                'Default font family',
                'system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", "Liberation Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji"'
            ))
            ->add(new \ItalyStrap\ThemeJsonGenerator\Domain\Input\Settings\Typography\FontFamily(
                'monospace',
                'Font family for code',
                'SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace'
            ));
    }
}
