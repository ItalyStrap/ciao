<?php
declare(strict_types=1);

namespace ItalyStrap\ExperimentalTheme;

use ItalyStrap\ExperimentalTheme\Styles\Border;
use ItalyStrap\ExperimentalTheme\Styles\Color;
use ItalyStrap\ThemeJsonGenerator\SectionNames;
use Spatie\Color\Exceptions\InvalidColorValue;
use ItalyStrap\ThemeJsonGenerator\Collection\Preset;
use ItalyStrap\ThemeJsonGenerator\Collection\Custom;
use ItalyStrap\ExperimentalTheme\Factory\Color as FClr;
use ItalyStrap\ExperimentalTheme\Factory\Spacing as FSpace;
use ItalyStrap\ExperimentalTheme\Factory\Typography as FTypo;

final class JsonData {

	/**
	 * @throws InvalidColorValue
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
	 * @throws InvalidColorValue
	 */
	public function buildJsonData(): array {

		$light = new ColorDataType( '#ede7d9' );
		$dark = new ColorDataType('#0c0910');
		$color_background = new ColorDataType( '#ffffff' );
		$color_text = new ColorDataType('#000000');
		$color_base = new ColorDataType('#3986E0');
		$border_color = new ColorDataType('#cccccc');

		$button_bg_hover = $color_base->darken(20);
		$button_text_hover = $color_background->darken(10);

		if ( $color_base->isDark() ) {
			$button_text_hover = $color_background->lighten(10);
		}

		$grays = $this->generateShadesFromColorHex( $color_text, 'gray' );

		$palette = new Preset(
			[
				[
					"slug" => "bodyColor",
					"color" => $color_text->toHsla(),
					"name" => "Black for text, headings, links"
				],
				[
					"slug" => "bodyBg",
					"color" => $color_background->toHsla(),
					"name" => "White for body background"
				],
				[
					"slug" => "base",
					"color" => $color_base->toHsla(),
					"name" => "Brand base color"
				],
				[
					"slug" => "baseDark",
					"color" => $color_base->darken( 20 )->toHsla(),
					"name" => "Darker Brand base color"
				],
				[
					"slug" => "baseLight",
					"color" => $color_base->lighten( 20 )->toHsla(),
					"name" => "Lighter Brand base color"
				],
				[
					"slug" => "baseComplementary",
					"color" => $color_base->complementary()->toHsla(),
					"name" => "Brand base color"
				],
				...$grays
			],
			'color'
		);

		$gradient = new Preset(
			[
				[
					"slug"		=> "black-to-white",
					"gradient"	=> \sprintf(
						'linear-gradient(160deg,%s,%s)',
						'{{color.bodyColor}}',
						'{{color.bodyBg}}'
					),
					"name"		=> "Black to white"
				],
				[
					"slug"		=> "base-to-white",
					"gradient"	=> \sprintf(
						'linear-gradient(135deg,%s,%s)',
						'{{color.base}}',
						$color_base->lighten(10)->mix( $color_background->toHex() )->toHsla()
					),
					"name"		=> "Base to white"
				],
			],
			'gradient'
		);

		$gradient->withCollection( $palette );

		$font_sizes = new Preset(
			[
				[
					"slug" => "base",
					"size" => "clamp(1.125rem, 2vw, 1.5rem)",
					"name" => "Base font size 16px"
				],
				[
					"slug" => "h1",
					"size" => "calc( {{base}} * 2.5)",
					"name" => "Used in H1 titles"
				],
				[
					"slug" => "h2",
					"size" => "calc( {{base}} * 2)",
					"name" => "Used in H2 titles"
				],
				[
					"slug" => "h3",
					"size" => "calc( {{base}} * 1.75)",
					"name" => "Used in H3 titles"
				],
				[
					"slug" => "h4",
					"size" => "calc( {{base}} * 1.5)",
					"name" => "Used in H4 titles"
				],
				[
					"slug" => "h5",
					"size" => "calc( {{base}} * 1.25)",
					"name" => "Used in H5 titles"
				],
				[
					"slug" => "h6",
					"size" => "{{base}}",
					"name" => "Used in H6 titles"
				],
				[
					"slug" => "small",
					"size" => "calc( {{base}} * 0.75)",
					"name" => "Small font size"
				],
				[
					"slug" => "x-small",
					"size" => "calc( {{base}} * 0.5)",
					"name" => "Extra Small font size"
				],
			],
			'fontSize',
			'size'
		);

		$font_family = new Preset(
			[
				[
					// phpcs:ignore
					'fontFamily' => 'system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", "Liberation Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji"',
					'slug' => "base",
					"name" => "Default font family",
				],
				[
					// phpcs:ignore
					'fontFamily' => 'SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace',
					'slug' => "monospace",
					"name" => "Font family for code",
				],
			],
			'fontFamily'
		);

		$custom = new Custom(
			[
				'contentSize'	=> 'clamp(16rem, 60vw, 60rem)',
				'wideSize'		=> 'clamp(16rem, 80vw, 70rem)',
				'baseFontSize' 	=> "1rem",
				'spacer' 		=> [
					'base'	=> '1rem',
					'v'		=> 'calc( {{spacer.base}} * 4 )',
					'h'		=> 'calc( {{spacer.base}} * 4 )',
					's'		=> 'calc( {{spacer.base}} / 1.5 )',
					'm'		=> 'calc( {{spacer.base}} * 2 )',
					'l'		=> 'calc( {{spacer.base}} * 3 )',
					'xl'	=> 'calc( {{spacer.base}} * 4 )',
				],
				'lineHeight' 	=> [
					'base' => 1.5,
					'xs' => 1.3,
					's' => 1.4,
					'm' => '{{lineHeight.base}}',
					'l' => 1.7
				],
				'body'		=> [
					'bg'	=> '{{color.base}}',
					'text'	=> '{{color.bodyBg}}',
				],
				'link'		=> [
					'bg'			=> '{{color.base}}',
					'text'			=> '{{color.bodyBg}}',
					'decoration'	=> 'underline',
					'hover'	=> [
						'text'			=> '{{color.bodyColor}}',
						'decoration'	=> 'underline',
					],
				],
				'button'		=> [
					'bg'	=> '{{color.base}}',
					'text'	=> $button_text_hover->toHex(),
					'borderColor'	=> 'transparent',
					'hover'	=> [
						'bg'	=> $button_bg_hover->toHex(),
						'text'	=> $button_text_hover->toHex(),
						'borderColor'	=> 'transparent',
					],
					'padding'	=> ' 0.25em 0.7em',
				],
				'form'	=> [
					'border'	=> [
						'color'	=> '',
						'width'	=> '',
					],
					'input'	=> [
						'color'	=> '',
					],
				],
				'navbar'	=> [
					'height'	=> [
						'min'	=> 'calc( {{spacer.base}} * 5.3125 )',
					],
				],
//				'site-blocks'	=> [
//						'margin'	=> [
//							'top'	=> '',
//					],
//				],
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
				Helper::templateParts( 'singular-header', 'header' ),
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
								$color_text->toHex(),
								$color_background->toHex(),
							],
							"slug" => "black-to-white",
							"name" => "Black to White"
						],
						[
							'colors' => [
								$color_base->toHex(),
								$color_background->toHex(),
							],
							"slug" => "base-to-white",
							"name" => "base-to-white"
						],
						[
							'colors' => [
								$color_text->toRgba(),
								$color_base->toHex(),
							],
							"slug" => "black-to-base",
							"name" => "black-to-base"
						],
						[
							'colors' => [
								$color_base->toHex(),
								$color_text->toRgba(),
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
				"blocks" => [
					"core/button" => [
						"color" => [
							'custom' => false,
//							'palette' => [
//								[
//									"slug" => "primary",
//									"color" => "#044c75",
//									"name" => "Primary"
//								]
//							],
						],
					],
					"core/navigation" => [
						"color" => [
							'custom' => false,
						],
					],
				],
				'layout' => [
					'contentSize' => $custom->varOf( 'contentSize' ),
					'wideSize' => $custom->varOf( 'wideSize' ),
				],
			],

			/**
			 * ============================================
			 * Styles for FSE and Front-End
			 * ============================================
			 */
			'styles'	=> [

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
				'color' => ( new Color() )
					->background( $palette->varOf( 'bodyBg' ) )
					->text( $palette->varOf( 'bodyColor' ) )
					->toArray(),
				'typography' => FTypo::make()
					->fontFamily( $font_family->varOf('base') )
					->fontSize( $font_sizes->varOf( 'base' ) )
					->fontStyle( 'normal' )
					->fontWeight( '400' )
					->letterSpacing( 'normal' )
					->lineHeight( $custom->varOf( 'lineHeight.m' ) )
					->textDecoration( 'none' )
					->textTransform( 'none' )
					->toArray(),
				'spacing'	=> [
					'blockGap'	=> $custom->varOf( 'spacer.m' ),
					/**
					 * For margin and padding we can write simply the shorthand
					 */
					'margin'	=> "0",
					'padding'	=> "0",
				],

				/**
				 * ============================================
				 * Top level elements styles
				 * ============================================
				 */
				'elements' => [
					'link' => [
						'color'	=> FClr::make()
							->text( $palette->varOf( 'base' ) )
							->background( 'transparent' )
							->toArray(),
					],
					'h1' => [
						'typography' => FTypo::make()->fontSize( $font_sizes->varOf('h1') )->toArray(),
						'spacing'	=> [
							'margin'	=> (string) FSpace::make()
								->top( $custom->varOf( 'spacer.m' ) )
								->bottom( '0px' ),
						],
					],
					'h2' => [
						'typography' =>  FTypo::make()->fontSize( $font_sizes->varOf('h2') )->toArray(),
						'spacing'	=> [
							'margin'	=> (string) FSpace::make()
								->top( $custom->varOf( 'spacer.m' ) )
								->bottom( '0px' ),
						],
					],
					'h3' => [
						'typography' => FTypo::make()->fontSize( $font_sizes->varOf('h3') )->toArray(),
						'spacing'	=> [
							'margin'	=> (string) FSpace::make()
								->top( $custom->varOf( 'spacer.m' ) )
								->bottom( '0px' ),
						],
					],
					'h4' => [
						'typography' => FTypo::make()->fontSize( $font_sizes->varOf('h4') )->toArray(),
						'spacing'	=> [
							'margin'	=> (string) FSpace::make()
								->top( $custom->varOf( 'spacer.m' ) )
								->bottom( '0px' ),
						],
					],
					'h5' => [
						'typography' => FTypo::make()->fontSize( $font_sizes->varOf('h5') )->toArray(),
						'spacing'	=> [
							'margin'	=> (string) FSpace::make()
								->top( $custom->varOf( 'spacer.m' ) )
								->bottom( '0px' ),
						],
					],
					'h6' => [
						'typography' => FTypo::make()->fontSize( $font_sizes->varOf('h6') )->toArray(),
						'spacing'	=> [
							'margin'	=> (string) FSpace::make()
								->top( $custom->varOf( 'spacer.m' ) )
								->bottom( '0px' ),
						],
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
					 * Blocks container
					 * ============================================
					 */
					'overblocks/container' => [
						'spacing'	=> [
							'margin'	=> '0',
						],
					],
					'core/columns' => [
						'spacing'	=> [
							'margin'	=> '0',
						],
					],

					/**
					 * ============================================
					 * Blocks elements for images
					 * ============================================
					 */
					'core/site-logo' => [ // wp-block-site-logo {figure element}
						'spacing'	=> [
							'margin'	=> (string) FSpace::shorthand(['0']),
							'padding'	=> (string) FSpace::shorthand(['0']),
						],
					],
					'core/image' => [ // wp-block-image {figure element}
						'spacing'	=> [
							'margin'	=> (string) FSpace::make()
								->top( $custom->varOf( 'spacer.m' ) )
								->bottom( '0px' ),
						],
					],
					'core/post-featured-image' => [ // wp-block-post-featured-image {figure element}
						'spacing'	=> [
							'margin'	=> (string) FSpace::make()
								->top( $custom->varOf( 'spacer.m' ) )
								->bottom('0'),
						],
					],
					'core/gallery' => [ // wp-block-gallery {figure element}
						'spacing'	=> [
							'margin'	=> (string) FSpace::make()
								->top( $custom->varOf( 'spacer.m' ) )
								->bottom('0'),
						],
					],

					/**
					 * ============================================
					 * Blocks elements in content
					 * ============================================
					 */
					'core/paragraph' => [ // p
						'spacing'	=> [
							'margin'	=> (string) FSpace::make()
								->top( $custom->varOf( 'spacer.m' ) )
								->bottom( '0px' ),
						],
					],
					'core/button' => [ // .wp-block-button__link
						'border' => ( new Border() )
							->color( $custom->varOf( 'button.borderColor' ) )
							->radius( \sprintf(
								'calc(%s/3)',
								$font_sizes->varOf('base')
							) )
							->style( 'solid' )
							->width( '2px' )
							->toArray(),
						'color' => FClr::make()
							->background( $custom->varOf('button.bg') )
							->text( $custom->varOf('button.text') )
							->toArray(),
						'spacing'	=> [
							'padding'	=> $custom->varOf('button.padding'),
							'margin'	=> FSpace::make()
							->top( $custom->varOf( 'spacer.m' ) )
							->toArray(),
						],
						'typography' => FTypo::make()
							->fontFamily( $font_family->varOf('base') )
							->fontSize( $font_sizes->varOf('base') )
							->textDecoration( 'none' )
							->textTransform( 'uppercase' )
							->lineHeight($custom->varOf('lineHeight.s'))
							->toArray(),
					],
					'core/file' => [ // .wp-block-file
						'spacing'	=> [
							'margin'	=> FSpace::make()
							->top( $custom->varOf( 'spacer.m' ) )
							->toArray(),
						],
						'typography' => FTypo::make()
							->fontFamily( $font_family->varOf('base') )
							->fontSize( $font_sizes->varOf('base') )
							->lineHeight($custom->varOf('lineHeight.s'))
							->toArray(),
						'elements' => [
							'link' => [ // .wp-block-file a
								'color'	=> FClr::make()
									->text( $palette->varOf( 'base' ) )
									->background( 'transparent' )
									->toArray(),
							],
						],
					],
					'core/code' => [
						'typography' => FTypo::make()
							->fontFamily( $font_family->varOf('monospace') )
							->toArray(),
						'spacing' => [
							'margin'	=> FSpace::make()
								->top( $custom->varOf( 'spacer.l' ) )
								->toArray(),
							'padding' => FSpace::shorthand(
								[
									$custom->varOf( 'spacer.v' ),
									$custom->varOf( 'spacer.h' ),
								]
							)->toArray(),
						],
						'border' => ( new Border() )
							->color( (string) $border_color->toRgba() )
							->radius( '0px' )
							->style( 'solid' )
							->width( '1px' )
							->toArray(),
					],
					'core/quote' => [
						'border' => ( new Border() )
							->color( $palette->varOf('bodyColor') )
							->style( 'solid' )
							->width( '0 0 0 1px' )
							->toArray(),
						'spacing' => [
							'margin'	=> FSpace::make()
								->top( $custom->varOf( 'spacer.l' ) )
								->toArray(),
							'padding'	=> FSpace::make()
								->left( $custom->varOf( 'spacer.h' ) )
								->toArray(),
						],
						'typography' => FTypo::make()
							->fontSize( $font_sizes->varOf('base') )
							->fontStyle( 'normal' )
							->toArray(),
					],

					/**
					 * ============================================
					 * Blocks for templating
					 * ============================================
					 */
//					'core/post-title' => [
//						'typography' => [
//							'fontSize' => \sprintf(
//								'calc(%s * 1.5)',
//								$font_sizes->varOf('h1')
//							),
//						],
//					],
					'core/post-date' => [
						'color' => FClr::make()
							->text( $palette->varOf('bodyColor') )
							->toArray(),
						'typography' => FTypo::make()
							->fontSize( $font_sizes->varOf('h6') )
							->toArray(),
					],

					/**
					 * <!-- wp:spacer -->
					 * <div style="height:100px" aria-hidden="true" class="wp-block-spacer"></div>
					 * <!-- /wp:spacer -->
					 */
					'core/spacer' => [ // .wp-block-spacer
						'color' => FClr::make()
							->text( $palette->varOf('bodyColor') )
							->toArray(),
						'border' => ( new Border() )
							->color( 'currentColor' )
							->style( 'solid' )
							->width( '0 0 0 0' )
							->toArray(),
					],

					/**
					 * <!-- wp:separator -->
					 * <hr class="wp-block-separator"/>
					 * <!-- /wp:separator -->
					 */
					'core/separator' => [ // .wp-block-separator
						'color' => FClr::make()
							->text( $palette->varOf('bodyColor') )
							->toArray(),
						'border' => ( new Border() )
							->color( 'currentColor' )
							->style( 'solid' )
							->width( '0 0 1px 0' )
							->toArray(),
					],

					/**
					 * ============================================
					 * Blocks at site level
					 * ============================================
					 */
					'core/site-title' => [
						'color' => FClr::make()
							->text( $palette->varOf('bodyColor') )
							->toArray(),
						'typography' => FTypo::make()
							->fontSize( $font_sizes->varOf('h1') )
							->fontWeight( '600' )
							->toArray(),
					],
					'core/site-tagline' => [
						'color' => FClr::make()
							->text( $palette->varOf('bodyColor') )
							->toArray(),
						'typography' => FTypo::make()
							->fontSize( $font_sizes->varOf('h3') )
							->fontWeight( '600' )
							->toArray(),
					],
					'core/navigation' => [ // .wp-block-navigation
						'color' => FClr::make()
							->text( $palette->varOf('bodyBg') )
							->background( $palette->varOf('bodyColor') )
							->toArray(),
						'spacing'	=> [
							'padding'	=> (string) FSpace::vertical( '1.1rem' ),
						],
						'typography' => FTypo::make()
							->fontSize( $font_sizes->varOf('small') )
							->fontWeight( '400' )
							->textTransform('uppercase')
							->toArray(),
						'elements' => [
							'link' => [ // .wp-block-navigation a
								'color'	=> FClr::make()
//									->text( $palette->varOf( 'base' ) )
									->text( $palette->varOf( 'bodyBg' ) )
									->background( 'transparent' )
									->toArray(),
							],
							'h1' => [ // .wp-block-navigation h1
								'color'	=> FClr::make()
//									->text( $palette->varOf( 'base' ) )
									->text( $palette->varOf( 'bodyBg' ) )
//									->background( 'transparent' )
									->toArray(),
								'typography' => FTypo::make()->fontSize( $font_sizes->varOf('h6') )->toArray(),
								'spacing'	=> [
									'margin'	=> (string) FSpace::make()
										->top( '0' )
										->bottom( '0' ),
								],
							],
						],
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

//		$result = array_map( function ( $value ) {
//
//			if ( ! \is_array( $value ) ) {
//				return $value;
//			}
//
//			$filtered_value = \array_filter( $value, function ( $value ) {
//
//				if ( \is_array( $value ) && [] === $value ) {
//					return false;
//				}
//
//				return true;
//			} );
//
//			return $this->parseDataAndCleanFromEmptyValue( $filtered_value );
//
//		}, $result );

//		$result = array_filter( $result );
//
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

	/**
	 * @param ColorDataType $color_text
	 * @param string $slug
	 * @param int $min
	 * @param int $max
	 * @param bool $toHEX
	 * @return array
	 * @throws \Exception
	 */
	private function generateShadesFromColorHex(
		ColorDataType $color_text,
		string $slug,
		int $min = 10,
		int $max = 100,
		bool $toHEX = true
	): array {

		$color = new \Mexitek\PHPColors\Color( (string) $color_text->toHex() );

		$colors = [];
		for ( $i = $min; $i < $max; $i += 10 ) {
			$color_string = $color->isDark() ? $color->lighten( $i ) : $color->darken( $i );

			$colors[ $i ] = [
				"slug" => \sprintf(
					'%s-%d0',
					$slug,
					$i
				),
				"color" => '#' . $color_string,
				"name" => \sprintf(
					"%s of gray by %s%%",
					ucfirst( $slug ),
					$i
				)
			];
		}
		return $colors;
	}
}
