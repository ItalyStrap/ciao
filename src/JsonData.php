<?php

declare(strict_types=1);

namespace ItalyStrap\ExperimentalTheme;

use ItalyStrap\ThemeJsonGenerator\Domain\SectionNames;
use ItalyStrap\ThemeJsonGenerator\Domain\Settings\Collection;
use ItalyStrap\ThemeJsonGenerator\Domain\Settings\CollectionInterface;
use ItalyStrap\ThemeJsonGenerator\Domain\Settings\Color\Palette;
use ItalyStrap\ThemeJsonGenerator\Domain\Settings\Color\Duotone;
use ItalyStrap\ThemeJsonGenerator\Domain\Settings\Color\Gradient;
use ItalyStrap\ThemeJsonGenerator\Domain\Settings\Color\Utilities\ColorModifier;
use ItalyStrap\ThemeJsonGenerator\Domain\Settings\Color\Utilities\ColorInfo as UtilityColor;
use ItalyStrap\ThemeJsonGenerator\Domain\Settings\Color\Utilities\LinearGradient;
use ItalyStrap\ThemeJsonGenerator\Domain\Settings\Color\Utilities\ShadesGeneratorExperimental;
use ItalyStrap\ThemeJsonGenerator\Domain\Settings\Custom\CollectionAdapter;
use ItalyStrap\ThemeJsonGenerator\Domain\Settings\Custom\Item;
use ItalyStrap\ThemeJsonGenerator\Domain\Settings\Typography\FontFamily;
use ItalyStrap\ThemeJsonGenerator\Domain\Settings\Typography\FontSize;
use ItalyStrap\ThemeJsonGenerator\Domain\Styles\Border;
use ItalyStrap\ThemeJsonGenerator\Domain\Styles\Color;
use ItalyStrap\ThemeJsonGenerator\Domain\Styles\Spacing;
use ItalyStrap\ThemeJsonGenerator\Domain\Styles\Typography;

final class JsonData
{
    public const VERSION = 1;
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
    public const COLOR_GRAY_100 = Palette::CATEGORY . '.gray-100';
    public const COLOR_GRAY_200 = Palette::CATEGORY . '.gray-200';
    public const COLOR_GRAY_300 = Palette::CATEGORY . '.gray-300';
    public const COLOR_GRAY_400 = Palette::CATEGORY . '.gray-400';
    public const COLOR_GRAY_500 = Palette::CATEGORY . '.gray-500';
    public const COLOR_GRAY_600 = Palette::CATEGORY . '.gray-600';
    public const COLOR_GRAY_700 = Palette::CATEGORY . '.gray-700';
    public const COLOR_GRAY_800 = Palette::CATEGORY . '.gray-800';
    public const COLOR_GRAY_900 = Palette::CATEGORY . '.gray-900';

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

    public const CONTENT_SIZE = 'custom.contentSize';
    public const WIDE_SIZE = 'custom.wideSize';
    public const BASE_FONT_SIZE = 'custom.baseFontSize';
    public const SPACER_BASE = 'custom.spacer.base';
    public const SPACER_V = 'custom.spacer.v';
    public const SPACER_H = 'custom.spacer.h';
    public const SPACER_S = 'custom.spacer.s';
    public const SPACER_M = 'custom.spacer.m';
    public const SPACER_L = 'custom.spacer.l';
    public const SPACER_XL = 'custom.spacer.xl';
    public const LINE_HEIGHT_BASE = 'custom.lineHeight.base';
    public const LINE_HEIGHT_XS = 'custom.lineHeight.xs';
    public const LINE_HEIGHT_S = 'custom.lineHeight.s';
    public const LINE_HEIGHT_M = 'custom.lineHeight.m';
    public const LINE_HEIGHT_L = 'custom.lineHeight.l';
    public const BODY_BG = 'custom.body.bg';
    public const BODY_TEXT = 'custom.body.text';
    public const LINK_BG = 'custom.link.bg';
    public const LINK_TEXT = 'custom.link.text';
    public const LINK_DECORATION = 'custom.link.decoration';
    public const LINK_HOVER_TEXT = 'custom.link.hover.text';
    public const LINK_HOVER_DECORATION = 'custom.link.hover.decoration';
    public const BUTTON_BG = 'custom.button.bg';
    public const BUTTON_TEXT = 'custom.button.text';
    public const BUTTON_BORDER_COLOR = 'custom.button.borderColor';
    public const BUTTON_BORDER_RADIUS = 'custom.button.borderRadius';
    public const BUTTON_HOVER_BG = 'custom.button.hover.bg';
    public const BUTTON_HOVER_TEXT = 'custom.button.hover.text';
    public const BUTTON_HOVER_BORDER_COLOR = 'custom.button.hover.borderColor';
    public const BUTTON_PADDING = 'custom.button.padding';
    public const FORM_BORDER_COLOR = 'custom.form.borderColor';
    public const FORM_BORDER_WIDTH = 'custom.form.borderWidth';
    public const FORM_INPUT_COLOR = 'custom.form.input.color';
    public const NAVBAR_MIN_HEIGHT = 'custom.navbar.min.height';
    public const QUERY_POST_TITLE = 'custom.query.post.title';
    public const SITE_BLOCKS_MARGIN_TOP = 'custom.site-blocks.margin.top';


