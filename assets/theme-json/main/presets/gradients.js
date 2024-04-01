const {Gradient, Palette} = require('theme-json-generator/dist/Domain/Input/Settings/Color');
const {LinearGradient} = require('theme-json-generator/dist/Domain/Input/Settings/Color/Utilities');

function gradients(app) {
    const {presets} = app;

    presets
        .add(
            new Gradient(
                'light-to-dark',
                'Black to white',
                new LinearGradient('160deg', presets.get(`${Palette.TYPE}.light`), presets.get(`${Palette.TYPE}.dark`))
            )
        )
        .add(
            new Gradient(
                'base-to-white',
                'Base to white',
                new LinearGradient(
                    '135deg',
                    presets.get(`${Palette.TYPE}.base`),
                    presets.get(`${Palette.TYPE}.baseDark`)
                )
            )
        );
}

module.exports = {gradients};
