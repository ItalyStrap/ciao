<?php

declare(strict_types=1);

namespace ItalyStrap\ExperimentalTheme;

use ItalyStrap\ExperimentalTheme\Asset\Application\Root\Buttons;
use ItalyStrap\ExperimentalTheme\Asset\Application\Root\Containers;
use ItalyStrap\ExperimentalTheme\Asset\Application\Root\Elements;
use ItalyStrap\ExperimentalTheme\Asset\Application\Root\GlobalStyle;
use ItalyStrap\ExperimentalTheme\Asset\Application\Root\Heading;
use ItalyStrap\ExperimentalTheme\Asset\Application\Root\Media;
use ItalyStrap\ExperimentalTheme\Asset\Application\Root\Navigation;
use ItalyStrap\ExperimentalTheme\Asset\Application\Root\PostBody;
use ItalyStrap\ExperimentalTheme\Asset\Application\Root\PostComments;
use ItalyStrap\ExperimentalTheme\Asset\Application\Root\PostMeta;
use ItalyStrap\ExperimentalTheme\Asset\Application\Root\SiteTagline;
use ItalyStrap\ExperimentalTheme\Asset\Application\Root\SpacerSeparator;
use ItalyStrap\ExperimentalTheme\Asset\Application\Root\TermDescription;
use ItalyStrap\ExperimentalTheme\Asset\Application\Root\Title;
use ItalyStrap\ThemeJsonGenerator\Application\Config\Blueprint;
use ItalyStrap\ThemeJsonGenerator\Domain\Input\SectionNames;
use ItalyStrap\ThemeJsonGenerator\Domain\Input\Settings\PresetsInterface;
use ItalyStrap\ThemeJsonGenerator\Domain\Input\Settings\Color\Duotone;
use ItalyStrap\ThemeJsonGenerator\Domain\Input\Settings\Color\Gradient;
use ItalyStrap\ThemeJsonGenerator\Domain\Input\Settings\Color\Palette;
use ItalyStrap\ThemeJsonGenerator\Domain\Input\Settings\Custom\Custom;
use ItalyStrap\ThemeJsonGenerator\Domain\Input\Settings\Typography\FontFamily;
use ItalyStrap\ThemeJsonGenerator\Domain\Input\Settings\Typography\FontSize;
use Psr\Container\ContainerInterface;

final class JsonData
{
    public const VERSION = 2;
    public const COLOR_BASE = Palette::CATEGORY . '.base';
    public const COLOR_LIGHT = Palette::CATEGORY . '.light';
    public const COLOR_DARK = Palette::CATEGORY . '.dark';
    public const COLOR_BODY_BG = Palette::CATEGORY . '.bodyBg';
    public const COLOR_BODY_COLOR = Palette::CATEGORY . '.bodyColor';
    public const COLOR_HEADING_TEXT = Palette::CATEGORY . '.headingColor';
    public const COLOR_LINK_TEXT = Palette::CATEGORY . '.linkColor';
    public const COLOR_BORDER = Palette::CATEGORY . '.borderColor';
    public const COLOR_BUTTON_BG_HOVER = Palette::CATEGORY . '.buttonBgHover';
    public const COLOR_BUTTON_TEXT_HOVER = Palette::CATEGORY . '.buttonTextHover';
    public const COLOR_BASE_DARK = Palette::CATEGORY . '.baseDark';
    public const COLOR_BASE_LIGHT = Palette::CATEGORY . '.baseLight';
    public const COLOR_BASE_COMPLEMENTARY = Palette::CATEGORY . '.baseComplementary';
    public const COLOR_GRAY_100 = Palette::CATEGORY . '.bodyColor-100';
    public const COLOR_GRAY_200 = Palette::CATEGORY . '.bodyColor-200';
    public const COLOR_GRAY_300 = Palette::CATEGORY . '.bodyColor-300';
    public const COLOR_GRAY_400 = Palette::CATEGORY . '.bodyColor-400';
    public const COLOR_GRAY_500 = Palette::CATEGORY . '.bodyColor-500';
    public const COLOR_GRAY_600 = Palette::CATEGORY . '.bodyColor-600';
    public const COLOR_GRAY_700 = Palette::CATEGORY . '.bodyColor-700';
    public const COLOR_GRAY_800 = Palette::CATEGORY . '.bodyColor-800';
    public const COLOR_GRAY_900 = Palette::CATEGORY . '.bodyColor-900';

