let mix = require('laravel-mix');

mix.postCss('resources/css/app.css', 'public/css');
mix.minify('public/css/app.css');
mix.sass('resources/scss/style.scss', 'public/css');
