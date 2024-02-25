<?php

declare(strict_types=1);

use ItalyStrap\ExperimentalTheme\Asset\Application\Root\Buttons;
use ItalyStrap\ExperimentalTheme\Asset\Application\Root\Containers;
use ItalyStrap\ExperimentalTheme\Asset\Application\Root\Elements;
use ItalyStrap\ExperimentalTheme\Asset\Application\Root\GlobalStyle;
use ItalyStrap\ExperimentalTheme\Asset\Application\Root\Heading;
use ItalyStrap\ExperimentalTheme\Asset\Application\Root\Media;
use ItalyStrap\ExperimentalTheme\Asset\Application\Root\Navigation;
use ItalyStrap\ExperimentalTheme\Asset\Application\Root\PostBody;
use ItalyStrap\ExperimentalTheme\Asset\Application\Root\PostComments;
use ItalyStrap\ExperimentalTheme\Asset\Application\Root\PostMeta;
use ItalyStrap\ExperimentalTheme\Asset\Application\Root\SiteTagline;
use ItalyStrap\ExperimentalTheme\Asset\Application\Root\SpacerSeparator;
use ItalyStrap\ExperimentalTheme\Asset\Application\Root\TermDescription;
use ItalyStrap\ExperimentalTheme\Asset\Application\Root\Title;
use ItalyStrap\ExperimentalTheme\Helper;
use ItalyStrap\ExperimentalTheme\JsonData;
use ItalyStrap\ThemeJsonGenerator\Application\Config\Blueprint;
use ItalyStrap\ThemeJsonGenerator\Domain\Input\SectionNames;
use ItalyStrap\ThemeJsonGenerator\Domain\Input\Settings\PresetsInterface;
use Psr\Container\ContainerInterface;

return static function (ContainerInterface $container, PresetsInterface $presets, Blueprint $blueprint) {
    $container->get(\ItalyStrap\ExperimentalTheme\Asset\Application\Root\Collection\Colors::class)($blueprint);
    $container->get(\ItalyStrap\ExperimentalTheme\Asset\Application\Root\Collection\Gradient::class)($blueprint);
    $container->get(\ItalyStrap\ExperimentalTheme\Asset\Application\Root\Collection\Duotone::class)($blueprint);
    $container->get(\ItalyStrap\ExperimentalTheme\Asset\Application\Root\Collection\FontSizes::class)($blueprint);
    $container->get(\ItalyStrap\ExperimentalTheme\Asset\Application\Root\Collection\FontFamily::class)($blueprint);
    $container->get(\ItalyStrap\ExperimentalTheme\Asset\Application\Root\Collection\Custom::class)($blueprint);

    $blueprint->merge([
        SectionNames::SCHEMA => 'https://schemas.wp.org/trunk/theme.json',
        SectionNames::VERSION => JsonData::VERSION,
        SectionNames::TITLE => 'Experimental Theme',
        SectionNames::DESCRIPTION => 'Experimental Theme',
        SectionNames::SETTINGS => [
            'color' => [
                'custom'    => true,
                'link'      => true,
            ],
            'typography' => [
                'customFontSize'    => true,
//                    'customLineHeight'  => true,
            ],
            'spacing' => [
                'blockGap'  => true,
//                    'customMargin' => true,
//                    'customPadding' => true,
                'units' => [ '%', 'px', 'em', 'rem', 'vh', 'vw' ]
            ],
//                'border' => [
//                    'customColor'   => true,
//                    'customRadius'  => true,
//                    'customStyle'   => true,
//                    'customWidth'   => true,
//                ],

            'layout' => [
                'contentSize' => $presets->get(JsonData::CONTENT_SIZE)->var(),
                'wideSize' => $presets->get(JsonData::WIDE_SIZE)->var(),
            ],
        ],

        /**
         * ============================================
         * Styles for FSE and Front-End
         * ============================================
         */
        SectionNames::STYLES    => [
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
    ]);

    $container->get(GlobalStyle::class)($blueprint);
    $container->get(Elements::class)($blueprint);
    $container->get(Containers::class)($blueprint);
    $container->get(Heading::class)($blueprint);
    $container->get(Buttons::class)($blueprint);
    $container->get(Title::class)($blueprint);
    $container->get(PostBody::class)($blueprint);
    $container->get(PostComments::class)($blueprint);
    $container->get(PostMeta::class)($blueprint);
    $container->get(Navigation::class)($blueprint);
    $container->get(Media::class)($blueprint);
    $container->get(SpacerSeparator::class)($blueprint);
    $container->get(TermDescription::class)($blueprint);
    $container->get(SiteTagline::class)($blueprint);
};
