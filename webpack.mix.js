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

mix.js('resources/js/app.js', 'public/js');


mix.js('resources/js/jquery.js', 'public/js')
    .js('resources/js/scripts.js', 'public/js')

    .sass('resources/sass/style.scss', 'public/css')

    .scripts([
        'node_modules/bootstrap/dist/js/bootstrap.bundle.min.js',
    ], 'public/js/bootstrap.bundle.min.js')


    if (mix.inProduction()) {
        mix.version();
    }
