let mix = require('laravel-mix');

mix.sass('resources/assets/sass/app.scss', 'public/assets/css/app.css')
mix.sass('resources/assets/sass/fontawesome/scss/fontawesome.scss', 'public/assets/css/fontawesome.css')

mix.js('resources/assets/js/bootstrap.bundle.js', 'public/assets/js/bootstrap.bundle.js')
    .js('resources/assets/js/app.js', 'public/assets/js/app.js')
    .js('resources/assets/js/fontawesome/js/all.min.js', 'public/assets/js/all.min.js')
