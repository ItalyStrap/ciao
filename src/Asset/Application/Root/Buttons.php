<?php

declare(strict_types=1);

namespace ItalyStrap\ExperimentalTheme\Asset\Application\Root;

use ItalyStrap\ExperimentalTheme\JsonData;
use ItalyStrap\ThemeJsonGenerator\Application\Config\Blueprint;
use ItalyStrap\ThemeJsonGenerator\Domain\Input\Settings\PresetsInterface;
use ItalyStrap\ThemeJsonGenerator\Domain\Input\Styles\Border;
use ItalyStrap\ThemeJsonGenerator\Domain\Input\Styles\Color;
use ItalyStrap\ThemeJsonGenerator\Domain\Input\Styles\Css;
use ItalyStrap\ThemeJsonGenerator\Domain\Input\Styles\Outline;
use ItalyStrap\ThemeJsonGenerator\Domain\Input\Styles\Spacing;
use ItalyStrap\ThemeJsonGenerator\Domain\Input\Styles\Typography;

class Buttons
{
    private Color $color;
    private Typography $typography;
    private Border $border;
    private Spacing $spacing;
    private Outline $outline;
    private Css $css;

    public function __construct(
        Color $color,
        Typography $typography,
        Border $border,
        Spacing $spacing,
        Outline $outline,
        Css $css
    ) {
        $this->color = $color;
        $this->typography = $typography;
        $this->border = $border;
        $this->spacing = $spacing;
        $this->outline = $outline;
        $this->css = $css;
    }

    private function buttonElementCss(): string
    {
        return <<<CSS
.wp-element-button {
    display: inline-block;
    text-align: center;
    transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out;
    vertical-align: middle;
    cursor: pointer;
    -webkit-user-select: none;
    -ms-user-select: none;
    user-select: none;
    word-break: break-word;
}
CSS;
    }

    public function __invoke(Blueprint $blueprint)
    {
        $blueprint->setBlockSettings('core/button', [
            'color' => [
                'custom' => false,
            ],
        ]);

        /**
         * .wp-element-button
         *
         * BC = .wp-block-button__link
         *
         * Div container => .wp-block-button
         * a => .wp-block-button__link .wp-element-button
         */
        $blueprint->setElementStyle('button', [
            'border' => $this->border
                ->color(JsonData::BUTTON_BORDER_COLOR)
                ->radius(JsonData::BUTTON_BORDER_RADIUS)
                ->style('solid')
                ->width('1px'),
            'color' => $this->color
                ->background(JsonData::BUTTON_BG)
                ->text(JsonData::BUTTON_TEXT),
            'spacing'   => [
                'padding' => $this->spacing
                    ->vertical(JsonData::BUTTON_PADDING_V)
                    ->horizontal(JsonData::BUTTON_PADDING_H),
            ],
            'typography' => $this->typography
                ->fontFamily(JsonData::FONT_FAMILY_BASE)
                ->fontSize(JsonData::FONT_SIZE_BASE)
                ->textDecoration('none')
                ->lineHeight(JsonData::LINE_HEIGHT_S),
            ':hover' => $this->commonForPseudoClasses(),
            ':active' => $this->commonForPseudoClasses(),
            ':focus' => $this->commonForPseudoClasses([
                'outline' => $this->outline
                    ->color(JsonData::COLOR_GRAY_300)
                    ->offset('1px')
                    ->style('dotted')
                    ->width('1px'),
            ]),
        ]);

        /**
         * .wp-element-button
         * .wp-block-button__link
         */
        $blueprint->setBlockStyle('core/button', [
            'css' => $this->css->parseString($this->buttonElementCss(), '.wp-element-button'),
            'variations' => [
                'outline' => [
                    'border' => $this->border
                        ->color(JsonData::COLOR_BASE)
                        ->radius(JsonData::BUTTON_BORDER_RADIUS)
                        ->style('solid')
                        ->width('1px'),
                    'color' => $this->color
                        ->background(JsonData::COLOR_BODY_BG)
                        ->text(JsonData::COLOR_BASE),
                    'spacing'   => [
                        'padding' => $this->spacing
                            ->vertical(JsonData::BUTTON_PADDING_V)
                            ->horizontal(JsonData::BUTTON_PADDING_H),
                    ],
                ],
            ],
        ]);
    }

    private function commonForPseudoClasses(array $more = []): array
    {
        return \array_merge(
            [
                'color' => $this->color
                    ->background(JsonData::BUTTON_HOVER_BG)
                    ->text(JsonData::BUTTON_HOVER_TEXT),
                'border' => [
                    'color' => $this->color
                        ->text(JsonData::BUTTON_HOVER_BORDER_COLOR),
                ],
            ],
            $more
        );
    }
}
