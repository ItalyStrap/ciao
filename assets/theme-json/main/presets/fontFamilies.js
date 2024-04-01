const {FontFamily} = require('theme-json-generator/dist/Domain/Input/Settings/Typography');

function fontFamilies(app) {
    const {presets} = app;

    presets
        .add(
            new FontFamily(
                'base',
                'Default font family',
                'system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", "Liberation Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji"'
            )
        )
        .add(
            new FontFamily(
                'monospace',
                'Font family for code and pre',
                'SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace'
            )
        );
}

module.exports = {fontFamilies};
