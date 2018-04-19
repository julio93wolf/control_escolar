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

/** Vendor  **/
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

/** App  **/
mix.styles([
	'resources/assets/css/app/app.css'
],'public/css/app.css');
mix.scripts([
	'resources/assets/js/app/app.js'
],'public/js/app.js');

/** Admin **/

	/** Academicos **/

		/** Docentes  **/
		mix.scripts([
			'resources/assets/js/app/admin/academicos/docentes.js'
		],'public/js/admin/academicos/docentes.js');
		mix.scripts([
			'resources/assets/js/app/admin/academicos/form.docentes.js'
		],'public/js/admin/academicos/form.docentes.js');

		/** Clases  **/
		mix.scripts([
			'resources/assets/js/app/admin/academicos/clases.js'
		],'public/js/admin/academicos/clases.js');
		mix.scripts([
			'resources/assets/js/app/admin/academicos/form.clases.js'
		],'public/js/admin/academicos/form.clases.js');

		/** Grupos  **/
		mix.scripts([
			'resources/assets/js/app/admin/academicos/grupos.js'
		],'public/js/admin/academicos/grupos.js');

		/** Estudiantes  **/
		mix.scripts([
			'resources/assets/js/app/admin/academicos/estudiantes.js'
		],'public/js/admin/academicos/estudiantes.js');
		mix.scripts([
			'resources/assets/js/app/admin/academicos/form.estudiantes.js'
		],'public/js/admin/academicos/form.estudiantes.js');

		/** Kardex  **/
		mix.scripts([
			'resources/assets/js/app/admin/academicos/kardex.js'
		],'public/js/admin/academicos/kardex.js');


	/** Escolares **/

		/**  Asignaturas  **/
		mix.scripts([
			'resources/assets/js/app/admin/escolares/asignaturas.js'
		],'public/js/admin/escolares/asignaturas.js');

		/**  Periodos  **/
		mix.scripts([
			'resources/assets/js/app/admin/escolares/periodos.js'
		],'public/js/admin/escolares/periodos.js');
		mix.scripts([
			'resources/assets/js/app/admin/escolares/form.periodo.js'
		],'public/js/admin/escolares/form.periodo.js');

		/** Fechas Examenes  **/
		mix.scripts([
			'resources/assets/js/app/admin/escolares/fechas_examenes.js'
		],'public/js/admin/escolares/fechas_examenes.js');

		/** Especialidades  **/
		mix.scripts([
			'resources/assets/js/app/admin/escolares/especialidades.js'
		],'public/js/admin/escolares/especialidades.js');

		/** Planes especialidades  **/
		mix.scripts([
			'resources/assets/js/app/admin/escolares/planes_especialidades.js'
		],'public/js/admin/escolares/planes_especialidades.js');

		/** Reticulas  **/
		mix.scripts([
			'resources/assets/js/app/admin/escolares/reticulas.js'
		],'public/js/admin/escolares/reticulas.js');

	/** Configuraciones **/

		/** Estados estudiantes  **/
		mix.scripts([
			'resources/assets/js/app/admin/configuraciones/estados_estudiantes.js'
		],'public/js/admin/configuraciones/estados_estudiantes.js');

		/** Títulos del docente  **/
		mix.scripts([
			'resources/assets/js/app/admin/configuraciones/titulos_docentes.js'
		],'public/js/admin/configuraciones/titulos_docentes.js');

		/** Tipos de examenes  **/
		mix.scripts([
			'resources/assets/js/app/admin/configuraciones/tipos_examenes.js'
		],'public/js/admin/configuraciones/tipos_examenes.js');

		/** Oportunidades  **/
		mix.scripts([
			'resources/assets/js/app/admin/configuraciones/oportunidades.js'
		],'public/js/admin/configuraciones/oportunidades.js');

		/** Niveles academicos  **/
		mix.scripts([
			'resources/assets/js/app/admin/configuraciones/niveles_academicos.js'
		],'public/js/admin/configuraciones/niveles_academicos.js');