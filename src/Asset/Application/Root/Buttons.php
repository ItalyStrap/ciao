<?php

declare(strict_types=1);

namespace ItalyStrap\ExperimentalTheme\Asset\Application\Root;

use ItalyStrap\ExperimentalTheme\JsonData;
use ItalyStrap\ThemeJsonGenerator\Application\Config\Blueprint;
use ItalyStrap\ThemeJsonGenerator\Domain\Input\Settings\CollectionInterface;
use ItalyStrap\ThemeJsonGenerator\Domain\Input\Styles\Border;
use ItalyStrap\ThemeJsonGenerator\Domain\Input\Styles\Color;
use ItalyStrap\ThemeJsonGenerator\Domain\Input\Styles\Spacing;
use ItalyStrap\ThemeJsonGenerator\Domain\Input\Styles\Typography;

class Buttons
{
    private Blueprint $blueprint;
    private Color $color;
    private Typography $typography;
    private Border $border;
    private Spacing $spacing;
    private CollectionInterface $collection;

    public function __construct(
        Blueprint $blueprint,
        Color $color,
        Typography $typography,
        Border $border,
        Spacing $spacing,
        CollectionInterface $collection
    ) {
        $this->blueprint = $blueprint;
        $this->color = $color;
        $this->typography = $typography;
        $this->border = $border;
        $this->spacing = $spacing;
        $this->collection = $collection;
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
         */
        $this->blueprint->setElementStyle('button', [
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
            ':hover' => [
                'color' => $this->color
                    ->background(JsonData::BUTTON_HOVER_BG)
                    ->text(JsonData::BUTTON_HOVER_TEXT),
                'border' => [
                    'color' => $this->color
                        ->text(JsonData::BUTTON_HOVER_BORDER_COLOR),
                ],
            ],
            ':focus' => [
                'color' => $this->color
                    ->background(JsonData::BUTTON_HOVER_BG),
                'border' => [
                    'color' => $this->color
                        ->text(JsonData::BUTTON_HOVER_BORDER_COLOR),
                ],
                'outline' => [
                    'color' => $this->collection->get(JsonData::COLOR_GRAY_300)->var(),
                    'offset' => '1px',
                    'style' => 'dotted',
                    'width' => '1px',
                ],
            ],
            ':active' => [
                'color' => $this->color
                    ->background(JsonData::BUTTON_HOVER_BG),
                'border' => [
                    'color' => $this->color
                        ->text(JsonData::BUTTON_HOVER_BORDER_COLOR),
                ],
            ],
        ]);

        /**
         * .wp-element-button
         * .wp-block-button__link
         */
        $this->blueprint->setBlockStyle('core/button', [
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
}
