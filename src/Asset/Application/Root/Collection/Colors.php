<?php

declare(strict_types=1);

namespace ItalyStrap\ExperimentalTheme\Asset\Application\Root\Collection;

use ItalyStrap\ThemeJsonGenerator\Application\Config\Blueprint;
use ItalyStrap\ThemeJsonGenerator\Domain\Input\Settings\PresetsInterface;
use ItalyStrap\ThemeJsonGenerator\Domain\Input\Settings\Color\Palette;
use ItalyStrap\ThemeJsonGenerator\Domain\Input\Settings\Color\Utilities\Color;
use ItalyStrap\ThemeJsonGenerator\Domain\Input\Settings\Color\Utilities\ColorModifier;
use ItalyStrap\ThemeJsonGenerator\Domain\Input\Settings\Color\Utilities\ShadesGeneratorExperimental;

class Colors
{
    private PresetsInterface $presets;

    public function __construct(
        PresetsInterface $presets
    ) {
        $this->presets = $presets;
    }

    /**
     * light: '#ede7d9'
     * dark: '#0c0910'
     * heading_text: '#0099aa'
     */
    public function __invoke(Blueprint $blueprint): void
    {
        $baseClr = (new Color('#3986E0'))->toHsla();

        $light = (new Color('#ffffff'))->toHsla();
        $dark = (new Color('#000000'))->toHsla();
        $bodyBg = (new Color('#ffffff'))->toHsla();
        $bodyText = (new Color('#000000'))->toHsla();
        $headingText = (new ColorModifier($bodyText))->lighten(20);

        $border_color = (new Color('#cccccc'))->toHsla();

        $button_bg_hover = (new ColorModifier($baseClr))->darken(20);
        $button_text_hover = (new ColorModifier($bodyBg))->darken(10);

        if ($baseClr->isDark()) {
            $button_text_hover = (new ColorModifier($bodyBg))->lighten(10);
        }

        $infoClr = $baseClr;
        $successClr = (new ColorModifier($infoClr))->hueRotate(-82);
        $warningClr = (new ColorModifier($infoClr))->hueRotate(-172);
        $dangerClr = (new ColorModifier($infoClr))->hueRotate(-$infoClr->hue());

        $lightClrPalette = new Palette('light', 'Lighter color', $light);
        $darkClrPalette = new Palette('dark', 'Darker color', $dark);
        $baseClrPalette = new Palette('base', 'Brand base color', $baseClr);
        $bodyBgClrPalette = new Palette('bodyBg', 'Color for body background', $bodyBg);
        $bodyClrPalette = new Palette('bodyColor', 'Color for text', $bodyText);
        $headingClrPalette = new Palette('headingColor', 'Color for headings', $headingText);
        $linkClrPalette = new Palette('linkColor', 'Color for links', $baseClr);
        $borderClrPalette = new Palette('borderColor', 'Color for borders', $border_color);
        $buttonBgHoverClrPalette = new Palette('buttonBgHover', 'Color for button background on hover', $button_bg_hover);
        $buttonTextHoverClrPalette = new Palette('buttonTextHover', 'Color for button text on hover', $button_text_hover);

        $baseDarkClrPalette = new Palette('baseDark', 'Darker Brand base color', (new ColorModifier($baseClrPalette->color()))->darken(20));
        $baseLightClrPalette = new Palette('baseLight', 'Lighter Brand base color', (new ColorModifier($baseClrPalette->color()))->lighten(20));
        $baseComplementaryClrPalette = new Palette('baseComplementary', 'Brand base complementary color', (new ColorModifier($baseClrPalette->color()))->complementary());

        $infoClrPalette = new Palette('infoColor', 'Info color', $infoClr);
        $successClrPalette = new Palette('successColor', 'Success color', $successClr);
        $warningClrPalette = new Palette('warningColor', 'Warning color', $warningClr);
        $dangerClrPalette = new Palette('dangerColor', 'Danger color', $dangerClr);

        // Start by adding colors
        $this->presets->add($baseClrPalette)
            ->add($lightClrPalette)
            ->add($darkClrPalette)
            ->add($bodyBgClrPalette)
            ->add($bodyClrPalette)
            ->add($headingClrPalette)
            ->add($linkClrPalette)
            ->add($buttonBgHoverClrPalette)
            ->add($buttonTextHoverClrPalette)
            ->add($borderClrPalette)
            ->add($baseDarkClrPalette)
            ->add($baseLightClrPalette)
            ->add($baseComplementaryClrPalette)
            ->add($infoClrPalette)
            ->add($successClrPalette)
            ->add($warningClrPalette)
            ->add($dangerClrPalette)
            ->addMultiple(
                ShadesGeneratorExperimental::fromPalette($baseClrPalette)->toArray()
            )
            ->addMultiple(
                ShadesGeneratorExperimental::fromPalette($bodyClrPalette)->toArray()
            );
    }
}
