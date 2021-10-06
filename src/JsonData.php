<?php
declare(strict_types=1);

namespace ItalyStrap\ExperimentalTheme;

use ItalyStrap\ExperimentalTheme\Styles\Border;
use ItalyStrap\ExperimentalTheme\Styles\Color;
use ItalyStrap\ThemeJsonGenerator\SectionNames;
use Spatie\Color\Exceptions\InvalidColorValue;
use Spatie\Color\Factory;
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

		$color_background = Factory::fromString('#ffffff');
		$color_text = Factory::fromString('#000000');
		$color_base = Factory::fromString('#3986E0');
		$border_color = Factory::fromString('#cccccc');

		$button_bg_hover_obj = new \Mexitek\PHPColors\Color( (string) $color_base->toHex() );
		$button_text_hover = new \Mexitek\PHPColors\Color( (string) $color_background->toHex() );

		$button_bg_hover = ( new \Mexitek\PHPColors\Color( (string) $color_base->toHex() ) )->darken(20);
		$button_text_hover = ( new \Mexitek\PHPColors\Color( (string) $color_background->toHex() ) )->darken(10);

		if ( $button_bg_hover_obj->isDark() ) {
			var_dump( 'IS DARK' );
			$button_text_hover = ( new \Mexitek\PHPColors\Color( (string) $color_background->toHex() ) )->lighten(10);
		}

		$grays = $this->generateShadesFromColorHex( $color_text, 'gray' );

		$palette = new Preset(
			[
				[
					"slug" => "text",
					"color" => (string) $color_text->toHsla(),
					"name" => "Black for text, headings, links"
				],
				[
					"slug" => "background",
					"color" => (string) $color_background->toHsla(),
					"name" => "White for body background"
				],
				[
					"slug" => "base",
					"color" => (string) $color_base->toRgba(),
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
					"name" => "Smallest font size"
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
				'contentSize'	=> '60vw',
				'wideSize'		=> '80vw',
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
					's' => 1.3,
					'm' => '{{lineHeight.base}}',
					'l' => 1.7
				],
				'body'		=> [
					'bg'	=> '{{color.base}}',
					'text'	=> '{{color.background}}',
				],
				'link'		=> [
					'bg'			=> '{{color.base}}',
					'text'			=> '{{color.background}}',
					'decoration'	=> 'underline',
					'hover'	=> [
						'text'			=> '{{color.text}}',
						'decoration'	=> 'underline',
					],
				],
				'button'		=> [
					'bg'	=> '{{color.base}}',
//					'text'	=> '{{color.text}}',
					'text'	=> Factory::fromString( '#' . $button_text_hover )->toHsla(),
					'borderColor'	=> 'transparent',
					'hover'	=> [
						'bg'	=> Factory::fromString( '#' . $button_bg_hover )->toHsla(),
						'text'	=> Factory::fromString('#' . $button_text_hover)->toHsla(),
						'borderColor'	=> 'transparent',
					],
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
					"core/group" => [
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
					->background( $palette->varOf( 'background' ) )
					->text( $palette->varOf( 'text' ) )
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
//					'overblocks/container' => [
//						'spacing'	=> [
//							'padding'	=> [],
//						],
//					],
//					'core/group' => [
//						'spacing'	=> [
//							'padding'	=> [],
//						],
//					],

					/**
					 * ============================================
					 * Blocks elements in content
					 * ============================================
					 */
					'core/paragraph' => [
						'spacing'	=> [
							'margin'	=> (string) FSpace::make()
								->top( $custom->varOf( 'spacer.s' ) )
								->bottom( '0px' ),
						],
						'color' => FClr::make()
							->text( $palette->varOf( 'text' ) )
							->toArray(),
					],
					'core/button' => [
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
							'padding'	=> '0.4em 0.85em !important',
						],
						'typography' => FTypo::make()
							->fontFamily( $font_family->varOf('base') )
							->fontSize( $font_sizes->varOf('base') )
							->textDecoration( 'none' )
							->textTransform( 'uppercase' )
							->lineHeight($custom->varOf('lineHeight.base'))
							->toArray(),
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
							->color( $palette->varOf('text') )
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
							->text( $palette->varOf('text') )
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
					'core/spacer' => [
						'color' => FClr::make()
							->text( $palette->varOf('text') )
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
					'core/separator' => [
						'color' => FClr::make()
							->text( $palette->varOf('text') )
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
							->fontWeight( '600' )
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
	 * @param \Spatie\Color\Color $color_text
	 * @return array
	 * @throws \Exception
	 */
	private function generateShadesFromColorHex(
		\Spatie\Color\Color $color_text,
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
