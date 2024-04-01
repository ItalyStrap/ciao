const keys = require('../keys');

function title(app) {
    const {blueprint, presets, color, typography} = app;

    blueprint.setBlockStyle('core/site-title', {
        color: color.text(keys.COLOR_HEADING_TEXT),
        typography: typography.fontSize(keys.FONT_SIZE_H1).fontWeight('600'),
    });

    blueprint.setBlockStyle('core/post-title', {
        // .wp-block-post-title
        color: color.text(keys.COLOR_HEADING_TEXT),
        typography: typography.fontSize(keys.FONT_SIZE_H1),
        elements: {
            link: {
                color: color.text('inherit').background('transparent'),
            },
        },
    });

    /**
     * Title for queried object {Author page}
     * <!-- wp:query-title {"type":"author"} /-->
     * .wp-block-query-title
     */
    blueprint.setBlockStyle('core/query-title', {
        color: color.text(keys.COLOR_GRAY_400),
        typography: typography.fontSize(keys.FONT_SIZE_H5).fontWeight('700'),
    });
}

module.exports = {title};
