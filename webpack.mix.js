const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application, as well as bundling up your JS files.
 |
 */

// Comming Soon
mix.js('./application/resources/comming-soon/js/app.js', './assets/comming-soon/app.js')
   .sass('./application/resources/comming-soon/sass/app.scss', './assets/comming-soon/app.css');