    public const GRADIENT_LIGHT_TO_DARK = Gradient::CATEGORY . '.light-to-dark';

    public const FONT_FAMILY_BASE = FontFamily::CATEGORY . '.base';
    public const FONT_FAMILY_MONOSPACE = FontFamily::CATEGORY . '.monospace';

    public const FONT_SIZE_BASE = FontSize::CATEGORY . '.base';
    public const FONT_SIZE_H1 = FontSize::CATEGORY . '.h1';
    public const FONT_SIZE_H2 = FontSize::CATEGORY . '.h2';
    public const FONT_SIZE_H3 = FontSize::CATEGORY . '.h3';
    public const FONT_SIZE_H4 = FontSize::CATEGORY . '.h4';
    public const FONT_SIZE_H5 = FontSize::CATEGORY . '.h5';
    public const FONT_SIZE_H6 = FontSize::CATEGORY . '.h6';
    public const FONT_SIZE_SMALL = FontSize::CATEGORY . '.small';
    public const FONT_SIZE_X_SMALL = FontSize::CATEGORY . '.x-small';

    public const CONTENT_SIZE = Custom::CATEGORY . '.contentSize';
    public const WIDE_SIZE = Custom::CATEGORY . '.wideSize';
    public const BASE_FONT_SIZE = Custom::CATEGORY . '.baseFontSize';
    public const SPACER_BASE = Custom::CATEGORY . '.spacer.base';
    public const SPACER_V = Custom::CATEGORY . '.spacer.v';
    public const SPACER_H = Custom::CATEGORY . '.spacer.h';
    public const SPACER_S = Custom::CATEGORY . '.spacer.s';
    public const SPACER_M = Custom::CATEGORY . '.spacer.m';
    public const SPACER_L = Custom::CATEGORY . '.spacer.l';
    public const SPACER_XL = Custom::CATEGORY . '.spacer.xl';
    public const LINE_HEIGHT_BASE = Custom::CATEGORY . '.lineHeight.base';
    public const LINE_HEIGHT_XS = Custom::CATEGORY . '.lineHeight.xs';
    public const LINE_HEIGHT_S = Custom::CATEGORY . '.lineHeight.s';
    public const LINE_HEIGHT_M = Custom::CATEGORY . '.lineHeight.m';
    public const LINE_HEIGHT_L = Custom::CATEGORY . '.lineHeight.l';
    public const BODY_BG = Custom::CATEGORY . '.body.bg';
    public const BODY_TEXT = Custom::CATEGORY . '.body.text';
    public const LINK_BG = Custom::CATEGORY . '.link.bg';
    public const LINK_TEXT = Custom::CATEGORY . '.link.text';
    public const LINK_DECORATION = Custom::CATEGORY . '.link.decoration';
    public const LINK_HOVER_TEXT = Custom::CATEGORY . '.link.hover.text';
    public const LINK_HOVER_DECORATION = Custom::CATEGORY . '.link.hover.decoration';
    public const BUTTON_BG = Custom::CATEGORY . '.button.bg';
    public const BUTTON_TEXT = Custom::CATEGORY . '.button.text';
    public const BUTTON_BORDER_COLOR = Custom::CATEGORY . '.button.borderColor';
    public const BUTTON_BORDER_RADIUS = Custom::CATEGORY . '.button.borderRadius';
    public const BUTTON_HOVER_BG = Custom::CATEGORY . '.button.hover.bg';
    public const BUTTON_HOVER_TEXT = Custom::CATEGORY . '.button.hover.text';
    public const BUTTON_HOVER_BORDER_COLOR = Custom::CATEGORY . '.button.hover.borderColor';
    public const BUTTON_PADDING_V = Custom::CATEGORY . '.button.padding.v';
    public const BUTTON_PADDING_H = Custom::CATEGORY . '.button.padding.h';
    public const FORM_BORDER_COLOR = Custom::CATEGORY . '.form.borderColor';
    public const FORM_BORDER_WIDTH = Custom::CATEGORY . '.form.borderWidth';
    public const FORM_INPUT_COLOR = Custom::CATEGORY . '.form.input.color';
    public const NAVBAR_MIN_HEIGHT = Custom::CATEGORY . '.navbar.min.height';
    public const QUERY_POST_TITLE = Custom::CATEGORY . '.query.post.title';
    public const SITE_BLOCKS_MARGIN_TOP = Custom::CATEGORY . '.site-blocks.margin.top';


