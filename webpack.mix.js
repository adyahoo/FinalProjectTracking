const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js').postCss('resources/css/app.css', 'public/css', [
    require('postcss-import'),
    require('tailwindcss'),
    require('autoprefixer'),
]);

mix.sass('resources/scss/auth/auth.scss', 'public/css/auth')
    .sass('resources/scss/blog/layout.scss', 'public/css/blog')
    .sass('resources/scss/blog/banner.scss', 'public/css/blog')
    .sass('resources/scss/blog/home/home.scss', 'public/css/blog/home')
    .js('resources/js/blog/layout.js', 'public/js/blog')
    .js('resources/js/blog/swiper-js.js', 'public/js/blog')
    .sourceMaps(true, 'source-map');

mix.version();