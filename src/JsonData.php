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
use ItalyStrap\ThemeJsonGenerator\Domain\Input\Settings\CollectionInterface;
use ItalyStrap\ThemeJsonGenerator\Domain\Input\Settings\Color\Duotone;
use ItalyStrap\ThemeJsonGenerator\Domain\Input\Settings\Color\Gradient;
use ItalyStrap\ThemeJsonGenerator\Domain\Input\Settings\Color\Palette;
use ItalyStrap\ThemeJsonGenerator\Domain\Input\Settings\Color\Utilities\ColorInfo;
use ItalyStrap\ThemeJsonGenerator\Domain\Input\Settings\Color\Utilities\ColorModifier;
use ItalyStrap\ThemeJsonGenerator\Domain\Input\Settings\Color\Utilities\LinearGradient;
use ItalyStrap\ThemeJsonGenerator\Domain\Input\Settings\Color\Utilities\ShadesGeneratorExperimental;
use ItalyStrap\ThemeJsonGenerator\Domain\Input\Settings\Custom\CollectionAdapter;
use ItalyStrap\ThemeJsonGenerator\Domain\Input\Settings\Custom\Custom;
use ItalyStrap\ThemeJsonGenerator\Domain\Input\Settings\Typography\FontFamily;
use ItalyStrap\ThemeJsonGenerator\Domain\Input\Settings\Typography\FontSize;
use ItalyStrap\ThemeJsonGenerator\Domain\Input\Settings\Utilities\CalcExperimental;
use ItalyStrap\ThemeJsonGenerator\Domain\Input\Styles\Border;
use ItalyStrap\ThemeJsonGenerator\Domain\Input\Styles\Color;
use ItalyStrap\ThemeJsonGenerator\Domain\Input\Styles\Spacing;
use ItalyStrap\ThemeJsonGenerator\Domain\Input\Styles\Typography;
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


    public static function getJsonData(ContainerInterface $container, CollectionInterface $collection): void
    {
        (new self())($container, $collection);
    }

    /**
     * light: '#ede7d9'
     * dark: '#0c0910'
     * heading_text: '#0099aa'
     */
    private function registerColors(CollectionInterface $collection): void
    {
        $baseClr = (new ColorInfo('#3986E0'))->toHsla();

        $light = (new ColorInfo('#ffffff'))->toHsla();
        $dark = (new ColorInfo('#000000'))->toHsla();
        $bodyBg = (new ColorInfo('#ffffff'))->toHsla();
        $bodyText = (new ColorInfo('#000000'))->toHsla();
        $headingText = (new ColorModifier($bodyText))->lighten(20);

        $border_color = (new ColorInfo('#cccccc'))->toHsla();

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
        $collection->add($baseClrPalette)
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

    private function registerGradient(CollectionInterface $collection): void
    {
        $collection
            ->add(new Gradient(
                'light-to-dark',
                'Black to white',
                new LinearGradient(
                    '160deg',
                    $collection->get(self::COLOR_LIGHT),
                    $collection->get(self::COLOR_DARK)
                )
            ))
            ->add(new Gradient(
                'base-to-white',
                'Base to white',
                new LinearGradient(
                    '135deg',
                    $collection->get(self::COLOR_BASE),
                    $collection->get(self::COLOR_BASE_DARK)
                )
            ));
    }

    private function registerDuotone(CollectionInterface $collection): void
    {
        $collection
            ->add(new Duotone(
                "black-to-white",
                "Black to White",
                $collection->get(self::COLOR_BODY_COLOR),
                $collection->get(self::COLOR_BODY_BG)
            ))
            ->add(new Duotone(
                "white-to-black",
                "White to Black",
                $collection->get(self::COLOR_BODY_BG),
                $collection->get(self::COLOR_BODY_COLOR)
            ))
            ->add(new Duotone(
                "base-to-white",
                "Base to White",
                $collection->get(self::COLOR_BASE),
                $collection->get(self::COLOR_BODY_BG)
            ))
            ->add(new Duotone(
                "base-to-black",
                "Base to Black",
                $collection->get(self::COLOR_BASE),
                $collection->get(self::COLOR_BODY_COLOR)
            ));
    }

    private function registerFontSizes(CollectionInterface $collection): void
    {
        $collection
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

    private function registerFontFamily(CollectionInterface $collection): void
    {
        $collection
            ->add(new FontFamily(
                'base',
                'Default font family',
                'system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", "Liberation Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji"'
            ))
            ->add(new FontFamily(
                'monospace',
                'Font family for code',
                'SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace'
            ));
    }

    private function registerCustom(CollectionInterface $collection): void
    {
        $spacerBase = '1rem';

//        $testDimension = new Dimension('1%');
//        var_dump($testDimension->value());
//        var_dump($testDimension->unit());
//        var_dump((string)$testDimension);
//        $testCalc = new Calc((string)$testDimension, '+', (string)$testDimension);
//        var_dump($testCalc->value());
//        var_dump((string)$testCalc);
//        $testCalc = new Calc((string)$testDimension, '+', (string)$testDimension, '+', (string)$testDimension);

        $collectionAdapter = new CollectionAdapter([
            'contentSize'   => 'clamp(16rem, 60vw, 60rem)',
            'wideSize'      => 'clamp(16rem, 85vw, 70rem)',
            'baseFontSize'  => "1rem",
            'spacer'        => [
                'base'  => '1rem',
                'v'     => 'calc( {{spacer.base}} * 4 )',
                'h'     => 'calc( {{spacer.base}} * 4 )',
                's'     => 'calc( {{spacer.base}} / 1.5 )',
                'm'     => 'calc( {{spacer.base}} * 2 )',
                'l'     => 'calc( {{spacer.base}} * 3 )',
                'xl'    => 'calc( {{spacer.base}} * 4 )',
            ],
            'lineHeight'    => [
                'base' => '1.5',
                'xs' => '1.1',
                's' => '1.3',
                'm' => '{{lineHeight.base}}',
                'l' => '1.7'
            ],
            'body'      => [
                'bg'    => $collection->get(self::COLOR_BASE),
                'text'  => $collection->get(self::COLOR_BODY_BG),
            ],
            'link'      => [
                'bg'    => $collection->get(self::COLOR_BASE),
                'text'  => $collection->get(self::COLOR_BODY_BG),
                'decoration'    => 'underline',
                'hover' => [
                    'text'          => $collection->get(self::COLOR_BODY_COLOR),
                    'decoration'    => 'underline',
                ],
            ],
            'button'        => [
                'bg'    => $collection->get(self::COLOR_BASE),
                'text'    => $collection->get(self::COLOR_BUTTON_TEXT_HOVER),
                'borderColor'   => 'transparent',
                'borderRadius'  => (string)(new CalcExperimental(
                    $collection->get(self::FONT_SIZE_BASE)->var(),
                    '/',
                    '3'
                )),
                'hover' => [
                    'bg'    => $collection->get(self::COLOR_BUTTON_BG_HOVER),
                    'text'  => $collection->get(self::COLOR_BUTTON_TEXT_HOVER),
                    'borderColor'   => 'transparent',
                ],
                'padding'   => [
                    'h' => '0.75em',
                    'v' => '0.375em',
                ],
            ],
            'form'  => [
                'border'    => [
                    'color' => '',
                    'width' => '',
                ],
                'input' => [
                    'color' => '',
                ],
            ],
            'navbar'    => [
                'min'       => [
                    'height'    => 'calc( {{spacer.base}} * 5.3125 )',
                ],
            ],
            'query'     => [
                'post'  => [
                ],
            ],
        ]);

        $collection->addMultiple(
            $collectionAdapter->toArray()
        );

//        $collection
//            ->add(new Item(
//                self::CONTENT_SIZE,
//                'clamp(16rem, 60vw, 60rem)'
//            ))
//            ->add(new Item(
//                self::LINE_HEIGHT_L,
//                '1.7'
//            ));
    }

    public function __invoke(ContainerInterface $container, CollectionInterface $collection): void
    {
        $this->registerColors($collection);
        $this->registerGradient($collection);
        $this->registerDuotone($collection);
        $this->registerFontSizes($collection);
        $this->registerFontFamily($collection);
        $this->registerCustom($collection);

        $blueprint = $container->get(Blueprint::class);

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
                    'contentSize' => $collection->get(self::CONTENT_SIZE)->var(),
                    'wideSize' => $collection->get(self::WIDE_SIZE)->var(),
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

        $this->registerCollection($blueprint, $collection);

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

    /**
     * @param Blueprint $blueprint
     * @param CollectionInterface $collection
     * @return void
     */
    private function registerCollection(Blueprint $blueprint, CollectionInterface $collection): void
    {
        $blueprint->set(Palette::KEY, $collection->toArrayByCategory(Palette::CATEGORY));
        $blueprint->set('settings.color.gradients', $collection->toArrayByCategory(Gradient::CATEGORY));
        $blueprint->set('settings.color.duotone', $collection->toArrayByCategory(Duotone::CATEGORY));
        $blueprint->set('settings.typography.fontSizes', $collection->toArrayByCategory(FontSize::CATEGORY));
        $blueprint->set('settings.typography.fontFamilies', $collection->toArrayByCategory(FontFamily::CATEGORY));
        $blueprint->set('settings.custom', $collection->toArrayByCategory(Custom::CATEGORY));
    }
}
