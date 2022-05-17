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

mix.combine([
    'resources/assets/plugins/jquery/jquery.min.js',
    'resources/assets/plugins/jquery-ui/jquery-ui.min.js',
    'resources/assets/plugins/bootstrap/js/bootstrap.bundle.min.js',
    'resources/assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js',
    'resources/assets/dist/js/adminlte.js',
    'resources/assets/plugins/toastr/toastr.min.js',
    'resources/assets/plugins/moment/moment.min.js',
    'resources/assets/plugins/select2/js/select2.full.js',
    'resources/assets/plugins/inputmask/jquery.inputmask.min.js',
    'resources/assets/plugins/chart.js/Chart.min.js',
    'resources/assets/dist/js/config.js',
    'resources/assets/dist/js/requests.js',
    'resources/assets/dist/js/custom.js',
    'resources/assets/dist/js/chart.js',
], 'public/js/combine.js')
    .css('resources/css/app.css', 'public/css')
    .version();