    public static function getJsonData(ContainerInterface $container, PresetsInterface $collection): void
    {
        (new self())($container, $collection);
    }

    public function __invoke(ContainerInterface $container, PresetsInterface $presets): void
    {
        $blueprint = $container->get(Blueprint::class);
        $container->get(\ItalyStrap\ExperimentalTheme\Asset\Application\Root\Collection\Colors::class)($blueprint);
        $container->get(\ItalyStrap\ExperimentalTheme\Asset\Application\Root\Collection\Gradient::class)($blueprint);
        $container->get(\ItalyStrap\ExperimentalTheme\Asset\Application\Root\Collection\Duotone::class)($blueprint);
        $container->get(\ItalyStrap\ExperimentalTheme\Asset\Application\Root\Collection\FontSizes::class)($blueprint);
        $container->get(\ItalyStrap\ExperimentalTheme\Asset\Application\Root\Collection\FontFamily::class)($blueprint);
        $container->get(\ItalyStrap\ExperimentalTheme\Asset\Application\Root\Collection\Custom::class)($blueprint);

        $blueprint->merge([
            SectionNames::SCHEMA => 'https://schemas.wp.org/trunk/theme.json',
            SectionNames::VERSION => self::VERSION,
            SectionNames::TITLE => 'Experimental Theme',
            SectionNames::DESCRIPTION => 'Experimental Theme',
            SectionNames::SETTINGS => [
                'color' => [
                    'custom'    => true,
                    'link'      => true,
                ],
                'typography' => [
                    'customFontSize'    => true,
//                    'customLineHeight'  => true,
                ],
                'spacing' => [
                    'blockGap'  => true,
//                    'customMargin' => true,
//                    'customPadding' => true,
                    'units' => [ '%', 'px', 'em', 'rem', 'vh', 'vw' ]
                ],
//                'border' => [
//                    'customColor'   => true,
//                    'customRadius'  => true,
//                    'customStyle'   => true,
//                    'customWidth'   => true,
//                ],

                'layout' => [
                    'contentSize' => $presets->get(self::CONTENT_SIZE)->var(),
                    'wideSize' => $presets->get(self::WIDE_SIZE)->var(),
                ],
            ],

            /**
             * ============================================
             * Styles for FSE and Front-End
             * ============================================
             */
            SectionNames::STYLES    => [
            ],
            SectionNames::TEMPLATE_PARTS => [
                Helper::templateParts('header', 'header'),
                Helper::templateParts('singular-header', 'header'),
                Helper::templateParts('footer', 'footer'),
            ],
            SectionNames::CUSTOM_TEMPLATES  => [
                [
                    'name'  => 'blank',
                    'title' => 'Blank',
                    'postTypes' => [
                        'page',
                        'post',
                    ],
                ],
            ],
        ]);

        $container->get(GlobalStyle::class)($blueprint);
        $container->get(Elements::class)($blueprint);
        $container->get(Containers::class)($blueprint);
        $container->get(Heading::class)($blueprint);
        $container->get(Buttons::class)($blueprint);
        $container->get(Title::class)($blueprint);
        $container->get(PostBody::class)($blueprint);
        $container->get(PostComments::class)($blueprint);
        $container->get(PostMeta::class)($blueprint);
        $container->get(Navigation::class)($blueprint);
        $container->get(Media::class)($blueprint);
        $container->get(SpacerSeparator::class)($blueprint);
        $container->get(TermDescription::class)($blueprint);
        $container->get(SiteTagline::class)($blueprint);
    }
}
