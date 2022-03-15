const { css } = require('laravel-mix');
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

mix.js('resources/js/app.js', 'public/js')
    .vue()
    .sass('resources/sass/app.scss', 'public/css')
    .copy(
        'node_modules/@fortawesome/fontawesome-free/webfonts',
        'public/webfonts'
    )
    .css('resources/css/main.css', 'public/css/main.css')
    .js('resources/js/init.js', 'public/js/init.js')
    .js('resources/js/Overworld.js', 'public/js/Overworld.js')
    .copy('resources/images/maps/', 'public/images/maps/')
    .copy('resources/images/heroes/', 'public/images/heroes/')
    .copy('resources/images/heroes/hero_mini/', 'public/images/heroes/hero_mini/')
    .copy('resources/songs', 'public/songs')
    .copy('resources/images', 'public/images');