let mix = require('laravel-mix');

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




mix.scripts([
	'resources/assets/js/vendor/vue.js',
	'resources/assets/js/vendor/axios.js',
	'resources/assets/js/vendor/jquery-3.3.1.js',
	'resources/assets/js/vendor/datatables.js',
	//'resources/assets/js/vendor/dataTables.materialize.js',
	'resources/assets/js/vendor/materialize.js'
],'public/js/vendor.js');

mix.styles([
	'resources/assets/css/vendor/materialize.css',
	'resources/assets/css/vendor/datatables.css',
	//'resources/assets/css/vendor/dataTables.materialize.css',
], 'public/css/vendor.css');

mix.styles([
	'resources/assets/css/app.css'
],'public/css/app.css');