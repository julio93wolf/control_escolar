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
	'resources/assets/css/vendor/select2-materialize.css',
	'resources/assets/css/vendor/dropify.css'
], 'public/css/vendor.css');
mix.scripts([
	'resources/assets/js/vendor/jquery-3.3.1.js',
	'resources/assets/js/vendor/datatables.js',
	'resources/assets/js/vendor/materialize.js',
	'resources/assets/js/vendor/sweetalert2.js',
	'resources/assets/js/vendor/select2.js',
	'resources/assets/js/vendor/dropify.js'
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

// Periodos
mix.scripts([
	'resources/assets/js/app/periodos.js'
],'public/js/periodos.js');
mix.scripts([
	'resources/assets/js/app/form.periodo.js'
],'public/js/form.periodo.js');

//Fechas Examenes
mix.scripts([
	'resources/assets/js/app/fechas_examenes.js'
],'public/js/fechas_examenes.js');

//Especialidades
mix.scripts([
	'resources/assets/js/app/especialidades.js'
],'public/js/especialidades.js');

//Planes especialidades
mix.scripts([
	'resources/assets/js/app/planes_especialidades.js'
],'public/js/planes_especialidades.js');

//Reticulas
mix.scripts([
	'resources/assets/js/app/reticulas.js'
],'public/js/reticulas.js');

//Docentes
mix.scripts([
	'resources/assets/js/app/docentes.js'
],'public/js/docentes.js');

//Docentes
mix.scripts([
	'resources/assets/js/app/form.docentes.js'
],'public/js/form.docentes.js');

//Clases
mix.scripts([
	'resources/assets/js/app/clases.js'
],'public/js/clases.js');

//Clases
mix.scripts([
	'resources/assets/js/app/form.clases.js'
],'public/js/form.clases.js');

//Estudiantes
mix.scripts([
	'resources/assets/js/app/estudiantes.js'
],'public/js/estudiantes.js');

//Estudiantes
mix.scripts([
	'resources/assets/js/app/form.estudiantes.js'
],'public/js/form.estudiantes.js');