    public static function getJsonData(): array
    {
        return (new self())->buildJsonData();
    }

    /**
     * light: '#ede7d9'
     * dark: '#0c0910'
     * heading_text: '#0099aa'
     */
    private function registerColors(CollectionInterface $collection): void
    {
        $light = (new UtilityColor('#ffffff'))->toHsla();
        $dark = (new UtilityColor('#000000'))->toHsla();
        $body_bg = (new UtilityColor('#ffffff'))->toHsla();
        $body_text = (new UtilityColor('#000000'))->toHsla();
        $heading_text = (new ColorModifier($body_text))->lighten(20);
        $base_clr = (new UtilityColor('#3986E0'))->toHsla();

        $border_color = (new UtilityColor('#cccccc'))->toHsla();

        $button_bg_hover = (new ColorModifier($base_clr))->darken(20);
        $button_text_hover = (new ColorModifier($body_bg))->darken(10);

        if ($base_clr->isDark()) {
            $button_text_hover = (new ColorModifier($body_bg))->lighten(10);
        }

        $lightClrPalette = new Palette('light', 'Lighter color', $light);
        $darkClrPalette = new Palette('dark', 'Darker color', $dark);
        $baseClrPalette = new Palette('base', 'Brand base color', $base_clr);
        $bodyBgClrPalette = new Palette('bodyBg', 'Color for body background', $body_bg);
        $bodyClrPalette = new Palette('bodyColor', 'Color for text', $body_text);
        $headingClrPalette = new Palette('headingColor', 'Color for headings', $heading_text);
        $linkClrPalette = new Palette('linkColor', 'Color for links', $base_clr);
        $borderClrPalette = new Palette('borderColor', 'Color for borders', $border_color);
        $buttonBgHoverClrPalette = new Palette('buttonBgHover', 'Color for button background on hover', $button_bg_hover);
        $buttonTextHoverClrPalette = new Palette('buttonTextHover', 'Color for button text on hover', $button_text_hover);

        $baseDarkClrPalette = new Palette('baseDark', 'Darker Brand base color', (new ColorModifier($baseClrPalette->color()))->darken(20));
        $baseLightClrPalette = new Palette('baseLight', 'Lighter Brand base color', (new ColorModifier($baseClrPalette->color()))->lighten(20));
        $baseComplementaryClrPalette = new Palette('baseComplementary', 'Brand base complementary color', (new ColorModifier($baseClrPalette->color()))->complementary());

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
            ->addMultiple(
                ShadesGeneratorExperimental::fromPalette($bodyClrPalette)->toArray()
            );
    }

