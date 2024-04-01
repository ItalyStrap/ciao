const {CustomToPresets} = require('theme-json-generator/dist/Domain/Input/Settings/Custom');
const {Palette} = require('theme-json-generator/dist/Domain/Input/Settings/Color');
const {FontSize} = require('theme-json-generator/dist/Domain/Input/Settings/Typography');

function customs(app) {
    const {presets} = app;

    new CustomToPresets(presets, {
        contentSize: 'clamp(16rem, 60vw, 60rem)',
        wideSize: 'clamp(16rem, 85vw, 70rem)',
        baseFontSize: '1rem',
        spacer: {
            base: '1rem',
            v: 'calc( {{spacer.base}} * 4 )',
            h: 'calc( {{spacer.base}} * 4 )',
            s: 'calc( {{spacer.base}} / 1.5 )',
            m: 'calc( {{spacer.base}} * 2 )',
            l: 'calc( {{spacer.base}} * 3 )',
            xl: 'calc( {{spacer.base}} * 4 )',
        },
        lineHeight: {
            base: '1.5',
            xs: '1.1',
            s: '1.3',
            m: '{{lineHeight.base}}',
            l: '1.7',
        },
        body: {
            bg: presets.get(`${Palette.TYPE}.base`),
            text: presets.get(`${Palette.TYPE}.bodyBg`),
        },
        link: {
            bg: presets.get(`${Palette.TYPE}.base`),
            text: presets.get(`${Palette.TYPE}.bodyBg`),
            decoration: 'underline',
            hover: {
                text: presets.get(`${Palette.TYPE}.bodyColor`),
                decoration: 'underline',
            },
        },
        button: {
            bg: presets.get(`${Palette.TYPE}.base`),
            text: presets.get(`${Palette.TYPE}.buttonTextHover`),
            borderColor: 'transparent',
            borderRadius: `calc(${presets.get(`${FontSize.TYPE}.base`)} / 3)`,
            hover: {
                bg: presets.get(`${Palette.TYPE}.buttonBgHover`),
                text: presets.get(`${Palette.TYPE}.buttonTextHover`),
                borderColor: 'transparent',
            },
            padding: {
                h: '0.75em',
                v: '0.375em',
            },
        },
        form: {
            border: {
                color: '',
                width: '',
            },
            input: {
                color: '',
            },
        },
        navbar: {
            min: {
                height: 'calc( {{spacer.base}} * 5.3125 )',
            },
        },
    }).process();
}

module.exports = {customs};
