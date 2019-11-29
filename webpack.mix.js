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

// Front-End
mix.js('./application/resources/front/js/app.js', './assets/front/app.js')
   .sass('./application/resources/front/sass/app.scss', './assets/front/app.css');

// Front-End
mix.js('./application/resources/back/js/app.js', './assets/back/app.js')
   .sass('./application/resources/back/sass/app.scss', './assets/back/app.css');