    private function registerGradient(CollectionInterface $collection): void
    {
        $collection
            ->add(
                new Gradient(
                    'light-to-dark',
                    'Black to white',
                    new LinearGradient(
                        '160deg',
                        $collection->get(self::COLOR_LIGHT),
                        $collection->get(self::COLOR_DARK)
                    )
                )
            )
            ->add(
                new Gradient(
                    'base-to-white',
                    'Base to white',
                    new LinearGradient(
                        '135deg',
                        $collection->get(self::COLOR_BASE),
                        $collection->get(self::COLOR_BASE_DARK)
                    )
                )
            );
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
            ->add(new FontSize('base', 'Base font size 16px', 'clamp(1.125rem, 2vw, 1.5rem)'))
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
                'borderRadius'  => 'calc( {{fontSize.base}} /4)',
                'hover' => [
                    'bg'    => $collection->get(self::COLOR_BUTTON_BG_HOVER),
                    'text'  => $collection->get(self::COLOR_BUTTON_TEXT_HOVER),
                    'borderColor'   => 'transparent',
                ],
                'padding'   => ' 0.25em 0.7em',
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
//                    'title'   => 'var:preset|fontSize|h1',
                ],
            ],
            //              'site-blocks'   => [
            //                      'margin'    => [
            //                          'top'   => '',
            //                  ],
            //              ],
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

    public function buildJsonData(): array
    {
        $collection = new Collection();

        $this->registerColors($collection);
        $this->registerGradient($collection);
        $this->registerDuotone($collection);
        $this->registerFontSizes($collection);
        $this->registerFontFamily($collection);
        $this->registerCustom($collection);

        var_dump($collection->get('color.bodyColor-900')->var());

        return [
            SectionNames::SCHEMA => 'https://schemas.wp.org/trunk/theme.json',
            SectionNames::VERSION => 1,
            SectionNames::SETTINGS => [
                'color' => [
                    'custom'    => true,
                    'link'      => true,
                    'palette'   => $collection->toArrayByCategory(Palette::CATEGORY),
                    'gradients' => $collection->toArrayByCategory(Gradient::CATEGORY),
                    'duotone'   => $collection->toArrayByCategory(Duotone::CATEGORY),
                ],
                'typography' => [
                    'customFontSize'    => true,
                    'customLineHeight'  => true,
                    'fontSizes'     => $collection->toArrayByCategory(FontSize::CATEGORY),
                    'fontFamilies'  => $collection->toArrayByCategory(FontFamily::CATEGORY),
                ],
                'spacing' => [
                    'blockGap'  => true,
                    'customMargin' => true,
                    'customPadding' => true,
                    'units' => [ '%', 'px', 'em', 'rem', 'vh', 'vw' ]
                ],
                'border' => [
                    'customColor'   => true,
                    'customRadius'  => true,
                    'customStyle'   => true,
                    'customWidth'   => true,
                ],
                'custom' => $collection->toArrayByCategory(Item::CATEGORY),
                "blocks" => [
                    "core/button" => [
                        "color" => [
                            'custom' => false,
//                          'palette' => [
//                              [
//                                  "slug" => "primary",
//                                  "color" => "#044c75",
//                                  "name" => "Primary"
//                              ]
//                          ],
                        ],
                    ],
                    "core/navigation" => [
                        "color" => [
                            'custom' => false,
                        ],
                    ],
                ],
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
                'color' => (new Color($collection))
                    ->background(self::COLOR_BASE)
                    ->text(self::COLOR_BODY_COLOR)
                    ->toArray(),
                'typography' => (new Typography($collection))
                    ->fontFamily(self::FONT_FAMILY_BASE)
                    ->fontSize(self::FONT_SIZE_BASE)
                    ->fontStyle('normal')
                    ->fontWeight('300')
                    ->letterSpacing('normal')
                    ->lineHeight(self::LINE_HEIGHT_M)
                    ->textDecoration('none')
                    ->textTransform('none')
                    ->toArray(),
                'spacing'   => [
                    'blockGap'  => $collection->get(self::SPACER_M)->var(),
                    /**
                     * For margin and padding we can write simply the shorthand
                     */
                    'margin'    => "0",
                    'padding'   => "0",
                ],

                /**
                 * ============================================
                 * Top level elements styles
                 * ============================================
                 */
                'elements' => [
                    'link' => [
                        'color' => (new Color($collection))
                            ->text(self::COLOR_LINK_TEXT)
                            ->background('transparent')
                            ->toArray(),
                    ],
                    'h1' => [
                        'typography' => (new Typography($collection))
                            ->fontFamily(self::FONT_FAMILY_BASE)
                            ->fontSize(self::FONT_SIZE_H1)
                            ->fontWeight('900')
                            ->lineHeight(self::LINE_HEIGHT_XS)
                            ->toArray(),
                        'spacing'   => [
                            'margin'    => (string) (new Spacing($collection))
                                ->top(self::SPACER_S)
                                ->bottom('0px'),
                        ],
                        'color' => (new Color($collection))
                            ->text(self::COLOR_HEADING_TEXT)
                            ->toArray(),
                    ],
                    'h2' => [
                        'typography' =>  (new Typography($collection))
                            ->fontFamily(self::FONT_FAMILY_BASE)
                            ->fontSize(self::FONT_SIZE_H2)
                            ->fontWeight('900')
                            ->lineHeight(self::LINE_HEIGHT_XS)
                            ->toArray(),
                        'spacing'   => [
                            'margin'    => (string) (new Spacing($collection))
                                ->top(self::SPACER_S)
                                ->bottom('0px'),
                        ],
                        'color' => (new Color($collection))
                            ->text(self::COLOR_HEADING_TEXT)
                            ->toArray(),
                    ],
                    'h3' => [
                        'typography' => (new Typography($collection))
                            ->fontFamily(self::FONT_FAMILY_BASE)
                            ->fontSize(self::FONT_SIZE_H3)
                            ->fontWeight('900')
                            ->lineHeight(self::LINE_HEIGHT_XS)
                            ->toArray(),
                        'spacing'   => [
                            'margin'    => (string) (new Spacing($collection))
                                ->top(self::SPACER_S)
                                ->bottom('0px'),
                        ],
                        'color' => (new Color($collection))
                            ->text(self::COLOR_HEADING_TEXT)
                            ->toArray(),
                    ],
                    'h4' => [
                        'typography' => (new Typography($collection))
                            ->fontFamily(self::FONT_FAMILY_BASE)
                            ->fontSize(self::FONT_SIZE_H4)
                            ->fontWeight('900')
                            ->lineHeight(self::LINE_HEIGHT_XS)
                            ->toArray(),
                        'spacing'   => [
                            'margin'    => (string) (new Spacing($collection))
                                ->top(self::SPACER_S)
                                ->bottom('0px'),
                        ],
                        'color' => (new Color($collection))
                            ->text(self::COLOR_HEADING_TEXT)
                            ->toArray(),
                    ],
                    'h5' => [
                        'typography' => (new Typography($collection))
                            ->fontFamily(self::FONT_FAMILY_BASE)
                            ->fontSize(self::FONT_SIZE_H5)
                            ->fontWeight('900')
                            ->lineHeight(self::LINE_HEIGHT_XS)
                            ->toArray(),
                        'spacing'   => [
                            'margin'    => (string) (new Spacing($collection))
                                ->top(self::SPACER_S)
                                ->bottom('0px'),
                        ],
                        'color' => (new Color($collection))
                            ->text(self::COLOR_HEADING_TEXT)
                            ->toArray(),
                    ],
                    'h6' => [
                        'typography' => (new Typography($collection))
                            ->fontFamily(self::FONT_FAMILY_BASE)
                            ->fontSize(self::FONT_SIZE_H6)
                            ->fontWeight('900')
                            ->lineHeight(self::LINE_HEIGHT_XS)
                            ->toArray(),
                        'spacing'   => [
                            'margin'    => (string) (new Spacing($collection))
                                ->top(self::SPACER_S)
                                ->bottom('0px'),
                        ],
                        'color' => (new Color($collection))
                            ->text(self::COLOR_HEADING_TEXT)
                            ->toArray(),
                    ],
                ],

                /**
                 * ============================================
                 * Blocks styles
                 * ============================================
                 */
                'blocks' => [

                    /**
                     * ============================================
                     * Blocks for titles
                     * ============================================
                     */
                    'core/site-title' => [
                        'color' => (new Color($collection))
                            ->text(self::COLOR_HEADING_TEXT)
                            ->toArray(),
                        'typography' => (new Typography($collection))
                            ->fontSize(self::FONT_SIZE_H1)
                            ->fontWeight('600')
                            ->toArray(),
                    ],
                    'core/post-title' => [ // .wp-block-post-title
                        'color' => (new Color($collection))
                            ->text(self::COLOR_HEADING_TEXT)
                            ->toArray(),
                        'typography' => (new Typography($collection))
                            ->fontSize(self::FONT_SIZE_H1)
                            ->toArray(),
                        'elements' => [
                            'link' => [ // .wp-block-post-title a
                                'color' => (new Color($collection))
                                    ->text('inherit')
                                    ->background('transparent')
                                    ->toArray(),
                            ],
                        ],
                    ],
                    /**
                     * Title for queried object {Archive page}
                     * <!-- wp:query-title {"type":"archive"} /-->
                     * .wp-block-query-title
                     */
                    'core/query-title' => [
                        'typography' => (new Typography($collection))
                            ->fontSize(self::FONT_SIZE_H5)
                            ->fontWeight('700')
                            ->toArray(),
                        'color' => (new Color($collection))
                            ->text(self::COLOR_GRAY_400)
                            ->toArray(),
                    ],
                    'core/term-description' => [ // .wp-block-term-description
                        'typography' => (new Typography($collection))
                            ->fontSize(self::FONT_SIZE_X_SMALL)
                            ->toArray(),
                        'spacing'   => [
                            'margin'    => (new Spacing())->shorthand(['0px !important'])->toArray(),
                        ],
                        'color' => (new Color($collection))
                            ->text(self::COLOR_GRAY_400)
                            ->toArray(),
                    ],

                    /**
                     * ============================================
                     * Blocks elements for images
                     * ============================================
                     */
                    'core/site-logo' => [ // wp-block-site-logo {figure element}
                        'spacing'   => [
                            'margin'    => (new Spacing())->shorthand(['0px'])->toArray(),
                            'padding'   => (new Spacing())->shorthand(['0px'])->toArray(),
                        ],
                    ],
                    'core/image' => [ // wp-block-image {figure element}
                        'spacing'   => [
                            'margin'    => (string) (new Spacing($collection))
                                ->top(self::SPACER_M)
                                ->bottom('0px'),
                        ],
                    ],
                    'core/post-featured-image' => [ // wp-block-post-featured-image {figure element}
                        'spacing'   => [
                            'margin'    => (string) (new Spacing($collection))
                                ->top(self::SPACER_M)
                                ->bottom('0'),
                        ],
                    ],
                    'core/gallery' => [ // wp-block-gallery {figure element}
                        'spacing'   => [
                            'margin'    => (string) (new Spacing($collection))
                                ->top(self::SPACER_M)
                                ->bottom('0'),
                        ],
                    ],

                    /**
                     * ============================================
                     * Blocks for content
                     * ============================================
                     */
                    'core/post-content' => [ // .wp-block-post-content
                        'color' => (new Color($collection))
                            ->text('inherit')
                            ->toArray(),
                    ],
                    'core/post-excerpt' => [ // .wp-block-post-content
                        'color' => (new Color($collection))
                            ->text('inherit')
                            ->toArray(),
                    ],

                    /**
                     * ============================================
                     * Blocks container
                     * ============================================
                     */
//                  'overblocks/container' => [
//                      'spacing'   => [
//                          'margin'    => '0',
//                      ],
//                  ],
//                  'core/columns' => [
//                      'spacing'   => [
//                          'margin'    => '0',
//                      ],
//                  ],
                    'core/template-part' => [
                        'spacing'   => [
                            'margin'    => '0 !important',
                            'padding'   => '0 !important',
                        ],
                    ],

                    /**
                     * ============================================
                     * Blocks elements in content
                     * ============================================
                     */
                    'core/paragraph' => [ // p
                        'spacing'   => [
                            'margin'    => (string) (new Spacing($collection))
                                ->top(self::SPACER_M)
                                ->bottom('0px'),
                        ],
                    ],
                    // p
//                  'core/list' => [
//                      'spacing'   => [
//                          'margin'    => (string) (new Spacing($collection))
//                                ->top(self::SPACER_M)
//                              ->bottom( '0px' ),
//                      ],
//                  ],
                    'core/button' => [ // .wp-block-button__link
                        'border' => (new Border($collection))
                            ->color(self::BUTTON_BORDER_COLOR)
                            ->radius(\sprintf(
                                'calc(%s/3)',
                                $collection->get(self::FONT_SIZE_BASE)->var()
                            ))
                            ->style('solid')
                            ->width('2px')
                            ->toArray(),
                        'color' => (new Color($collection))
                            ->background(self::BUTTON_BG)
                            ->text(self::BUTTON_TEXT)
                            ->toArray(),
                        'spacing'   => [
                            'padding' => (new Spacing($collection))
                                ->shorthand([self::BUTTON_PADDING])
                                ->toArray(),
                            'margin'    => (new Spacing($collection))
                                ->top(self::SPACER_M)
                                ->toArray(),
                        ],
                        'typography' => (new Typography($collection))
                            ->fontFamily(self::FONT_FAMILY_BASE)
                            ->fontSize(self::FONT_SIZE_BASE)
                            ->textDecoration('none')
                            ->textTransform('uppercase')
                            ->lineHeight(self::LINE_HEIGHT_S)
                            ->toArray(),
                    ],
                    'core/file' => [ // .wp-block-file
                        'spacing'   => [
                            'margin'    => (new Spacing($collection))
                                ->top(self::SPACER_M)
                                ->toArray(),
                        ],
                        'typography' => (new Typography($collection))
                            ->fontFamily(self::FONT_FAMILY_BASE)
                            ->fontSize(self::FONT_SIZE_BASE)
                            ->lineHeight(self::LINE_HEIGHT_S)
                            ->toArray(),
                        'elements' => [
                            'link' => [ // .wp-block-file a
                                'color' => (new Color($collection))
                                    ->text(self::COLOR_BASE)
                                    ->background('transparent')
                                    ->toArray(),
                            ],
                        ],
                    ],
                    'core/code' => [
                        'typography' => (new Typography($collection))
                            ->fontFamily(self::FONT_FAMILY_MONOSPACE)
                            ->toArray(),
                        'spacing' => [
                            'margin'    => (new Spacing($collection))
                                ->top(self::SPACER_L)
                                ->toArray(),
                            'padding' => (new Spacing($collection))
                                ->shorthand([self::SPACER_V, self::SPACER_H])
                                ->toArray(),
                        ],
                        'border' => (new Border($collection))
                            ->color(self::COLOR_BORDER)
                            ->radius('0px')
                            ->style('solid')
                            ->width('1px')
                            ->toArray(),
                    ],
                    'core/quote' => [
                        'border' => (new Border($collection))
                            ->color(self::COLOR_BODY_COLOR)
                            ->style('solid')
                            ->width('0 0 0 1px')
                            ->toArray(),
                        'spacing' => [
                            'margin'    => (new Spacing($collection))
                                ->top(self::SPACER_L)
                                ->toArray(),
                            'padding'   => (new Spacing($collection))
                                ->top(self::SPACER_H)
                                ->toArray(),
                        ],
                        'typography' => (new Typography($collection))
                            ->fontSize(self::FONT_SIZE_BASE)
                            ->fontStyle('normal')
                            ->toArray(),
                    ],

                    /**
                     * ============================================
                     * Blocks for post meta elements
                     * ============================================
                     */
                    'core/post-date' => [
                        'color' => (new Color($collection))
                            ->text(self::COLOR_GRAY_200)
                            ->toArray(),
                        'typography' => (new Typography($collection))
                            ->fontSize(self::FONT_SIZE_X_SMALL)
                            ->toArray(),
                    ],

                    'core/post-terms' => [
                        'color' => (new Color($collection))
                            ->text(self::COLOR_GRAY_200)
                            ->toArray(),
                        'typography' => (new Typography($collection))
                            ->fontSize(self::FONT_SIZE_X_SMALL)
                            ->toArray(),
                        'elements' => [
                            'link' => [ // .wp-block-file a
                                'color' => (new Color($collection))
                                    ->text(self::COLOR_GRAY_200)
                                    ->background('transparent')
                                    ->toArray(),
                                'typography' => (new Typography($collection))
                                    ->textDecoration('none')
                                    ->toArray(),
                            ],
                        ],
                    ],

                    'core/post-author' => [
                        'border' => (new Border($collection))
                            ->color(self::COLOR_GRAY_700)
                            ->style('solid')
                            ->width('1px')
                            ->toArray(),
                        'color' => (new Color($collection))
                            ->text(self::COLOR_BODY_COLOR)
                            ->background(self::COLOR_GRAY_900)
                            ->toArray(),
                        'typography' => (new Typography($collection))
                            ->fontSize(self::FONT_SIZE_SMALL)
                            ->toArray(),
                        'spacing'   => [
//                          'margin'    => (string) (new Spacing($collection))
//                                ->top(self::SPACER_M)
                            'padding'   => (new Spacing($collection))
                                ->shorthand([self::SPACER_M])
                                ->toArray(),
                        ],
                    ],

                    /**
                     * ============================================
                     * Blocks for post comments
                     * ============================================
                     */
                    'core/post-comments' => [
                        'color' => (new Color($collection))
                            ->text(self::COLOR_BODY_COLOR)
                            ->toArray(),
                        'typography' => (new Typography($collection))
                            ->fontSize(self::FONT_SIZE_BASE)
                            ->fontWeight('300')
                            ->toArray(),
                    ],
//                  'core/post-comments-form' => [
//                      'color' => (new Color($collection))
//                          ->text(self::COLOR_BODY_COLOR)
//                          ->toArray(),
//                      'typography' => (new Typography($collection))
//                          ->fontSize(self::FONT_SIZE_BASE)
//                          ->fontWeight( '300' )
//                          ->toArray(),
//                  ],

                    /**
                     * <!-- wp:spacer -->
                     * <div style="height:100px" aria-hidden="true" class="wp-block-spacer"></div>
                     * <!-- /wp:spacer -->
                     */
                    'core/spacer' => [ // .wp-block-spacer
                        'color' => (new Color($collection))
                            ->text(self::COLOR_BODY_COLOR)
                            ->toArray(),
                        'border' => (new Border($collection))
                            ->color('currentColor')
                            ->style('solid')
                            ->width('0 0 0 0')
                            ->toArray(),
                    ],

                    /**
                     * <!-- wp:separator -->
                     * <hr class="wp-block-separator"/>
                     * <!-- /wp:separator -->
                     */
                    'core/separator' => [ // .wp-block-separator
//                      'color' => (new Color($collection))
//                          ->text( $palette->varOf('gray-700') )
//                          ->toArray(),
                        'border' => (new Border($collection))
                            ->color(self::COLOR_GRAY_700)
                            ->style('solid')
                            ->width('0 0 1px 0')
                            ->toArray(),
                    ],

//                  'core/query' => [
//                      'elements' => [
//                      ],
//                  ],

                    /**
                     * ============================================
                     * Blocks at site level
                     * ============================================
                     */
                    'core/site-tagline' => [
                        'color' => (new Color($collection))
                            ->text(self::COLOR_BODY_COLOR)
                            ->toArray(),
                        'typography' => (new Typography($collection))
                            ->fontSize(self::FONT_SIZE_H3)
                            ->fontWeight('600')
                            ->toArray(),
                    ],
                    'core/navigation' => [ // .wp-block-navigation
                        'color' => (new Color($collection))
                            ->text(self::COLOR_BODY_COLOR)
                            ->background(self::COLOR_BODY_BG)
                            ->toArray(),
                        'spacing'   => [
                            'padding'   => (new Spacing())->vertical('1.1rem')->toArray(),
                        ],
                        'typography' => (new Typography($collection))
                            ->fontSize(self::FONT_SIZE_X_SMALL)
                            ->fontWeight('400')
                            ->textTransform('uppercase')
                            ->toArray(),
//                      'elements' => [
//                          'link' => [ // .wp-block-navigation a
//                              'color' => (new Color($collection))
//                                  ->text( $palette->varOf( 'base' ) )
//                                  ->background( 'transparent' )
//                                  ->toArray(),
//                          ],
//                      ],
                    ],
//                  'core/navigation-link' => [ // .wp-block-navigation-link
//                      'color' => (new Color($collection))
////                            ->text(self::COLOR_BODY_COLOR)
//                          ->toArray(),
//                  ],
//                  'core/navigation-submenu' => [ // .wp-block-navigation
//                      'color' => (new Color($collection))
////                            ->text(self::COLOR_BODY_COLOR)
//                          ->toArray(),
//                  ],
                ],
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
        ];
    }
}
