<?php
declare(strict_types=1);

namespace ItalyStrap\ExperimentalTheme;

use Spatie\Color\Factory;

final class JsonData {

	public static function getJsonData(): array {
//		return [];

		$color_background = Factory::fromString('#ffffff');
		$color_text = Factory::fromString('#000000');
		$color_base = Factory::fromString('#3986E0');
		$border_color = Factory::fromString('#cccccc');

		$palette = new Preset(
			[
				[
					"slug" => "text",
					"color" => (string) $color_text->toRgba(),
					"name" => "Black for text, headings, links"
				],
				[
					"slug" => "background",
					"color" => (string) $color_background->toRgba(), // --wp--preset--color--background
					"name" => "White for body background"
				],
				[
					"slug" => "base",
					"color" => (string) $color_base->toRgba(),
					"name" => "Brand base color"
				],
			],
			'color'
		);

		$gradient = new Preset(
			[
				[
					"slug"		=> "black-to-white",
					"gradient"	=> \sprintf(
						'linear-gradient(160deg,%s,%s)',
						'{{color.text}}',
						'{{color.background}}'
					),
					"name"		=> "Black to white"
				],
			],
			'gradient'
		);

		$gradient->withCollection( $palette );

		$font_sizes = new Preset(
			[
				[
					"slug" => "base",
					"size" => "20px",
					"name" => "Base font size 16px"
				],
				[
					"slug" => "h1",
					"size" => "calc({{base}} * 2.5)",
					"name" => "Used in H1 titles"
				],
				[
					"slug" => "h2",
					"size" => "calc({{base}} * 2)",
					"name" => "Used in H2 titles"
				],
				[
					"slug" => "h3",
					"size" => "calc({{base}} * 1.75)",
					"name" => "Used in H3 titles"
				],
				[
					"slug" => "h4",
					"size" => "calc({{base}} * 1.5)",
					"name" => "Used in H4 titles"
				],
				[
					"slug" => "h5",
					"size" => "calc({{base}} * 1.25)",
					"name" => "Used in H5 titles"
				],
				[
					"slug" => "h6",
					"size" => "{{base}}",
					"name" => "Used in H6 titles"
				],
			],
			'fontSize',
			'size'
		);

		$font_family = new Preset(
			[
				[
					'fontFamily' => 'system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", "Liberation Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji"',
					'slug' => "base",
					"name" => "Default font family",
				],
				[
					'fontFamily' => 'SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace',
					'slug' => "monospace",
					"name" => "Font family for code",
				],
			],
			'fontFamily'
		);

		return [
			'version' => 1,
			'settings' => [
				'color' => [
					'custom'	=> true,
					'link'		=> true,
					'palette'	=> $palette->toArray(),
					'gradients'	=> $gradient->toArray(),
					'duotone'	=> [
						[
							'colors' => [
								(string) $color_text->toHex(),
								(string) $color_background->toHex(),
							],
							"slug" => "black-to-white",
							"name" => "Black to White"
						],
						[
							'colors' => [
								(string) $color_base->toHex(),
								(string) $color_background->toHex(),
							],
							"slug" => "base-to-white",
							"name" => "base-to-white"
						],
						[
							'colors' => [
								(string) $color_text->toRgba(),
								(string) $color_base->toHex(),
							],
							"slug" => "black-to-base",
							"name" => "black-to-base"
						],
						[
							'colors' => [
								(string) $color_base->toHex(),
								(string) $color_text->toRgba(),
							],
							"slug" => "base-to-black",
							"name" => "base-to-black"
						],
					],
				],
				'typography' => [
					'customFontSize'	=> true,
					'customLineHeight'	=> true,
					'fontSizes'			=> $font_sizes->toArray(),
					'fontFamilies'		=> $font_family->toArray(),
				],
				'spacing' => [
					'customMargin' => true,
					'customPadding' => true,
					'units' => [ 'px', 'em', 'rem', 'vh', 'vw' ]
				],
				'border' => [
					'customColor'	=> true,
					'customRadius'	=> true,
					'customStyle'	=> true,
					'customWidth'	=> true,
				],
				'custom' => [
					'contentSize'	=> '60vw',
					'wideSize'	=> '80vw',
					'baseFontSize' => "1rem",
					'spacer' => [
						'base'	=> '1rem',
						'v'		=> 'calc(var(--wp--custom--spacer--base)*4)',
						'h'		=> 'calc(var(--wp--custom--spacer--base)*4)',
					],
					'lineHeight' => [
						'small' => 1.2,
						'medium' => 1.4,
						'large' => 1.8
					],
				],
				"blocks" => [
//					"core/paragraph" => [
//						"color" => [
//							'custom' => true,
//							'palette' => [
//								[
//									"slug" => "primary",
//									"color" => "#044c75",
//									"name" => "Primary"
//								]
//							],
//						],
//						"custom" => [
//							'fontSize' => "25px",
//						],
//					],
//					"core/group" => [
//					],
				],
				'layout' => [
					'contentSize' => "var(--wp--custom--content-size)",
					'wideSize' => "var(--wp--custom--wide-size)",
				],
			],
			'styles'	=> [
				'border' => [
					'color' => '',
					'radius' => '',
					'style' => '',
					'width' => '',
				],
				'color' => [
					'background' => $palette->varOf( 'background' ),
					'text' => $palette->varOf( 'text' ),
				],
				'typography' => [
					'fontFamily'	=> $font_family->varOf('base'),
					'fontSize'	=> $font_sizes->varOf( 'base' ),
					'fontStyle'	=> '',
					'fontWeight'	=> '',
					'lineHeight' => 'var(--wp--custom--line-height--medium)',
					'textDecoration' => '',
					'textTransform' => '',
				],
				'spacing'	=> [
					'blockGap'	=> '2rem',
					'margin'	=> [
						'top'		=> '0px',
						'right'		=> '0px',
						'bottom'	=> '0px',
						'left'		=> '0px',
					],
					'padding'	=> [
						'top'		=> '0px',
						'right'		=> '0px',
						'bottom'	=> '0px',
						'left'		=> '0px',
					],
				],

				'elements' => [
					'link' => [
						'border' => [],
						'color' => [
							'text' => $palette->varOf( 'text' ),
						],
						'spacing' => [],
						'typography' => [],
					],
					'h1' => [
						'typography' => [
							'fontSize' => $font_sizes->varOf('h1'),
						],
						'spacing'	=> [
							'blockGap'	=> '4rem',
						],
					],
					'h2' => [
						'typography' => [
							'fontSize' => $font_sizes->varOf('h2'),
						],
						'spacing'	=> [
							'blockGap'	=> '4rem',
						],
					],
					'h3' => [
						'typography' => [
							'fontSize' => $font_sizes->varOf('h3'),
						],
						'spacing'	=> [
							'blockGap'	=> '4rem',
						],
					],
					'h4' => [
						'typography' => [
							'fontSize' => $font_sizes->varOf('h4'),
						],
						'spacing'	=> [
							'blockGap'	=> '4rem',
						],
					],
					'h5' => [
						'typography' => [
							'fontSize' => $font_sizes->varOf('h5'),
						],
						'spacing'	=> [
							'blockGap'	=> '4rem',
						],
					],
					'h6' => [
						'typography' => [
							'fontSize' => $font_sizes->varOf('h6'),
						],
						'spacing'	=> [
							'blockGap'	=> '4rem',
						],
					],
				],

				'blocks' => [
					'overblocks/container' => [
					],
					'core/group' => [
						'spacing'	=> [
							'padding'	=> [
								'top'		=> 'var(--wp--custom--spacer--v)',
								'bottom'	=> 'var(--wp--custom--spacer--v)',
							],
						],
					],
					'core/paragraph' => [
						'color' => [
							'text' => $palette->varOf( 'text' ),
						],
					],
					'core/button' => [
						'border' => [
							'radius' => \sprintf(
								'calc(%s/4)',
								$font_sizes->varOf('base')
							),
//							'color' => '',
							'style' => 'solid',
							'width' => '1px',
						],
						'color' => [
							'background' => $palette->varOf('base'),
							'text' => $palette->varOf('background'),
						],
						'typography' => [
							'fontFamily'		=> $font_family->varOf('base'),
							'fontSize'			=> $font_sizes->varOf('base'),
							'text-transform'	=> 'uppercase',
						],
					],
					'core/code' => [
						'typography' => [
							'fontFamily'	=> $font_family->varOf('monospace'),
						],
						'spacing' => [
							'padding' => [
								'left' => 'var(--wp--custom--spacer--h)',
								'right' => 'var(--wp--custom--spacer--h)',
								'top' => 'var(--wp--custom--spacer--v)',
								'bottom' => 'var(--wp--custom--spacer--v)',
							],
						],
						'border' => [
							'color' => (string) $border_color->toRgba(),
							'radius' => '0px',
							'style' => 'solid',
							'width' => '1px',
						],
					],
//					'core/heading' => [
//						'typography' => [
//							'fontFamily' => 'var(--wp--custom--heading--typography--font-family)',
//							'fontWeight' => 'var(--wp--custom--heading--typography--font-weight)',
//							'lineHeight' => 'var(--wp--custom--heading--typography--line-height)',
//						],
//					],
//					'core/navigation' => [
//						'typography' => [
//							'fontSize' => 'var(--wp--preset--font-size--normal)',
//						],
//					],
//					'core/post-title' => [
//						'typography' => [
//							'fontFamily' => 'var(--wp--custom--heading--typography--font-family)',
//							'fontSize' => 'var(--wp--preset--font-size--huge)',
//							'lineHeight' => 'var(--wp--custom--heading--typography--line-height)',
//						],
//					],
//					'core/post-date' => [
//						'color' => [
//							'link' => 'var(--wp--custom--color--foreground)',
//							'text' => 'var(--wp--custom--color--foreground)',
//						],
//						'typography' => [
//							'fontSize' => 'var(--wp--preset--font-size--small)',
//						],
//					],
//					'core/pullquote' => [
//						'border' => [
//							'style' => 'solid',
//							'width' => '1px 0',
//						],
//						'typography' => [
//							'fontStyle' => 'italic',
//							'fontSize' => 'var(--wp--preset--font-size--huge)',
//						],
//						'spacing' => [
//							'padding' => [
//								'left' => 'var(--wp--custom--margin--horizontal)',
//								'right' => 'var(--wp--custom--margin--horizontal)',
//								'top' => 'var(--wp--custom--margin--horizontal)',
//								'bottom' => 'var(--wp--custom--margin--horizontal)',
//							],
//						],
//					],
//					'core/separator' => [
//						'color' => [
//							'text' => 'var(--wp--custom--color--foreground)',
//						],
//						'border' => [
//							'color' => 'currentColor',
//							'style' => 'solid',
//							'width' => '0 0 1px 0',
//						],
//					],
//					'core/site-title' => [
//						'typography' => [
//							'fontSize' => 'var(--wp--preset--font-size--normal)',
//							'fontWeight' => 700,
//						],
//					],
					'core/quote' => [
						'border' => [
							'color' => $palette->varOf('text'),
							'style' => 'solid',
							'width' => '0 0 0 1px',
						],
						'spacing' => [
							'padding' => [
								'left' => 'var(--wp--custom--spacer--h)',
							],
						],
						'typography' => [
							'fontSize' => $font_sizes->varOf('base'),
							'fontStyle' => 'normal',
						],
					],
				],
			],
		];
	}
}
