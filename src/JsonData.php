<?php
declare(strict_types=1);

namespace ItalyStrap\ExperimentalTheme;

use ItalyStrap\ThemeJsonGenerator\SectionNames;
use Spatie\Color\Factory;
use ItalyStrap\ThemeJsonGenerator\Collection\Preset;
use ItalyStrap\ThemeJsonGenerator\Collection\Custom;
use ItalyStrap\ExperimentalTheme\Factory\Color as FClr;
use ItalyStrap\ExperimentalTheme\Factory\Spacing as FSpace;
use ItalyStrap\ExperimentalTheme\Factory\Typography as FTypo;

final class JsonData {

	/**
	 * @throws \Spatie\Color\Exceptions\InvalidColorValue
	 */
	public static function getJsonData(): array {
		$data = new self();

		$result = $data->buildJsonData();

		$result = $data->parseDataAndCleanFromEmptyValue( $result );

		if ( \count( $result ) === 0 ) {
			throw new \RuntimeException('The theme.json is empty');
		}

		return $result;
	}

	/**
	 * @throws \Spatie\Color\Exceptions\InvalidColorValue
	 */
	public function buildJsonData(): array {

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
					"color" => (string) $color_background->toRgba(),
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

		$custom = new Custom(
			[
				'contentSize'	=> '60vw',
				'wideSize'	=> '80vw',
				'baseFontSize' => "1rem",
				'spacer' => [
					'base'	=> '1rem',
					'v'		=> 'calc( {{spacer.base}} * 4 )',
					'h'		=> 'calc( {{spacer.base}} * 4 )',
					'test'		=> 'calc( {{fontSize.base}} * 4 )',
				],
				'blockGap'	=> [
					'base'	=> '{{spacer.base}}',
					'm'	=> 'calc( {{spacer.base}} * 2 )',
					'l'	=> 'calc( {{spacer.base}} * 4 )',
				],
				'lineHeight' => [
					'small' => 1.3,
					'medium' => 1.5,
					'large' => 1.7
				],
				'button'	=> [
					'bg'	=> '{{color.base}}',
					'text'	=> '{{color.background}}',
				],
			]
		);

		$custom->withCollection(
			$palette,
			$gradient,
			$font_sizes,
			$font_family
		);

		return [
			SectionNames::VERSION => 1,
			SectionNames::TEMPLATE_PARTS => [
				Helper::templateParts( 'header', 'header' ),
				Helper::templateParts( 'footer', 'footer' ),
			],
			SectionNames::CUSTOM_TEMPLATES	=> [
				[
					'name'	=> 'blank',
					'title'	=> 'Blank',
					'postTypes'	=> [
						'page',
						'post',
					],
				],
			],
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
				'custom' => $custom->toArray(),
//				"blocks" => [
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
//				],
				'layout' => [
					'contentSize' => $custom->varOf( 'contentSize' ),
					'wideSize' => $custom->varOf( 'wideSize' ),
				],
			],
			'styles'	=> [
				'border' => [
					'color' => '',
					'radius' => '',
					'style' => '',
					'width' => '',
				],
				'color' => Helper::color(
					$palette->varOf( 'background' ),
					'',
					$palette->varOf( 'text' )
				),
				'typography' => [
					'fontFamily'	=> $font_family->varOf('base'),
					'fontSize'	=> $font_sizes->varOf( 'base' ),
					'fontStyle'	=> '',
					'fontWeight'	=> '',
					'lineHeight' => $custom->varOf( 'lineHeight.medium' ),
					'textDecoration' => '',
					'textTransform' => '',
				],
				'spacing'	=> [
					'blockGap'	=> $custom->varOf( 'blockGap.m' ),
					'margin'	=> FSpace::shorthand(['0px'])->toArray(),
					'padding'	=> FSpace::shorthand(['0px'])->toArray(),
				],

				'elements' => [
					'link' => [
						'color'	=> FClr::text( $palette->varOf( 'base' ) )->toArray(),
					],
					'h1' => [
						'typography' => FTypo::make()->fontSize( $font_sizes->varOf('h1') )->toArray(),
						'spacing'	=> [
							'margin'	=> FSpace::top( $custom->varOf( 'blockGap.l' ) )->toArray(),
						],
					],
					'h2' => [
						'typography' =>  FTypo::make()->fontSize( $font_sizes->varOf('h2') )->toArray(),
						'spacing'	=> [
							'margin'	=> FSpace::top( $custom->varOf( 'blockGap.l' ) )->toArray(),
						],
					],
					'h3' => [
						'typography' => FTypo::make()->fontSize( $font_sizes->varOf('h3') )->toArray(),
						'spacing'	=> [
							'margin'	=> FSpace::top( $custom->varOf( 'blockGap.l' ) )->toArray(),
						],
					],
					'h4' => [
						'typography' => FTypo::make()->fontSize( $font_sizes->varOf('h4') )->toArray(),
						'spacing'	=> [
							'margin'	=> FSpace::top( $custom->varOf( 'blockGap.l' ) )->toArray(),
						],
					],
					'h5' => [
						'typography' => FTypo::make()->fontSize( $font_sizes->varOf('h5') )->toArray(),
						'spacing'	=> [
							'margin'	=> FSpace::top( $custom->varOf( 'blockGap.l' ) )->toArray(),
						],
					],
					'h6' => [
						'typography' => FTypo::make()->fontSize( $font_sizes->varOf('h6') )->toArray(),
						'spacing'	=> [
							'margin'	=> FSpace::top( $custom->varOf( 'blockGap.l' ) )->toArray(),
						],
					],
				],

				'blocks' => [

					/**
					 * ============================================
					 * Blocks container
					 * ============================================
					 */
					'overblocks/container' => [
						'spacing'	=> [
							'padding'	=> Helper::spacingVertical( $custom->varOf( 'spacer.v' ) ),
						],
					],
					'core/group' => [
						'spacing'	=> [
							'padding'	=> Helper::spacingVertical( $custom->varOf( 'spacer.v' ) ),
						],
					],

					/**
					 * ============================================
					 * Blocks elements in content
					 * ============================================
					 */
					'core/paragraph' => [
						'spacing'	=> [
							'margin'	=> Helper::spacingTop( $custom->varOf( 'blockGap.l' ) ),
						],
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
							'background' => $custom->varOf('button.bg'),
							'text' => $custom->varOf('button.text'),
						],
						'typography' => [
							'fontFamily'		=> $font_family->varOf('base'),
							'fontSize'			=> $font_sizes->varOf('base'),
							'textTransform'		=> 'uppercase',
						],
					],
					'core/code' => [
						'typography' => [
							'fontFamily'	=> $font_family->varOf('monospace'),
						],
						'spacing' => [
							'margin'	=> Helper::spacingTop( $custom->varOf( 'blockGap.l' ) ),
							'padding' => FSpace::shorthand(
								[
									$custom->varOf( 'spacer.v' ),
									$custom->varOf( 'spacer.h' ),
								]
							)->toArray(),
						],
						'border' => [
							'color' => (string) $border_color->toRgba(),
							'radius' => '0px',
							'style' => 'solid',
							'width' => '1px',
						],
					],

					'core/quote' => [
						'border' => [
							'color' => $palette->varOf('text'),
							'style' => 'solid',
							'width' => '0 0 0 1px',
						],
						'spacing' => [
							'margin'	=> Helper::spacingTop( $custom->varOf( 'blockGap.l' ) ),
							'padding'	=> Helper::spacingLeft( $custom->varOf( 'spacer.h' ) ),
						],
						'typography' => [
							'fontSize' => $font_sizes->varOf('base'),
							'fontStyle' => 'normal',
						],
					],

					/**
					 * ============================================
					 * Blocks for templating
					 * ============================================
					 */
					'core/post-title' => [
						'typography' => [
							'fontSize' => \sprintf(
								'calc(%s * 1.5)',
								$font_sizes->varOf('h1')
							),
						],
					],
					'core/post-date' => [
						'color' => FClr::make()
							->text( $palette->varOf('text') )
							->toArray(),
						'typography' => FTypo::make()
							->fontSize( $font_sizes->varOf('h6') )
							->toArray(),
					],
					'core/separator' => [
						'color' => FClr::make()
							->text( $palette->varOf('text') )
							->toArray(),
						'border' => [
							'color' => 'currentColor',
							'style' => 'solid',
							'width' => '0 0 1px 0',
						],
					],

					/**
					 * ============================================
					 * Blocks at site level
					 * ============================================
					 */
					'core/site-title' => [
						'color' => FClr::make()
							->text( $palette->varOf('text') )
							->toArray(),
						'typography' => FTypo::make()
							->fontSize( $font_sizes->varOf('h1') )
							->fontWeight( '800' )
							->toArray(),
					],
					'core/site-tagline' => [
						'color' => FClr::make()
							->text( $palette->varOf('text') )
							->toArray(),
						'typography' => FTypo::make()
							->fontSize( $font_sizes->varOf('h3') )
							->fontWeight( '800' )
							->toArray(),
					],
				],
			],
		];
	}

	/**
	 * @param array $result
	 */
	private function parseDataAndCleanFromEmptyValue( array $result ): array {

		// https://stackoverflow.com/questions/9895130/recursively-remove-empty-elements-and-subarrays-from-a-multi-dimensional-array

//		$result = array_map( function ( $arr ) {
//
//			if ( ! \is_array( $arr ) ) {
//				return $arr;
//			}
//
//			return \array_filter( $arr );
//
//		}, $result );
//
//		$result = array_filter( $result );

//		foreach ( $result as $key => $value ) {
//			if ( $value === '' || $value === [] ) {
//				unset( $result[ $key ] );
//			}
//
//			if ( \is_array( $value ) ) {
//				$result[ $key ] = $this->parseDataAndCleanFromEmptyValue( $value );
//			}
//		}

		return $result;
	}
}
