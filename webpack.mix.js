const mix = require('laravel-mix');
const webpack = require('webpack');
const path = require('path');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

const environment = mix.inProduction() ? 'prod' : 'dev';

mix.options({
        terser: {
            terserOptions: {
                compress: {
                    drop_console: true,
                },
            },
        },
    })
    .setPublicPath(`dist/${environment}`)
    .js('resources/js/app.js', 'public/js')
    .vue()
    .postCss("resources/css/app.css", "public/css/gaming-engine.css", [
        require("tailwindcss"),
    ])
    .version()
    .webpackConfig({
        resolve: {
            symlinks: false,
            alias: {
                '@': path.resolve(__dirname, 'resources/js/'),
            },
        },
        plugins: [new webpack.IgnorePlugin(/^\.\/locale$/, /moment$/)],
    });
