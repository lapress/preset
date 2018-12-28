const mix = require('laravel-mix');
const path = require('path');
const tailwindcss = require('tailwindcss');
const fs = require('fs');

require('laravel-mix-purgecss');

const themes = fs.readdirSync('resources/themes');

themes.forEach(theme => {
    mix.setPublicPath(`./resources/themes/${theme}/public/dist/`);
    const resourcePath = `resources/themes/${theme}/`;
    mix.webpackConfig({
        output: {chunkFilename: 'js/build/[name].[chunkhash].js'}
    });

    mix.sass(resourcePath + '/sass/style.sass', 'css')
        .options({
            extractVueStyles: false,
            autoprefixer: {options: {browsers: ['last 6 versions']}},
            processCssUrls: false,
            postCss: [tailwindcss(`./${resourcePath}/js/tailwind.config.js`)]
        })
        .purgeCss({
            enabled: true,
            globs: [
                path.join(__dirname, resourcePath + '**/*.php'),
            ],
            extensions: ['html', 'js', 'php', 'vue'],
            whitelistPatterns: [
                /-enter-active$/,
                /-leave-active$/,
                /-enter$/,
                /-leave-to$/,
                /flickity/
            ]
        });

    mix.js(resourcePath + 'js/app.js', 'js').version();

});
