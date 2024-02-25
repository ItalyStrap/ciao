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
    public const COLOR_BASE = Palette::TYPE . '.base';
    public const COLOR_LIGHT = Palette::TYPE . '.light';
    public const COLOR_DARK = Palette::TYPE . '.dark';
    public const COLOR_BODY_BG = Palette::TYPE . '.bodyBg';
    public const COLOR_BODY_COLOR = Palette::TYPE . '.bodyColor';
    public const COLOR_HEADING_TEXT = Palette::TYPE . '.headingColor';
    public const COLOR_LINK_TEXT = Palette::TYPE . '.linkColor';
    public const COLOR_BORDER = Palette::TYPE . '.borderColor';
    public const COLOR_BUTTON_BG_HOVER = Palette::TYPE . '.buttonBgHover';
    public const COLOR_BUTTON_TEXT_HOVER = Palette::TYPE . '.buttonTextHover';
    public const COLOR_BASE_DARK = Palette::TYPE . '.baseDark';
    public const COLOR_BASE_LIGHT = Palette::TYPE . '.baseLight';
    public const COLOR_BASE_COMPLEMENTARY = Palette::TYPE . '.baseComplementary';
    public const COLOR_GRAY_100 = Palette::TYPE . '.bodyColor-100';
    public const COLOR_GRAY_200 = Palette::TYPE . '.bodyColor-200';
    public const COLOR_GRAY_300 = Palette::TYPE . '.bodyColor-300';
    public const COLOR_GRAY_400 = Palette::TYPE . '.bodyColor-400';
    public const COLOR_GRAY_500 = Palette::TYPE . '.bodyColor-500';
    public const COLOR_GRAY_600 = Palette::TYPE . '.bodyColor-600';
    public const COLOR_GRAY_700 = Palette::TYPE . '.bodyColor-700';
    public const COLOR_GRAY_800 = Palette::TYPE . '.bodyColor-800';
    public const COLOR_GRAY_900 = Palette::TYPE . '.bodyColor-900';

    public const GRADIENT_LIGHT_TO_DARK = Gradient::TYPE . '.light-to-dark';

    public const FONT_FAMILY_BASE = FontFamily::TYPE . '.base';
    public const FONT_FAMILY_MONOSPACE = FontFamily::TYPE . '.monospace';

    public const FONT_SIZE_BASE = FontSize::TYPE . '.base';
    public const FONT_SIZE_H1 = FontSize::TYPE . '.h1';
    public const FONT_SIZE_H2 = FontSize::TYPE . '.h2';
    public const FONT_SIZE_H3 = FontSize::TYPE . '.h3';
    public const FONT_SIZE_H4 = FontSize::TYPE . '.h4';
    public const FONT_SIZE_H5 = FontSize::TYPE . '.h5';
    public const FONT_SIZE_H6 = FontSize::TYPE . '.h6';
    public const FONT_SIZE_SMALL = FontSize::TYPE . '.small';
    public const FONT_SIZE_X_SMALL = FontSize::TYPE . '.x-small';

    public const CONTENT_SIZE = Custom::TYPE . '.contentSize';
    public const WIDE_SIZE = Custom::TYPE . '.wideSize';
    public const BASE_FONT_SIZE = Custom::TYPE . '.baseFontSize';
    public const SPACER_BASE = Custom::TYPE . '.spacer.base';
    public const SPACER_V = Custom::TYPE . '.spacer.v';
    public const SPACER_H = Custom::TYPE . '.spacer.h';
    public const SPACER_S = Custom::TYPE . '.spacer.s';
    public const SPACER_M = Custom::TYPE . '.spacer.m';
    public const SPACER_L = Custom::TYPE . '.spacer.l';
    public const SPACER_XL = Custom::TYPE . '.spacer.xl';
    public const LINE_HEIGHT_BASE = Custom::TYPE . '.lineHeight.base';
    public const LINE_HEIGHT_XS = Custom::TYPE . '.lineHeight.xs';
    public const LINE_HEIGHT_S = Custom::TYPE . '.lineHeight.s';
    public const LINE_HEIGHT_M = Custom::TYPE . '.lineHeight.m';
    public const LINE_HEIGHT_L = Custom::TYPE . '.lineHeight.l';
    public const BODY_BG = Custom::TYPE . '.body.bg';
    public const BODY_TEXT = Custom::TYPE . '.body.text';
    public const LINK_BG = Custom::TYPE . '.link.bg';
    public const LINK_TEXT = Custom::TYPE . '.link.text';
    public const LINK_DECORATION = Custom::TYPE . '.link.decoration';
    public const LINK_HOVER_TEXT = Custom::TYPE . '.link.hover.text';
    public const LINK_HOVER_DECORATION = Custom::TYPE . '.link.hover.decoration';
    public const BUTTON_BG = Custom::TYPE . '.button.bg';
    public const BUTTON_TEXT = Custom::TYPE . '.button.text';
    public const BUTTON_BORDER_COLOR = Custom::TYPE . '.button.borderColor';
    public const BUTTON_BORDER_RADIUS = Custom::TYPE . '.button.borderRadius';
    public const BUTTON_HOVER_BG = Custom::TYPE . '.button.hover.bg';
    public const BUTTON_HOVER_TEXT = Custom::TYPE . '.button.hover.text';
    public const BUTTON_HOVER_BORDER_COLOR = Custom::TYPE . '.button.hover.borderColor';
    public const BUTTON_PADDING_V = Custom::TYPE . '.button.padding.v';
    public const BUTTON_PADDING_H = Custom::TYPE . '.button.padding.h';
    public const FORM_BORDER_COLOR = Custom::TYPE . '.form.borderColor';
    public const FORM_BORDER_WIDTH = Custom::TYPE . '.form.borderWidth';
    public const FORM_INPUT_COLOR = Custom::TYPE . '.form.input.color';
    public const NAVBAR_MIN_HEIGHT = Custom::TYPE . '.navbar.min.height';
    public const QUERY_POST_TITLE = Custom::TYPE . '.query.post.title';
    public const SITE_BLOCKS_MARGIN_TOP = Custom::TYPE . '.site-blocks.margin.top';


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
