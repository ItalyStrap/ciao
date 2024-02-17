<?php

declare(strict_types=1);

namespace ItalyStrap\ExperimentalTheme\Asset\Application\Root\Collection;

use ItalyStrap\ExperimentalTheme\JsonData;
use ItalyStrap\ThemeJsonGenerator\Application\Config\Blueprint;
use ItalyStrap\ThemeJsonGenerator\Domain\Input\Settings\PresetsInterface;
use ItalyStrap\ThemeJsonGenerator\Domain\Input\Settings\Custom\CollectionAdapter;
use ItalyStrap\ThemeJsonGenerator\Domain\Input\Settings\Utilities\CalcExperimental;

class Custom
{
    private PresetsInterface $collection;

    public function __construct(
        PresetsInterface $collection
    ) {
        $this->collection = $collection;
    }

    public function __invoke(Blueprint $blueprint): void
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
                'bg'    => $this->collection->get(JsonData::COLOR_BASE),
                'text'  => $this->collection->get(JsonData::COLOR_BODY_BG),
            ],
            'link'      => [
                'bg'    => $this->collection->get(JsonData::COLOR_BASE),
                'text'  => $this->collection->get(JsonData::COLOR_BODY_BG),
                'decoration'    => 'underline',
                'hover' => [
                    'text'          => $this->collection->get(JsonData::COLOR_BODY_COLOR),
                    'decoration'    => 'underline',
                ],
            ],
            'button'        => [
                'bg'    => $this->collection->get(JsonData::COLOR_BASE),
                'text'    => $this->collection->get(JsonData::COLOR_BUTTON_TEXT_HOVER),
                'borderColor'   => 'transparent',
                'borderRadius'  => (string)(new CalcExperimental(
                    $this->collection->get(JsonData::FONT_SIZE_BASE)->var(),
                    '/',
                    '3'
                )),
                'hover' => [
                    'bg'    => $this->collection->get(JsonData::COLOR_BUTTON_BG_HOVER),
                    'text'  => $this->collection->get(JsonData::COLOR_BUTTON_TEXT_HOVER),
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

        $this->collection->addMultiple(
            $collectionAdapter->toArray()
        );

//        $this->collection
//            ->add(new Item(
//                JsonData::CONTENT_SIZE,
//                'clamp(16rem, 60vw, 60rem)'
//            ))
//            ->add(new Item(
//                JsonData::LINE_HEIGHT_L,
//                '1.7'
//            ));
    }
}
