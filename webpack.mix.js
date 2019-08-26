const mix = require('laravel-mix');

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

mix.js('resources/sys/src/app.js', 'public/js/sys.js')
    .webpackConfig({
        resolve: {
            alias: {
                '@': path.resolve('resources')
            }
        }
    })
    .js('resources/front/src/app.js', 'public/js/app.js')
