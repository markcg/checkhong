var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */
var nodeDir = './node_modules';
elixir(function(mix) {
    mix.sass(['app.scss'], 'public_html/assets/css/app.css');
//    mix.scripts([nodeDir+'/chart.js/Chart.min.js'],'public_html/assets/js/member/chart.js');
});
