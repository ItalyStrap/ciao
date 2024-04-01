const {Duotone, Palette} = require('theme-json-generator/dist/Domain/Input/Settings/Color');

function duotone(app) {
    const {presets} = app;

    presets
        .add(
            new Duotone(
                'black-to-white',
                'Black to White',
                presets.get(`${Palette.TYPE}.bodyColor`),
                presets.get(`${Palette.TYPE}.bodyBg`)
            )
        )
        .add(
            new Duotone(
                'white-to-black',
                'White to Black',
                presets.get(`${Palette.TYPE}.bodyBg`),
                presets.get(`${Palette.TYPE}.bodyColor`)
            )
        )
        .add(
            new Duotone(
                'base-to-white',
                'Base to White',
                presets.get(`${Palette.TYPE}.base`),
                presets.get(`${Palette.TYPE}.bodyBg`)
            )
        )
        .add(
            new Duotone(
                'base-to-black',
                'Base to Black',
                presets.get(`${Palette.TYPE}.base`),
                presets.get(`${Palette.TYPE}.bodyColor`)
            )
        );
}

module.exports = {duotone};
