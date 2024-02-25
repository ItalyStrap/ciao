<?php

declare(strict_types=1);

namespace ItalyStrap\ExperimentalTheme\Asset\Application\Root;

use ItalyStrap\ExperimentalTheme\JsonData;
use ItalyStrap\ThemeJsonGenerator\Application\Config\Blueprint;
use ItalyStrap\ThemeJsonGenerator\Domain\Input\SectionNames;
use ItalyStrap\ThemeJsonGenerator\Domain\Input\Settings\PresetsInterface;
use ItalyStrap\ThemeJsonGenerator\Domain\Input\Styles\Border;
use ItalyStrap\ThemeJsonGenerator\Domain\Input\Styles\Color;
use ItalyStrap\ThemeJsonGenerator\Domain\Input\Styles\CssExperimental;
use ItalyStrap\ThemeJsonGenerator\Domain\Input\Styles\Spacing;
use ItalyStrap\ThemeJsonGenerator\Domain\Input\Styles\Typography;

class GlobalStyle
{
    private Color $color;
    private Typography $typography;
    private Spacing $spacing;
    private CssExperimental $css;
    private PresetsInterface $presets;

    public function __construct(
        Color $color,
        Typography $typography,
        Spacing $spacing,
        CssExperimental $css,
        PresetsInterface $presets
    ) {
        $this->color = $color;
        $this->typography = $typography;
        $this->spacing = $spacing;
        $this->css = $css;
        $this->presets = $presets;
    }

    /**
     * ============================================
     * Global styles
     *
     * border
     * color
     * typography
     * spacing
     * ============================================
     */
    public function __invoke(Blueprint $blueprint)
    {
        $blueprint->setGlobalCss($this->css->parseString('body{background:#000000;}', 'body'));
        $blueprint->set(SectionNames::STYLES . '.color', $this->color
            ->background(JsonData::COLOR_BODY_BG)
            ->text(JsonData::COLOR_BODY_COLOR));

        $blueprint->set(SectionNames::STYLES . '.typography', $this->typography
            ->fontFamily(JsonData::FONT_FAMILY_BASE)
            ->fontSize(JsonData::FONT_SIZE_BASE)
            ->fontStyle('normal')
            ->fontWeight('400')
            ->letterSpacing('normal')
            ->lineHeight(JsonData::LINE_HEIGHT_M)
            ->textDecoration('none')
            ->textTransform('none'));

        $blueprint->set(SectionNames::STYLES . '.spacing', [
            'blockGap'  => $this->presets->get(JsonData::SPACER_M)->var(),
            'margin'    => $this->spacing->shorthand(['0px']),
            'padding'   => $this->spacing->shorthand(['0px']),
        ]);
    }
}
