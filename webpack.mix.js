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



//Vendor

mix.styles([
	'resources/assets/css/vendor/materialize.css',
	'resources/assets/css/vendor/datatables.css',
	'resources/assets/css/vendor/select2-materialize.css'
], 'public/css/vendor.css');

mix.scripts([
	'resources/assets/js/vendor/jquery-3.3.1.js',
	'resources/assets/js/vendor/datatables.js',
	'resources/assets/js/vendor/materialize.js',
	'resources/assets/js/vendor/sweetalert2.js',
	'resources/assets/js/vendor/select2.js'
],'public/js/vendor.js');

//App

mix.styles([
	'resources/assets/css/app/app.css'
],'public/css/app.css');

mix.scripts([
	'resources/assets/js/app/app.js'
],'public/js/app.js');

// Asignaturas

mix.scripts([
	'resources/assets/js/app/asignaturas.js'
],'public/js/asignaturas.js');

