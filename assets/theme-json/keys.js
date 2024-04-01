const {Duotone, Gradient, Palette} = require('theme-json-generator/dist/Domain/Input/Settings/Color');
const {FontFamily, FontSize} = require('theme-json-generator/dist/Domain/Input/Settings/Typography');

module.exports = {
    BASE: 'base',
    LIGHT: 'light',
    DARK: 'dark',
    BODY_BG: 'bodyBg',
    BODY_COLOR: 'bodyColor',
    HEADING_TEXT: 'headingColor',
    LINK_TEXT: 'linkColor',
    BORDER: 'borderColor',
    BUTTON_BG_HOVER: 'buttonBgHover',
    BUTTON_TEXT_HOVER: 'buttonTextHover',
    BASE_DARK: 'baseDark',
    BASE_LIGHT: 'baseLight',
    BASE_COMPLEMENTARY: 'baseComplementary',
    GRAY_100: 'bodyColor-100',
    GRAY_200: 'bodyColor-200',
    GRAY_300: 'bodyColor-300',
    GRAY_400: 'bodyColor-400',
    GRAY_500: 'bodyColor-500',
    GRAY_600: 'bodyColor-600',
    GRAY_700: 'bodyColor-700',
    GRAY_800: 'bodyColor-800',
    GRAY_900: 'bodyColor-900',
    LIGHT_TO_DARK: 'light-to-dark',
    // FontFamily
    MONOSPACE: 'monospace',
    // FontSize
    H1: 'h1',
    H2: 'h2',
    H3: 'h3',
    H4: 'h4',
    H5: 'h5',
    H6: 'h6',
    SMALL: 'small',
    X_SMALL: 'x-small',

    get COLOR_BASE() {
        return `${Palette.TYPE}.${this.BASE}`;
    },
    get COLOR_LIGHT() {
        return `${Palette.TYPE}.${this.LIGHT}`;
    },
    get COLOR_DARK() {
        return `${Palette.TYPE}.${this.DARK}`;
    },
    get COLOR_BODY_BG() {
        return `${Palette.TYPE}.${this.BODY_BG}`;
    },
    get COLOR_BODY_COLOR() {
        return `${Palette.TYPE}.${this.BODY_COLOR}`;
    },
    get COLOR_HEADING_TEXT() {
        return `${Palette.TYPE}.${this.HEADING_TEXT}`;
    },
    get COLOR_LINK_TEXT() {
        return `${Palette.TYPE}.${this.LINK_TEXT}`;
    },
    get COLOR_BORDER() {
        return `${Palette.TYPE}.${this.BORDER}`;
    },
    get COLOR_BUTTON_BG_HOVER() {
        return `${Palette.TYPE}.${this.BUTTON_BG_HOVER}`;
    },
    get COLOR_BUTTON_TEXT_HOVER() {
        return `${Palette.TYPE}.${this.BUTTON_TEXT_HOVER}`;
    },
    get COLOR_BASE_DARK() {
        return `${Palette.TYPE}.${this.BASE_DARK}`;
    },
    get COLOR_BASE_LIGHT() {
        return `${Palette.TYPE}.${this.BASE_LIGHT}`;
    },
    get COLOR_BASE_COMPLEMENTARY() {
        return `${Palette.TYPE}.${this.BASE_COMPLEMENTARY}`;
    },
    get COLOR_GRAY_100() {
        return `${Palette.TYPE}.${this.GRAY_100}`;
    },
    get COLOR_GRAY_200() {
        return `${Palette.TYPE}.${this.GRAY_200}`;
    },
    get COLOR_GRAY_300() {
        return `${Palette.TYPE}.${this.GRAY_300}`;
    },
    get COLOR_GRAY_400() {
        return `${Palette.TYPE}.${this.GRAY_400}`;
    },
    get COLOR_GRAY_500() {
        return `${Palette.TYPE}.${this.GRAY_500}`;
    },
    get COLOR_GRAY_600() {
        return `${Palette.TYPE}.${this.GRAY_600}`;
    },
    get COLOR_GRAY_700() {
        return `${Palette.TYPE}.${this.GRAY_700}`;
    },
    get COLOR_GRAY_800() {
        return `${Palette.TYPE}.${this.GRAY_800}`;
    },
    get COLOR_GRAY_900() {
        return `${Palette.TYPE}.${this.GRAY_900}`;
    },
    get GRADIENT_LIGHT_TO_DARK() {
        return `${Gradient.TYPE}.${this.LIGHT_TO_DARK}`;
    },

    get FONT_FAMILY_BASE() {
        return `${FontFamily.TYPE}.${this.BASE}`;
    },

    get FONT_FAMILY_MONOSPACE() {
        return `${FontFamily.TYPE}.${this.MONOSPACE}`;
    },

    get FONT_SIZE_BASE() {
        return `${FontSize.TYPE}.${this.BASE}`;
    },

    get FONT_SIZE_H1() {
        return `${FontSize.TYPE}.${this.H1}`;
    },

    get FONT_SIZE_H2() {
        return `${FontSize.TYPE}.${this.H2}`;
    },

    get FONT_SIZE_H3() {
        return `${FontSize.TYPE}.${this.H3}`;
    },

    get FONT_SIZE_H4() {
        return `${FontSize.TYPE}.${this.H4}`;
    },

    get FONT_SIZE_H5() {
        return `${FontSize.TYPE}.${this.H5}`;
    },

    get FONT_SIZE_H6() {
        return `${FontSize.TYPE}.${this.H6}`;
    },

    get FONT_SIZE_SMALL() {
        return `${FontSize.TYPE}.${this.SMALL}`;
    },

    get FONT_SIZE_X_SMALL() {
        return `${FontSize.TYPE}.${this.X_SMALL}`;
    },
};
