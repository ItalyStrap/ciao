<?php
declare(strict_types=1);

namespace ItalyStrap\ExperimentalTheme;

use ItalyStrap\ThemeJsonGenerator\ColorDataType;
use ItalyStrap\ThemeJsonGenerator\Styles\Border;
use ItalyStrap\ThemeJsonGenerator\Styles\Color;
use ItalyStrap\ThemeJsonGenerator\SectionNames;
use ItalyStrap\ThemeJsonGenerator\Collection\Preset;
use ItalyStrap\ThemeJsonGenerator\Collection\Custom;
use ItalyStrap\ThemeJsonGenerator\Factory\Color as FClr;
use ItalyStrap\ThemeJsonGenerator\Factory\Spacing as FSpace;
use ItalyStrap\ThemeJsonGenerator\Factory\Typography as FTypo;

final class JsonData {

	public static function getJsonData(): array {
		$data = new self();

		$result = $data->buildJsonData();

		$result = $data->parseDataAndCleanFromEmptyValue( $result );

		if ( \count( $result ) === 0 ) {
			throw new \RuntimeException('The theme.json is empty');
		}

		return $result;
	}

	public function buildJsonData(): array {
//
//		$light = new ColorDataType( '#ede7d9' );
//		$dark = new ColorDataType('#0c0910');
		$light = new ColorDataType( '#ffffff' );
		$dark = new ColorDataType('#000000');
		$body_bg = new ColorDataType( '#ffffff' );
		$body_text = new ColorDataType('#000000');
		$base_clr = new ColorDataType('#3986E0');
		$border_color = new ColorDataType('#cccccc');

		$button_bg_hover = $base_clr->darken(20);
		$button_text_hover = $body_bg->darken(10);

		if ( $base_clr->isDark() ) {
			$button_text_hover = $body_bg->lighten(10);
		}

		$grays = $this->generateShadesFromColorHex( $body_text, 'gray' );

		$palette = new Preset(
			[
				[
					"slug" => "light",
					"color" => $light->toHsla(),
					"name" => "Lighter color"
				],
				[
					"slug" => "dark",
					"color" => $dark->toHsla(),
					"name" => "Darker color"
				],
				[
					"slug" => "bodyBg",
					"color" => $body_bg->toHsla(),
					"name" => "Color for body background"
				],
				[
					"slug" => "bodyColor",
					"color" => $body_text->toHsla(),
					"name" => "Color for text, headings, links"
				],
				[
					"slug" => "base",
					"color" => $base_clr->toHsla(),
					"name" => "Brand base color"
				],
				[
					"slug" => "baseDark",
					"color" => $base_clr->darken( 20 )->toHsla(),
					"name" => "Darker Brand base color"
				],
				[
					"slug" => "baseLight",
					"color" => $base_clr->lighten( 20 )->toHsla(),
					"name" => "Lighter Brand base color"
				],
				[
					"slug" => "baseComplementary",
					"color" => $base_clr->complementary()->toHsla(),
					"name" => "Brand base complementary color"
				],
				...$grays
			],
			'color'
		);

		$gradient = new Preset(
			[
				[
					"slug"		=> "light-to-dark",
					"gradient"	=> \sprintf(
						'linear-gradient(160deg,%s,%s)',
						'{{color.light}}',
						'{{color.dark}}'
					),
					"name"		=> "Black to white"
				],
				[
					"slug"		=> "base-to-white",
					"gradient"	=> \sprintf(
						'linear-gradient(135deg,%s,%s)',
						'{{color.base}}',
						'{{color.baseDark}}'
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
					"size" => "calc( {{base}} * 2.8125)",
					"name" => "Used in H1 titles"
				],
				[
					"slug" => "h2",
					"size" => "calc( {{base}} * 2.1875)",
					"name" => "Used in H2 titles"
				],
				[
					"slug" => "h3",
					"size" => "calc( {{base}} * 1.625)",
					"name" => "Used in H3 titles"
				],
				[
					"slug" => "h4",
					"size" => "calc( {{base}} * 1.5)",
					"name" => "Used in H4 titles"
				],
				[
					"slug" => "h5",
					"size" => "calc( {{base}} * 1.125)",
					"name" => "Used in H5 titles"
				],
				[
					"slug" => "h6",
					"size" => "{{base}}",
					"name" => "Used in H6 titles"
				],
				[
					"slug" => "small",
					"size" => "calc( {{base}} * 0.875)",
					"name" => "Small font size"
				],
				[
					"slug" => "x-small",
					"size" => "calc( {{base}} * 0.75)",
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
					'min'		=> [
						'height'	=> 'calc( {{spacer.base}} * 5.3125 )',
					],
				],
				'query'		=> [
					'post'	=> [
						'title'	=> '{{fontSize.h1}}',
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
								$body_text->toHex(),
								$body_bg->toHex(),
							],
							"slug" => "black-to-white",
							"name" => "Black to White"
						],
						[
							'colors' => [
								$base_clr->toHex(),
								$body_bg->toHex(),
							],
							"slug" => "base-to-white",
							"name" => "base-to-white"
						],
						[
							'colors' => [
								$body_text->toRgba(),
								$base_clr->toHex(),
							],
							"slug" => "black-to-base",
							"name" => "black-to-base"
						],
						[
							'colors' => [
								$base_clr->toHex(),
								$body_text->toRgba(),
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
						'typography' => FTypo::make()
							->fontSize( $font_sizes->varOf('h1') )
							->fontFamily( $font_family->varOf('base') )
							->toArray(),
						'spacing'	=> [
							'margin'	=> (string) FSpace::make()
								->top( $custom->varOf( 'spacer.m' ) )
								->bottom( '0px' ),
						],
					],
					'h2' => [
						'typography' =>  FTypo::make()
							->fontSize( $font_sizes->varOf('h2') )
							->fontFamily( $font_family->varOf('base') )
							->toArray(),
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
					 * Blocks for titles
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
					'core/post-title' => [ // .wp-block-post-title
						'color' => FClr::make()
							->text( $palette->varOf('bodyColor') )
							->toArray(),
						'typography' => FTypo::make()
							->fontSize( $font_sizes->varOf('h1') )
							->toArray(),
						'elements' => [
							'link' => [ // .wp-block-post-title a
								'color'	=> FClr::make()
									->text( $palette->varOf( 'bodyColor' ) )
									->background( 'transparent' )
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
						'color' => FClr::make()
							->text( $palette->varOf('bodyColor') )
							->toArray(),
						'typography' => FTypo::make()
							->fontSize( $font_sizes->varOf('h6') )
							->toArray(),
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
					'core/post-date' => [
						'color' => FClr::make()
							->text( $palette->varOf('bodyColor') )
							->toArray(),
						'typography' => FTypo::make()
							->fontSize( $font_sizes->varOf('x-small') )
							->toArray(),
					],

					'core/post-author' => [
						'color' => FClr::make()
							->text( $palette->varOf('bodyColor') )
							->toArray(),
						'typography' => FTypo::make()
							->fontSize( $font_sizes->varOf('small') )
							->toArray(),
						'spacing'	=> [
							'margin'	=> (string) FSpace::make()
								->top( $custom->varOf( 'spacer.m' ) ),
						],
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

//					'core/query' => [
//						'elements' => [
//						],
//					],

					/**
					 * ============================================
					 * Blocks at site level
					 * ============================================
					 */
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
							->text( $palette->varOf('bodyColor') )
							->background( $palette->varOf('bodyBg') )
							->toArray(),
						'spacing'	=> [
							'padding'	=> (string) FSpace::vertical( '1.1rem' ),
						],
						'typography' => FTypo::make()
							->fontSize( $font_sizes->varOf('x-small') )
							->fontWeight( '400' )
							->textTransform('uppercase')
							->toArray(),
//						'elements' => [
//							'link' => [ // .wp-block-navigation a
//								'color'	=> FClr::make()
//									->text( $palette->varOf( 'base' ) )
//									->background( 'transparent' )
//									->toArray(),
//							],
//						],
					],
//					'core/navigation-link' => [ // .wp-block-navigation-link
//						'color' => FClr::make()
////							->text( $palette->varOf('bodyColor') )
//							->text( 'red' )
//							->background( $palette->varOf('bodyBg') )
//							->toArray(),
//					],
//					'core/navigation-submenu' => [ // .wp-block-navigation
//						'color' => FClr::make()
////							->text( $palette->varOf('bodyColor') )
//							->text( 'red' )
//							->background( $palette->varOf('bodyBg') )
//							->toArray(),
//					],

					/**
					 * ============================================
					 * Blocks for post comments
					 * ============================================
					 */
					'core/post-comments' => [
						'color' => FClr::make()
							->text( $palette->varOf('bodyColor') )
							->toArray(),
						'typography' => FTypo::make()
							->fontSize( $font_sizes->varOf('base') )
							->fontWeight( '300' )
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
	 * @return array
	 */
	private function generateShadesFromColorHex(
		ColorDataType $color_text,
		string $slug,
		int $min = 10,
		int $max = 100
	): array {

		$colors = [];
		for ( $i = $min; $i < $max; $i += 10 ) {
			$color_string = $color_text->isDark() ? $color_text->lighten( $i ) : $color_text->darken( $i );

			$colors[ $i ] = [
				"slug" => \sprintf(
					'%s-%d0',
					$slug,
					$i
				),
				"color" => $color_string->toHsla(),
				"name" => \sprintf(
					"Shade of %s by %s%%",
					ucfirst( $slug ),
					$i
				)
			];
		}
		return $colors;
	}
}
