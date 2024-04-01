const {colors} = require('./assets/theme-json/main/presets/colors');
const {duotone} = require('./assets/theme-json/main/presets/duotone');
const {gradients} = require('./assets/theme-json/main/presets/gradients');
const {fontSizes} = require('./assets/theme-json/main/presets/fontSizes');
const {fontFamilies} = require('./assets/theme-json/main/presets/fontFamilies');
const {customs} = require('./assets/theme-json/main/presets/customs');
const {title} = require('./assets/theme-json/main/title');

const {SectionNames, Styles} = require('theme-json-generator');
// console.log('Styles', Styles)
// console.log('SectionNames', SectionNames)

module.exports = (app) => {
    const {blueprint, presets} = app;

    colors(app);
    duotone(app);
    gradients(app);
    fontSizes(app);
    fontFamilies(app);
    // @todo: In case the value is not registered for example calling into custom render null as value, check this behavior better, see "borderRadius": `calc(${presets.get('fontSize.base')} / 3)`,
    customs(app);

    blueprint.merge({
        [SectionNames.SCHEMA]: 'https://schemas.wp.org/trunk/theme.json',
        [SectionNames.VERSION]: 2,
        [SectionNames.TITLE]: 'Experimental Theme',
        [SectionNames.DESCRIPTION]: 'Experimental Theme',
        [SectionNames.SETTINGS]: {
            color: {
                custom: true,
                link: true,
            },
            typography: {
                customFontSize: true,
            },
            spacing: {
                blockGap: true,
                units: ['%', 'px', 'em', 'rem', 'vh', 'vw'],
            },
            layout: {
                contentSize: 'var(--wp--custom--content-size)',
                wideSize: 'var(--wp--custom--wide-size)',
            },
            blocks: {
                'core/button': {
                    color: {
                        custom: false,
                    },
                },
                'core/navigation': {
                    color: {
                        custom: false,
                    },
                },
            },
        },
        [SectionNames.STYLES]: {
            css: 'background:#000000;',
            color: {
                background: 'var(--wp--preset--color--body-bg)',
                text: 'var(--wp--preset--color--body-color)',
            },
            typography: {
                fontFamily: 'var(--wp--preset--font-family--base)',
                fontSize: 'var(--wp--preset--font-size--base)',
                fontStyle: 'normal',
                fontWeight: '400',
                letterSpacing: 'normal',
                lineHeight: 'var(--wp--custom--line-height--m)',
                textDecoration: 'none',
                textTransform: 'none',
            },
            spacing: {
                blockGap: 'var(--wp--custom--spacer--m)',
                margin: {
                    top: '0px',
                    right: '0px',
                    bottom: '0px',
                    left: '0px',
                },
                padding: {
                    top: '0px',
                    right: '0px',
                    bottom: '0px',
                    left: '0px',
                },
            },
            elements: {
                link: {
                    color: {
                        text: 'var(--wp--preset--color--link-color)',
                        background: 'transparent',
                    },
                },
                h1: {
                    typography: {
                        fontSize: 'var(--wp--preset--font-size--h-1)',
                    },
                },
                h2: {
                    typography: {
                        fontSize: 'var(--wp--preset--font-size--h-2)',
                    },
                },
                h3: {
                    typography: {
                        fontSize: 'var(--wp--preset--font-size--h-3)',
                    },
                },
                h4: {
                    typography: {
                        fontSize: 'var(--wp--preset--font-size--h-4)',
                    },
                },
                h5: {
                    typography: {
                        fontSize: 'var(--wp--preset--font-size--h-5)',
                    },
                },
                h6: {
                    typography: {
                        fontSize: 'var(--wp--preset--font-size--h-6)',
                    },
                },
                heading: {
                    typography: {
                        fontSize: 'var(--wp--preset--font-size--h-6)',
                        fontFamily: 'var(--wp--preset--font-family--base)',
                        fontWeight: '700',
                        lineHeight: 'var(--wp--custom--line-height--xs)',
                    },
                    spacing: {
                        margin: {
                            top: 'var(--wp--custom--spacer--s)',
                            bottom: '0',
                        },
                    },
                    color: {
                        text: 'var(--wp--preset--color--heading-color)',
                    },
                },
                button: {
                    border: {
                        color: 'var(--wp--custom--button--border-color)',
                        radius: 'var(--wp--custom--button--border-radius)',
                        style: 'solid',
                        width: '1px',
                    },
                    color: {
                        background: 'var(--wp--custom--button--bg)',
                        text: 'var(--wp--custom--button--text)',
                    },
                    spacing: {
                        padding: {
                            top: 'var(--wp--custom--button--padding--v)',
                            bottom: 'var(--wp--custom--button--padding--v)',
                            right: 'var(--wp--custom--button--padding--h)',
                            left: 'var(--wp--custom--button--padding--h)',
                        },
                    },
                    typography: {
                        fontFamily: 'var(--wp--preset--font-family--base)',
                        fontSize: 'var(--wp--preset--font-size--base)',
                        textDecoration: 'none',
                        lineHeight: 'var(--wp--custom--line-height--s)',
                    },
                    ':hover': {
                        color: {
                            background: 'var(--wp--custom--button--hover--bg)',
                            text: 'var(--wp--custom--button--hover--text)',
                        },
                        border: {
                            color: {
                                background: 'var(--wp--custom--button--hover--bg)',
                                text: 'var(--wp--custom--button--hover--border-color)',
                            },
                        },
                    },
                    ':active': {
                        color: {
                            background: 'var(--wp--custom--button--hover--bg)',
                            text: 'var(--wp--custom--button--hover--text)',
                        },
                        border: {
                            color: {
                                background: 'var(--wp--custom--button--hover--bg)',
                                text: 'var(--wp--custom--button--hover--border-color)',
                            },
                        },
                    },
                    ':focus': {
                        color: {
                            background: 'var(--wp--custom--button--hover--bg)',
                            text: 'var(--wp--custom--button--hover--text)',
                        },
                        border: {
                            color: {
                                background: 'var(--wp--custom--button--hover--bg)',
                                text: 'var(--wp--custom--button--hover--border-color)',
                            },
                        },
                        outline: {
                            color: 'var(--wp--preset--color--body-color-300)',
                            offset: '1px',
                            style: 'dotted',
                            width: '1px',
                        },
                    },
                },
            },
            blocks: {
                'core/paragraph': {
                    spacing: {
                        margin: {
                            top: 'var(--wp--custom--spacer--m)',
                            bottom: '0px',
                        },
                    },
                },
                'core/file': {
                    spacing: {
                        margin: {
                            top: 'var(--wp--custom--spacer--m)',
                        },
                    },
                    typography: {
                        fontFamily: 'var(--wp--preset--font-family--base)',
                        fontSize: 'var(--wp--preset--font-size--base)',
                        lineHeight: 'var(--wp--custom--line-height--s)',
                    },
                    elements: {
                        link: {
                            color: {
                                text: 'var(--wp--preset--color--base)',
                                background: 'transparent',
                            },
                        },
                    },
                },
                'core/code': {
                    typography: {
                        fontFamily: 'var(--wp--preset--font-family--monospace)',
                    },
                    spacing: {
                        margin: {
                            top: 'var(--wp--custom--spacer--l)',
                        },
                        padding: {
                            top: 'var(--wp--custom--spacer--v)',
                            right: 'var(--wp--custom--spacer--h)',
                            bottom: 'var(--wp--custom--spacer--v)',
                            left: 'var(--wp--custom--spacer--h)',
                        },
                    },
                    border: {
                        color: 'var(--wp--preset--color--border-color)',
                        radius: '0px',
                        style: 'solid',
                        width: '1px',
                    },
                },
                'core/quote': {
                    border: {
                        color: 'var(--wp--preset--color--body-color)',
                        style: 'solid',
                        width: '0 0 0 1px',
                    },
                    spacing: {
                        margin: {
                            top: 'var(--wp--custom--spacer--l)',
                        },
                        padding: {
                            top: 'var(--wp--custom--spacer--h)',
                        },
                    },
                    typography: {
                        fontFamily: 'var(--wp--preset--font-family--monospace)',
                        fontSize: 'var(--wp--preset--font-size--base)',
                        fontStyle: 'normal',
                    },
                },
                'core/group': {
                    spacing: {
                        margin: {
                            top: '0 !important',
                            right: '0 !important',
                            bottom: '0 !important',
                            left: '0 !important',
                        },
                    },
                },
                'core/template-part': {
                    spacing: {
                        margin: {
                            top: '0 !important',
                            right: '0 !important',
                            bottom: '0 !important',
                            left: '0 !important',
                        },
                        padding: {
                            top: '0 !important',
                            right: '0 !important',
                            bottom: '0 !important',
                            left: '0 !important',
                        },
                    },
                },
                'core/button': {
                    css: 'display: inline-block;\ntext-align: center;\ntransition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out;\nvertical-align: middle;\ncursor: pointer;\n-webkit-user-select: none;\n-ms-user-select: none;\nuser-select: none;\nword-break: break-word;\n',
                    variations: {
                        outline: {
                            border: {
                                color: 'var(--wp--preset--color--base)',
                                radius: 'var(--wp--custom--button--border-radius)',
                                style: 'solid',
                                width: '1px',
                            },
                            color: {
                                background: 'var(--wp--preset--color--body-bg)',
                                text: 'var(--wp--preset--color--base)',
                            },
                            spacing: {
                                padding: {
                                    top: 'var(--wp--custom--button--padding--v)',
                                    bottom: 'var(--wp--custom--button--padding--v)',
                                    right: 'var(--wp--custom--button--padding--h)',
                                    left: 'var(--wp--custom--button--padding--h)',
                                },
                            },
                        },
                    },
                },
                'core/site-title': {
                    color: {
                        text: 'var(--wp--preset--color--heading-color)',
                    },
                    typography: {
                        fontSize: 'var(--wp--preset--font-size--h-1)',
                        fontWeight: '600',
                    },
                },
                'core/post-title': {
                    color: {
                        text: 'var(--wp--preset--color--heading-color)',
                    },
                    typography: {
                        fontSize: 'var(--wp--preset--font-size--h-1)',
                    },
                    elements: {
                        link: {
                            color: {
                                text: 'inherit',
                                background: 'transparent',
                            },
                        },
                    },
                },
                'core/query-title': {
                    color: {
                        text: 'var(--wp--preset--color--body-color-400)',
                    },
                    typography: {
                        fontSize: 'var(--wp--preset--font-size--h-5)',
                        fontWeight: '700',
                    },
                },
                'core/post-content': {
                    color: {
                        text: 'inherit',
                    },
                },
                'core/post-excerpt': {
                    color: {
                        text: 'inherit',
                    },
                },
                'core/post-comments': {
                    color: {
                        text: 'var(--wp--preset--color--body-color)',
                    },
                    typography: {
                        fontSize: 'var(--wp--preset--font-size--base)',
                        fontWeight: '300',
                    },
                },
                'core/post-date': {
                    color: {
                        text: 'var(--wp--preset--color--body-color-200)',
                    },
                    typography: {
                        fontSize: 'var(--wp--preset--font-size--x-small)',
                    },
                },
                'core/post-terms': {
                    color: {
                        text: 'var(--wp--preset--color--body-color-200)',
                    },
                    typography: {
                        fontSize: 'var(--wp--preset--font-size--x-small)',
                    },
                    elements: {
                        link: {
                            color: {
                                text: 'var(--wp--preset--color--body-color-200)',
                                background: 'transparent',
                            },
                            typography: {
                                fontSize: 'var(--wp--preset--font-size--x-small)',
                                textDecoration: 'none',
                            },
                        },
                    },
                },
                'core/post-author': {
                    border: {
                        color: 'var(--wp--preset--color--body-color-700)',
                        style: 'solid',
                        width: '1px',
                    },
                    color: {
                        text: 'var(--wp--preset--color--body-color)',
                        background: 'var(--wp--preset--color--body-color-900)',
                    },
                    typography: {
                        fontSize: 'var(--wp--preset--font-size--small)',
                        textDecoration: 'none',
                    },
                    spacing: {
                        padding: {
                            top: 'var(--wp--custom--spacer--m)',
                            right: 'var(--wp--custom--spacer--m)',
                            bottom: 'var(--wp--custom--spacer--m)',
                            left: 'var(--wp--custom--spacer--m)',
                        },
                    },
                },
                'core/navigation': {
                    color: {
                        text: 'var(--wp--preset--color--body-color)',
                        background: 'var(--wp--preset--color--body-bg)',
                    },
                    spacing: {
                        padding: {
                            top: '1.1rem',
                            bottom: '1.1rem',
                        },
                    },
                    typography: {
                        fontSize: 'var(--wp--preset--font-size--x-small)',
                        fontWeight: '400',
                        textTransform: 'uppercase',
                    },
                },
                'core/site-logo': {
                    spacing: {
                        margin: {
                            top: '0px',
                            right: '0px',
                            bottom: '0px',
                            left: '0px',
                        },
                        padding: {
                            top: '0px',
                            right: '0px',
                            bottom: '0px',
                            left: '0px',
                        },
                    },
                },
                'core/image': {
                    spacing: {
                        margin: {
                            top: 'var(--wp--custom--spacer--m)',
                            bottom: '0px',
                        },
                    },
                },
                'core/post-featured-image': {
                    spacing: {
                        margin: {
                            top: 'var(--wp--custom--spacer--m)',
                            bottom: '0px',
                        },
                    },
                },
                'core/gallery': {
                    spacing: {
                        margin: {
                            top: 'var(--wp--custom--spacer--m)',
                            bottom: '0px',
                        },
                    },
                },
                'core/spacer': {
                    color: {
                        text: 'var(--wp--preset--color--body-color)',
                    },
                    border: {
                        color: 'currentColor',
                        style: 'solid',
                        width: '0 0 0 0',
                    },
                },
                'core/separator': {
                    border: {
                        color: 'var(--wp--preset--color--body-color-700)',
                        style: 'solid',
                        width: '0 0 1px 0',
                    },
                },
                'core/term-description': {
                    typography: {
                        fontSize: 'var(--wp--preset--font-size--x-small)',
                    },
                    spacing: {
                        margin: {
                            top: '0px !important',
                            right: '0px !important',
                            bottom: '0px !important',
                            left: '0px !important',
                        },
                    },
                    color: {
                        text: 'var(--wp--preset--color--body-color-400)',
                    },
                },
                'core/site-tagline': {
                    color: {
                        text: 'var(--wp--preset--color--body-color)',
                    },
                    typography: {
                        fontSize: 'var(--wp--preset--font-size--h-3)',
                        fontWeight: '600',
                    },
                },
            },
        },
        [SectionNames.TEMPLATE_PARTS]: [
            {
                name: 'header',
                area: 'header',
            },
            {
                name: 'singular-header',
                area: 'header',
            },
            {
                name: 'footer',
                area: 'footer',
            },
        ],
        [SectionNames.CUSTOM_TEMPLATES]: [
            {
                name: 'blank',
                title: 'Blank',
                postTypes: ['page', 'post'],
            },
        ],
    });

    title(app);
};
