<?php

declare(strict_types=1);

use ItalyStrap\ThemeJsonGenerator\Application\Config\Blueprint;
use ItalyStrap\ThemeJsonGenerator\Domain\Input\SectionNames;
use ItalyStrap\ThemeJsonGenerator\Domain\Input\Settings\PresetsInterface;
use Psr\Container\ContainerInterface;

return static function (ContainerInterface $container, PresetsInterface $collection, Blueprint $blueprint) {

	$blueprint->merge([
        SectionNames::SCHEMA => 'https://schemas.wp.org/trunk/theme.json',
        SectionNames::VERSION => 2,
        SectionNames::TITLE => 'Experimental Theme',
        SectionNames::DESCRIPTION => 'Experimental Theme',
        SectionNames::SETTINGS => [
            'color' => [
                'custom' => true,
                'link' => true,
                'palette' => [
                    [
                        'slug' => 'base',
                        'name' => 'Brand base color',
                        'color' => 'hsla(212,73%,55%,1)',
                    ],
                    [
                        'slug' => 'light',
                        'name' => 'Lighter color',
                        'color' => 'hsla(0,0%,100%,1)',
                    ],
                    [
                        'slug' => 'dark',
                        'name' => 'Darker color',
                        'color' => 'hsla(0,0%,0%,1)',
                    ],
                    [
                        'slug' => 'bodyBg',
                        'name' => 'Color for body background',
                        'color' => 'hsla(0,0%,100%,1)',
                    ],
                    [
                        'slug' => 'bodyColor',
                        'name' => 'Color for text',
                        'color' => 'hsla(0,0%,0%,1)',
                    ],
                    [
                        'slug' => 'headingColor',
                        'name' => 'Color for headings',
                        'color' => 'hsla(0,0%,20%,1)',
                    ],
                    [
                        'slug' => 'linkColor',
                        'name' => 'Color for links',
                        'color' => 'hsla(212,73%,55%,1)',
                    ],
                    [
                        'slug' => 'buttonBgHover',
                        'name' => 'Color for button background on hover',
                        'color' => 'hsla(212,73%,35%,1)',
                    ],
                    [
                        'slug' => 'buttonTextHover',
                        'name' => 'Color for button text on hover',
                        'color' => 'hsla(0,0%,90%,1)',
                    ],
                    [
                        'slug' => 'borderColor',
                        'name' => 'Color for borders',
                        'color' => 'hsla(0,0%,80%,1)',
                    ],
                    [
                        'slug' => 'baseDark',
                        'name' => 'Darker Brand base color',
                        'color' => 'hsla(212,73%,35%,1)',
                    ],
                    [
                        'slug' => 'baseLight',
                        'name' => 'Lighter Brand base color',
                        'color' => 'hsla(212,73%,75%,1)',
                    ],
                    [
                        'slug' => 'baseComplementary',
                        'name' => 'Brand base complementary color',
                        'color' => 'hsla(604,73%,55%,1)',
                    ],
                    [
                        'slug' => 'infoColor',
                        'name' => 'Info color',
                        'color' => 'hsla(212,73%,55%,1)',
                    ],
                    [
                        'slug' => 'successColor',
                        'name' => 'Success color',
                        'color' => 'hsla(130,73%,55%,1)',
                    ],
                    [
                        'slug' => 'warningColor',
                        'name' => 'Warning color',
                        'color' => 'hsla(40,73%,55%,1)',
                    ],
                    [
                        'slug' => 'dangerColor',
                        'name' => 'Danger color',
                        'color' => 'hsla(0,73%,55%,1)',
                    ],
                    [
                        'slug' => 'base-100',
                        'name' => 'Shade of Base by 10%',
                        'color' => 'hsla(212,73%,45%,1)',
                    ],
                    [
                        'slug' => 'base-200',
                        'name' => 'Shade of Base by 20%',
                        'color' => 'hsla(212,73%,35%,1)',
                    ],
                    [
                        'slug' => 'base-300',
                        'name' => 'Shade of Base by 30%',
                        'color' => 'hsla(212,73%,25%,1)',
                    ],
                    [
                        'slug' => 'base-400',
                        'name' => 'Shade of Base by 40%',
                        'color' => 'hsla(212,73%,15%,1)',
                    ],
                    [
                        'slug' => 'base-500',
                        'name' => 'Shade of Base by 50%',
                        'color' => 'hsla(212,73%,5%,1)',
                    ],
                    [
                        'slug' => 'bodyColor-100',
                        'name' => 'Shade of BodyColor by 10%',
                        'color' => 'hsla(0,0%,10%,1)',
                    ],
                    [
                        'slug' => 'bodyColor-200',
                        'name' => 'Shade of BodyColor by 20%',
                        'color' => 'hsla(0,0%,20%,1)',
                    ],
                    [
                        'slug' => 'bodyColor-300',
                        'name' => 'Shade of BodyColor by 30%',
                        'color' => 'hsla(0,0%,30%,1)',
                    ],
                    [
                        'slug' => 'bodyColor-400',
                        'name' => 'Shade of BodyColor by 40%',
                        'color' => 'hsla(0,0%,40%,1)',
                    ],
                    [
                        'slug' => 'bodyColor-500',
                        'name' => 'Shade of BodyColor by 50%',
                        'color' => 'hsla(0,0%,50%,1)',
                    ],
                    [
                        'slug' => 'bodyColor-600',
                        'name' => 'Shade of BodyColor by 60%',
                        'color' => 'hsla(0,0%,60%,1)',
                    ],
                    [
                        'slug' => 'bodyColor-700',
                        'name' => 'Shade of BodyColor by 70%',
                        'color' => 'hsla(0,0%,70%,1)',
                    ],
                    [
                        'slug' => 'bodyColor-800',
                        'name' => 'Shade of BodyColor by 80%',
                        'color' => 'hsla(0,0%,80%,1)',
                    ],
                    [
                        'slug' => 'bodyColor-900',
                        'name' => 'Shade of BodyColor by 90%',
                        'color' => 'hsla(0,0%,90%,1)',
                    ],
                ],
                'gradients' => [
                    [
                        'slug' => 'light-to-dark',
                        'name' => 'Black to white',
                        'gradient' => 'linear-gradient(160deg, var(--wp--preset--color--light), var(--wp--preset--color--dark))',
                    ],
                    [
                        'slug' => 'base-to-white',
                        'name' => 'Base to white',
                        'gradient' => 'linear-gradient(135deg, var(--wp--preset--color--base), var(--wp--preset--color--base-dark))',
                    ],
                ],
                'duotone' => [
                    [
                        'slug' => 'black-to-white',
                        'name' => 'Black to White',
                        'colors' => [
                            'rgba(0,0,0,1.00)',
                            'rgba(255,255,255,1.00)',
                        ],
                    ],
                    [
                        'slug' => 'white-to-black',
                        'name' => 'White to Black',
                        'colors' => [
                            'rgba(255,255,255,1.00)',
                            'rgba(0,0,0,1.00)',
                        ],
                    ],
                    [
                        'slug' => 'base-to-white',
                        'name' => 'Base to White',
                        'colors' => [
                            'rgba(56,135,224,1.00)',
                            'rgba(255,255,255,1.00)',
                        ],
                    ],
                    [
                        'slug' => 'base-to-black',
                        'name' => 'Base to Black',
                        'colors' => [
                            'rgba(56,135,224,1.00)',
                            'rgba(0,0,0,1.00)',
                        ],
                    ],
                ],
            ],
            'typography' => [
                'customFontSize' => true,
                'fontSizes' => [
                    [
                        'slug' => 'base',
                        'name' => 'Base font size 16px',
                        'size' => 'clamp(1rem, 2vw, 1.5rem)',
                    ],
                    [
                        'slug' => 'h1',
                        'name' => 'Used in H1 titles',
                        'size' => 'calc( var(--wp--preset--font-size--base) * 2.8125)',
                    ],
                    [
                        'slug' => 'h2',
                        'name' => 'Used in H2 titles',
                        'size' => 'calc( var(--wp--preset--font-size--base) * 2.1875)',
                    ],
                    [
                        'slug' => 'h3',
                        'name' => 'Used in H3 titles',
                        'size' => 'calc( var(--wp--preset--font-size--base) * 1.625)',
                    ],
                    [
                        'slug' => 'h4',
                        'name' => 'Used in H4 titles',
                        'size' => 'calc( var(--wp--preset--font-size--base) * 1.5)',
                    ],
                    [
                        'slug' => 'h5',
                        'name' => 'Used in H5 titles',
                        'size' => 'calc( var(--wp--preset--font-size--base) * 1.125)',
                    ],
                    [
                        'slug' => 'h6',
                        'name' => 'Used in H6 titles',
                        'size' => 'var(--wp--preset--font-size--base)',
                    ],
                    [
                        'slug' => 'small',
                        'name' => 'Small font size',
                        'size' => 'calc( var(--wp--preset--font-size--base) * 0.875)',
                    ],
                    [
                        'slug' => 'x-small',
                        'name' => 'Extra Small font size',
                        'size' => 'calc( var(--wp--preset--font-size--base) * 0.75)',
                    ],
                ],
                'fontFamilies' => [
                    [
                        'slug' => 'base',
                        'name' => 'Default font family',
                        'fontFamily' => 'system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", "Liberation Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji"',
                    ],
                    [
                        'slug' => 'monospace',
                        'name' => 'Font family for code',
                        'fontFamily' => 'SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace',
                    ],
                ],
            ],
            'spacing' => [
                'blockGap' => true,
                'units' => [
                    '%',
                    'px',
                    'em',
                    'rem',
                    'vh',
                    'vw',
                ],
            ],
            'blocks' => [
                'core/button' => [
                    'color' => [
                        'custom' => false,
                    ],
                ],
                'core/navigation' => [
                    'color' => [
                        'custom' => false,
                    ],
                ],
            ],
            'layout' => [
                'contentSize' => 'var(--wp--custom--content-size)',
                'wideSize' => 'var(--wp--custom--wide-size)',
            ],
            'custom' => [
                'contentSize' => 'clamp(16rem, 60vw, 60rem)',
                'wideSize' => 'clamp(16rem, 85vw, 70rem)',
                'baseFontSize' => '1rem',
                'spacer' => [
                    'base' => '1rem',
                    'v' => 'calc( var(--wp--custom--spacer--base) * 4 )',
                    'h' => 'calc( var(--wp--custom--spacer--base) * 4 )',
                    's' => 'calc( var(--wp--custom--spacer--base) / 1.5 )',
                    'm' => 'calc( var(--wp--custom--spacer--base) * 2 )',
                    'l' => 'calc( var(--wp--custom--spacer--base) * 3 )',
                    'xl' => 'calc( var(--wp--custom--spacer--base) * 4 )',
                ],
                'lineHeight' => [
                    'base' => '1.5',
                    'xs' => '1.1',
                    's' => '1.3',
                    'm' => 'var(--wp--custom--line-height--base)',
                    'l' => '1.7',
                ],
                'body' => [
                    'bg' => 'var(--wp--preset--color--base)',
                    'text' => 'var(--wp--preset--color--body-bg)',
                ],
                'link' => [
                    'bg' => 'var(--wp--preset--color--base)',
                    'text' => 'var(--wp--preset--color--body-bg)',
                    'decoration' => 'underline',
                    'hover' => [
                        'text' => 'var(--wp--preset--color--body-color)',
                        'decoration' => 'underline',
                    ],
                ],
                'button' => [
                    'bg' => 'var(--wp--preset--color--base)',
                    'text' => 'var(--wp--preset--color--button-text-hover)',
                    'borderColor' => 'transparent',
                    'borderRadius' => 'calc(var(--wp--preset--font-size--base) / 3)',
                    'hover' => [
                        'bg' => 'var(--wp--preset--color--button-bg-hover)',
                        'text' => 'var(--wp--preset--color--button-text-hover)',
                        'borderColor' => 'transparent',
                    ],
                    'padding' => [
                        'h' => '0.75em',
                        'v' => '0.375em',
                    ],
                ],
                'form' => [
                    'border' => [
                        'color' => '',
                        'width' => '',
                    ],
                    'input' => [
                        'color' => '',
                    ],
                ],
                'navbar' => [
                    'min' => [
                        'height' => 'calc( var(--wp--custom--spacer--base) * 5.3125 )',
                    ],
                ],
            ],
        ],
        SectionNames::STYLES => [
            'color' => [
                'background' => 'var(--wp--preset--color--body-bg)',
                'text' => 'var(--wp--preset--color--body-color)',
            ],
            'typography' => [
                'fontFamily' => 'var(--wp--preset--font-family--base)',
                'fontSize' => 'var(--wp--preset--font-size--base)',
                'fontStyle' => 'normal',
                'fontWeight' => '400',
                'letterSpacing' => 'normal',
                'lineHeight' => 'var(--wp--custom--line-height--m)',
                'textDecoration' => 'none',
                'textTransform' => 'none',
            ],
            'spacing' => [
                'blockGap' => 'var(--wp--custom--spacer--m)',
                'margin' => [
                    'top' => '0px',
                    'right' => '0px',
                    'bottom' => '0px',
                    'left' => '0px',
                ],
                'padding' => [
                    'top' => '0px',
                    'right' => '0px',
                    'bottom' => '0px',
                    'left' => '0px',
                ],
            ],
            'elements' => [
                'link' => [
                    'color' => [
                        'text' => 'var(--wp--preset--color--link-color)',
                        'background' => 'transparent',
                    ],
                ],
                'h1' => [
                    'typography' => [
                        'fontSize' => 'var(--wp--preset--font-size--h-1)',
                    ],
                ],
                'h2' => [
                    'typography' => [
                        'fontSize' => 'var(--wp--preset--font-size--h-2)',
                    ],
                ],
                'h3' => [
                    'typography' => [
                        'fontSize' => 'var(--wp--preset--font-size--h-3)',
                    ],
                ],
                'h4' => [
                    'typography' => [
                        'fontSize' => 'var(--wp--preset--font-size--h-4)',
                    ],
                ],
                'h5' => [
                    'typography' => [
                        'fontSize' => 'var(--wp--preset--font-size--h-5)',
                    ],
                ],
                'h6' => [
                    'typography' => [
                        'fontSize' => 'var(--wp--preset--font-size--h-6)',
                    ],
                ],
                'heading' => [
                    'typography' => [
                        'fontFamily' => 'var(--wp--preset--font-family--base)',
                        'fontWeight' => '700',
                        'lineHeight' => 'var(--wp--custom--line-height--xs)',
                    ],
                    'spacing' => [
                        'margin' => [
                            'top' => 'var(--wp--custom--spacer--s)',
                            'bottom' => '0',
                        ],
                    ],
                    'color' => [
                        'text' => 'var(--wp--preset--color--heading-color)',
                    ],
                ],
                'button' => [
                    'border' => [
                        'color' => 'var(--wp--custom--button--border-color)',
                        'radius' => 'var(--wp--custom--button--border-radius)',
                        'style' => 'solid',
                        'width' => '1px',
                    ],
                    'color' => [
                        'background' => 'var(--wp--custom--button--bg)',
                        'text' => 'var(--wp--custom--button--text)',
                    ],
                    'spacing' => [
                        'padding' => [
                            'top' => 'var(--wp--custom--button--padding--v)',
                            'bottom' => 'var(--wp--custom--button--padding--v)',
                            'right' => 'var(--wp--custom--button--padding--h)',
                            'left' => 'var(--wp--custom--button--padding--h)',
                        ],
                    ],
                    'typography' => [
                        'fontFamily' => 'var(--wp--preset--font-family--base)',
                        'fontSize' => 'var(--wp--preset--font-size--base)',
                        'textDecoration' => 'none',
                        'lineHeight' => 'var(--wp--custom--line-height--s)',
                    ],
                    ':hover' => [
                        'color' => [
                            'background' => 'var(--wp--custom--button--hover--bg)',
                            'text' => 'var(--wp--custom--button--hover--text)',
                        ],
                        'border' => [
                            'color' => [
                                'background' => 'var(--wp--custom--button--hover--bg)',
                                'text' => 'var(--wp--custom--button--hover--border-color)',
                            ],
                        ],
                    ],
                    ':focus' => [
                        'color' => [
                            'background' => 'var(--wp--custom--button--hover--bg)',
                            'text' => 'var(--wp--custom--button--hover--border-color)',
                        ],
                        'border' => [
                            'color' => [
                                'background' => 'var(--wp--custom--button--hover--bg)',
                                'text' => 'var(--wp--custom--button--hover--border-color)',
                            ],
                        ],
                        'outline' => [
                            'color' => 'var(--wp--preset--color--body-color-300)',
                            'offset' => '1px',
                            'style' => 'dotted',
                            'width' => '1px',
                        ],
                    ],
                    ':active' => [
                        'color' => [
                            'background' => 'var(--wp--custom--button--hover--bg)',
                            'text' => 'var(--wp--custom--button--hover--border-color)',
                        ],
                        'border' => [
                            'color' => [
                                'background' => 'var(--wp--custom--button--hover--bg)',
                                'text' => 'var(--wp--custom--button--hover--border-color)',
                            ],
                        ],
                    ],
                ],
            ],
            'blocks' => [
                'core/term-description' => [
                    'typography' => [
                        'fontSize' => 'var(--wp--preset--font-size--x-small)',
                    ],
                    'spacing' => [
                        'margin' => [
                            'top' => '0px !important',
                            'right' => '0px !important',
                            'bottom' => '0px !important',
                            'left' => '0px !important',
                        ],
                    ],
                    'color' => [
                        'text' => 'var(--wp--preset--color--body-color-400)',
                    ],
                ],
                'core/site-logo' => [
                    'spacing' => [
                        'margin' => [
                            'top' => '0px',
                            'right' => '0px',
                            'bottom' => '0px',
                            'left' => '0px',
                        ],
                        'padding' => [
                            'top' => '0px',
                            'right' => '0px',
                            'bottom' => '0px',
                            'left' => '0px',
                        ],
                    ],
                ],
                'core/image' => [
                    'spacing' => [
                        'margin' => [
                            'top' => 'var(--wp--custom--spacer--m)',
                            'bottom' => '0px',
                        ],
                    ],
                ],
                'core/post-featured-image' => [
                    'spacing' => [
                        'margin' => [
                            'top' => 'var(--wp--custom--spacer--m)',
                            'bottom' => '0',
                        ],
                    ],
                ],
                'core/gallery' => [
                    'spacing' => [
                        'margin' => [
                            'top' => 'var(--wp--custom--spacer--m)',
                            'bottom' => '0',
                        ],
                    ],
                ],
                'core/post-content' => [
                    'color' => [
                        'text' => 'inherit',
                    ],
                ],
                'core/post-excerpt' => [
                    'color' => [
                        'text' => 'inherit',
                    ],
                ],
                'core/template-part' => [
                    'spacing' => [
                        'margin' => [
                            'top' => '0 !important',
                            'right' => '0 !important',
                            'bottom' => '0 !important',
                            'left' => '0 !important',
                        ],
                        'padding' => [
                            'top' => '0 !important',
                            'right' => '0 !important',
                            'bottom' => '0 !important',
                            'left' => '0 !important',
                        ],
                    ],
                ],
                'core/paragraph' => [
                    'spacing' => [
                        'margin' => [
                            'top' => 'var(--wp--custom--spacer--m)',
                            'bottom' => '0px',
                        ],
                    ],
                ],
                'core/file' => [
                    'spacing' => [
                        'margin' => [
                            'top' => 'var(--wp--custom--spacer--m)',
                        ],
                    ],
                    'typography' => [
                        'fontFamily' => 'var(--wp--preset--font-family--base)',
                        'fontSize' => 'var(--wp--preset--font-size--base)',
                        'lineHeight' => 'var(--wp--custom--line-height--s)',
                    ],
                    'elements' => [
                        'link' => [
                            'color' => [
                                'text' => 'var(--wp--preset--color--base)',
                                'background' => 'transparent',
                            ],
                        ],
                    ],
                ],
                'core/code' => [
                    'typography' => [
                        'fontFamily' => 'var(--wp--preset--font-family--monospace)',
                    ],
                    'spacing' => [
                        'margin' => [
                            'top' => 'var(--wp--custom--spacer--l)',
                        ],
                        'padding' => [
                            'top' => 'var(--wp--custom--spacer--v)',
                            'right' => 'var(--wp--custom--spacer--h)',
                            'bottom' => 'var(--wp--custom--spacer--v)',
                            'left' => 'var(--wp--custom--spacer--h)',
                        ],
                    ],
                    'border' => [
                        'color' => 'var(--wp--preset--color--border-color)',
                        'radius' => '0px',
                        'style' => 'solid',
                        'width' => '1px',
                    ],
                ],
                'core/quote' => [
                    'border' => [
                        'color' => 'var(--wp--preset--color--body-color)',
                        'style' => 'solid',
                        'width' => '0 0 0 1px',
                    ],
                    'spacing' => [
                        'margin' => [
                            'top' => 'var(--wp--custom--spacer--l)',
                        ],
                        'padding' => [
                            'top' => 'var(--wp--custom--spacer--h)',
                        ],
                    ],
                    'typography' => [
                        'fontSize' => 'var(--wp--preset--font-size--base)',
                        'fontStyle' => 'normal',
                    ],
                ],
                'core/post-date' => [
                    'color' => [
                        'text' => 'var(--wp--preset--color--body-color-200)',
                    ],
                    'typography' => [
                        'fontSize' => 'var(--wp--preset--font-size--x-small)',
                    ],
                ],
                'core/post-terms' => [
                    'color' => [
                        'text' => 'var(--wp--preset--color--body-color-200)',
                    ],
                    'typography' => [
                        'fontSize' => 'var(--wp--preset--font-size--x-small)',
                    ],
                    'elements' => [
                        'link' => [
                            'color' => [
                                'text' => 'var(--wp--preset--color--body-color-200)',
                                'background' => 'transparent',
                            ],
                            'typography' => [
                                'textDecoration' => 'none',
                            ],
                        ],
                    ],
                ],
                'core/post-author' => [
                    'border' => [
                        'color' => 'var(--wp--preset--color--body-color-700)',
                        'style' => 'solid',
                        'width' => '1px',
                    ],
                    'color' => [
                        'text' => 'var(--wp--preset--color--body-color)',
                        'background' => 'var(--wp--preset--color--body-color-900)',
                    ],
                    'typography' => [
                        'fontSize' => 'var(--wp--preset--font-size--small)',
                    ],
                    'spacing' => [
                        'padding' => [
                            'top' => 'var(--wp--custom--spacer--m)',
                            'right' => 'var(--wp--custom--spacer--m)',
                            'bottom' => 'var(--wp--custom--spacer--m)',
                            'left' => 'var(--wp--custom--spacer--m)',
                        ],
                    ],
                ],
                'core/post-comments' => [
                    'color' => [
                        'text' => 'var(--wp--preset--color--body-color)',
                    ],
                    'typography' => [
                        'fontSize' => 'var(--wp--preset--font-size--base)',
                        'fontWeight' => '300',
                    ],
                ],
                'core/spacer' => [
                    'color' => [
                        'text' => 'var(--wp--preset--color--body-color)',
                    ],
                    'border' => [
                        'color' => 'currentColor',
                        'style' => 'solid',
                        'width' => '0 0 0 0',
                    ],
                ],
                'core/separator' => [
                    'border' => [
                        'color' => 'var(--wp--preset--color--body-color-700)',
                        'style' => 'solid',
                        'width' => '0 0 1px 0',
                    ],
                ],
                'core/site-tagline' => [
                    'color' => [
                        'text' => 'var(--wp--preset--color--body-color)',
                    ],
                    'typography' => [
                        'fontSize' => 'var(--wp--preset--font-size--h-3)',
                        'fontWeight' => '600',
                    ],
                ],
                'core/navigation' => [
                    'color' => [
                        'text' => 'var(--wp--preset--color--body-color)',
                        'background' => 'var(--wp--preset--color--body-bg)',
                    ],
                    'spacing' => [
                        'padding' => [
                            'top' => '1.1rem',
                            'bottom' => '1.1rem',
                        ],
                    ],
                    'typography' => [
                        'fontSize' => 'var(--wp--preset--font-size--x-small)',
                        'fontWeight' => '400',
                        'textTransform' => 'uppercase',
                    ],
                ],
                'core/site-title' => [
                    'color' => [
                        'text' => 'var(--wp--preset--color--heading-color)',
                    ],
                    'typography' => [
                        'fontSize' => 'var(--wp--preset--font-size--h-1)',
                        'fontWeight' => '600',
                    ],
                ],
                'core/post-title' => [
                    'color' => [
                        'text' => 'var(--wp--preset--color--heading-color)',
                    ],
                    'typography' => [
                        'fontSize' => 'var(--wp--preset--font-size--h-1)',
                    ],
                    'elements' => [
                        'link' => [
                            'color' => [
                                'text' => 'inherit',
                                'background' => 'transparent',
                            ],
                        ],
                    ],
                ],
                'core/query-title' => [
                    'color' => [
                        'text' => 'var(--wp--preset--color--body-color-400)',
                    ],
                    'typography' => [
                        'fontSize' => 'var(--wp--preset--font-size--h-5)',
                        'fontWeight' => '700',
                    ],
                ],
                'core/button' => [
                    'variations' => [
                        'outline' => [
                            'border' => [
                                'color' => 'var(--wp--preset--color--base)',
                                'radius' => 'var(--wp--custom--button--border-radius)',
                                'style' => 'solid',
                                'width' => '1px',
                            ],
                            'color' => [
                                'background' => 'var(--wp--preset--color--body-bg)',
                                'text' => 'var(--wp--preset--color--base)',
                            ],
                            'spacing' => [
                                'padding' => [
                                    'top' => 'var(--wp--custom--button--padding--v)',
                                    'bottom' => 'var(--wp--custom--button--padding--v)',
                                    'right' => 'var(--wp--custom--button--padding--h)',
                                    'left' => 'var(--wp--custom--button--padding--h)',
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ],
        SectionNames::TEMPLATE_PARTS => [
            [
                'name' => 'header',
                'area' => 'header',
            ],
            [
                'name' => 'singular-header',
                'area' => 'header',
            ],
            [
                'name' => 'footer',
                'area' => 'footer',
            ],
        ],
        SectionNames::CUSTOM_TEMPLATES => [
            [
                'name' => 'blank',
                SectionNames::TITLE => 'Blank',
                'postTypes' => [
                    'page',
                    'post',
                ],
            ],
        ],
    ]);
};
