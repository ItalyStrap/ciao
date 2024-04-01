const {Palette} = require('theme-json-generator/dist/Domain/Input/Settings/Color');
const {Color, ColorModifier} = require('theme-json-generator/dist/Domain/Input/Settings/Color/Utilities');
const {
    DarkenColorsExperimental,
    LightenColorsExperimental,
    MonochromaticColorsExperimental,
} = require('theme-json-generator/dist/Domain/Input/Settings/Color/Utilities/Generators');

function colors(app) {
    const {presets} = app;

    const baseClr = new Color('#3986E0').toHsla();
    const light = new Color('#ffffff').toHsla();
    const dark = new Color('#000000').toHsla();

    const bodyBg = new Color('#ffffff').toHsla();
    const bodyText = new Color('#000000').toHsla();
    const headingText = new ColorModifier(bodyText).lighten(20);

    const border_color = new Color('#cccccc').toHsla();

    const button_bg_hover = new ColorModifier(baseClr).darken(20);
    let button_text_hover = new ColorModifier(bodyBg).darken(10);

    if (baseClr.isDark()) {
        button_text_hover = new ColorModifier(bodyBg).lighten(10);
    }

    const infoClr = baseClr;
    const successClr = new ColorModifier(infoClr).hueRotate(-82);
    const warningClr = new ColorModifier(infoClr).hueRotate(-172);
    const dangerClr = new ColorModifier(infoClr).hueRotate(-infoClr.hue());

    const baseClrPalette = new Palette('base', 'Brand base color', baseClr);
    const lightPalette = new Palette('light', 'Lighter color', light);
    const darkPalette = new Palette('dark', 'Darker color', dark);
    const bodyBgClrPalette = new Palette('bodyBg', 'Color for body background', bodyBg);
    const bodyClrPalette = new Palette('bodyColor', 'Color for text', bodyText);
    const headingClrPalette = new Palette('headingColor', 'Color for headings', headingText);
    const linkClrPalette = new Palette('linkColor', 'Color for links', baseClr);
    const borderClrPalette = new Palette('borderColor', 'Color for borders', border_color);
    const buttonBgHoverClrPalette = new Palette(
        'buttonBgHover',
        'Color for button background on hover',
        button_bg_hover
    );
    const buttonTextHoverClrPalette = new Palette(
        'buttonTextHover',
        'Color for button text on hover',
        button_text_hover
    );

    const baseDarkClrPalette = new Palette(
        'baseDark',
        'Darker Brand base color',
        new ColorModifier(baseClrPalette.color()).darken(20)
    );
    const baseLightClrPalette = new Palette(
        'baseLight',
        'Lighter Brand base color',
        new ColorModifier(baseClrPalette.color()).lighten(20)
    );
    const baseComplementaryClrPalette = new Palette(
        'baseComplementary',
        'Brand base complementary color',
        new ColorModifier(baseClrPalette.color()).complementary()
    );

    const infoClrPalette = new Palette('infoColor', 'Info color', infoClr);
    const successClrPalette = new Palette('successColor', 'Success color', successClr);
    const warningClrPalette = new Palette('warningColor', 'Warning color', warningClr);
    const dangerClrPalette = new Palette('dangerColor', 'Danger color', dangerClr);

    presets.add(baseClrPalette);
    presets.add(lightPalette);
    presets.add(darkPalette);
    presets.add(bodyBgClrPalette);
    presets.add(bodyClrPalette);
    presets.add(headingClrPalette);
    presets.add(linkClrPalette);
    presets.add(borderClrPalette);
    presets.add(buttonBgHoverClrPalette);
    presets.add(buttonTextHoverClrPalette);
    presets.add(baseDarkClrPalette);
    presets.add(baseLightClrPalette);
    presets.add(baseComplementaryClrPalette);
    presets.add(infoClrPalette);
    presets.add(successClrPalette);
    presets.add(warningClrPalette);
    presets.add(dangerClrPalette);

    mono(baseClrPalette, presets);
    lightenize(bodyClrPalette, presets);
    darkenize(bodyBgClrPalette, presets);
}

function mono(palette, presets) {
    const generator = new MonochromaticColorsExperimental(new ColorModifier(palette.color()), [20, 40, 60, 80]);
    toPreset(generator, presets, palette, 'Monochromatic of');
}

function lightenize(palette, presets) {
    const generator = new LightenColorsExperimental(new ColorModifier(palette.color()));
    toPreset(generator, presets, palette, 'Lighten of');
}

function darkenize(palette, presets) {
    const generator = new DarkenColorsExperimental(new ColorModifier(palette.color()));
    toPreset(generator, presets, palette, 'Darken of');
}

function toPreset(generator, presets, palette, label) {
    let i = 1;
    for (const color of generator.generate()) {
        presets.add(new Palette(`${palette.slug()}-${i}00`, `${label} ${palette.toObject()['name']} by ${i}0%`, color));
        i++;
    }
}

module.exports = {colors};
