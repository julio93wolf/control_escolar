<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Home
Route::get('/',function(){return redirect(route('showLoginForm'));})->name('home');

// LogIn
Route::get('/login','Auth\LoginController@showLoginForm')->name('showLoginForm');
Route::post('/login','Auth\LoginController@login')->name('login');

// LogOut
Route::get('/logout','Auth\LoginController@logout')->name('logout');

Route::group(['middleware' => ['login']], function () {
	
	// Admin
	Route::prefix('admin')->group(function () {
		
		// Menu Principal
		Route::get('menu','Admin\MenuController@index')->name('admin.menu');

		// Academicos
		Route::prefix('academicos')->group(function () {

			// Estudiantes
			Route::resource('estudiantes','Admin\Academicos\EstudianteController')
				->except(['show','destroy']);

			// InstitutosProcedencias
			Route::resource('institutos_procedencias','Admin\Academicos\InstitutoProcedenciaController')
				->only('store');

			// Empresas
			Route::resource('empresas','Admin\Academicos\EmpresaController')
				->only('store');

			// Kardex
			Route::resource('kardex','Admin\Academicos\KardexController')
				->only('index');

			// Docentes
			Route::resource('docentes','Admin\Academicos\DocenteController')
				->except('show');

			// Clases
			Route::resource('clases','Admin\Academicos\ClaseController')
				->except('show');

			// Grupos
			Route::resource('grupos','Admin\Academicos\GrupoController')
				->only(['index','store','destroy']);
			Route::get('estudiante','Admin\Academicos\GrupoEstudianteController@get')
				->name('estudiante.get');

		});

		// Escolares
		Route::prefix('escolares')->group(function () {

			// Asignaturas
			Route::resource('asignaturas','Admin\Escolares\AsignaturaController')
				->only(['index', 'store', 'update']);

			// Periodos
			Route::resource('periodos','Admin\Escolares\PeriodoController')
				->except('show');
			Route::prefix('periodos')->group(function () {
				
				Route::resource('fechas_examenes','Admin\Escolares\FechaExamenController')
					->only(['index', 'store', 'update', 'destroy']);

			});

			// Especialidades
			Route::resource('especialidades','Admin\Escolares\EspecialidadController')
				->only(['index','store','update']);
			
			// PlanEspecialidad
			Route::resource('/planes_especialidades','Admin\Escolares\PlanEspecialidadController');

			// Reticulas
			Route::resource('reticulas','Admin\Escolares\ReticulaController')
				->only(['store','destroy']);
			Route::get('reticulas/asignaturas','Admin\Escolares\AsignaturaReticulaController@asignaturas_periodo')
				->name('reticulas.asignaturas');
			Route::get('reticulas/asignaturas_requisito/{reticula_id}','Admin\Escolares\AsignaturaReticulaController@asignaturas_requisito')
				->name('reticulas.asignaturas_requisito');

			// Requisitos
			Route::resource('requisitos_reticulas','Admin\Escolares\RequisitoReticulaController')
			->only(['store','destroy']);

		});

		// Configuraciones
		Route::prefix('configuraciones')->group(function () {

			// Estados de estudiantes
			Route::resource('estados_estudiantes','Admin\Configuraciones\EstadoEstudianteController')
				->only(['index','store','update','destroy']);

			// Títulos del docente
			Route::resource('titulos_docentes','Admin\Configuraciones\TituloDocenteController')
				->only(['index','store','update','destroy']);

			// Títulos del docente
			Route::resource('tipos_examenes','Admin\Configuraciones\TipoExamenController')
				->only(['index','store','update','destroy']);

			// Oportunidades
			Route::resource('oportunidades','Admin\Configuraciones\OportunidadController')
				->only(['index','store','update','destroy']);

			// Niveles y grados
			Route::resource('niveles_academicos','Admin\Configuraciones\NivelAcademicoController')
				->only(['index','store','update','destroy']);

		});

		// Datatable
		Route::prefix('datatable')->group(function () {

			// Estudiantes
			Route::get('estudiantes','Admin\DataTableController@estudiantes')
				->name('estudiantes.get');
			
			// Asignaturas
			Route::get('asignaturas','Admin\DataTableController@asignaturas')
				->name('asignatuas.get');

			// Periodos
			Route::get('periodos','Admin\DataTableController@periodos')
				->name('periodos.get');

			// Fechas de Examenes
			Route::get('fechas_examenes/{periodo_id}','Admin\DataTableController@fechas_examenes')
				->name('fechas_examenes.get');

			// Especialidades
			Route::get('especialidades','Admin\DataTableController@especialidades')
				->name('especialidades.get');

			// Planes especialidades
			Route::get('planes_especialidades/{especialidad_id}','Admin\DataTableController@planes_especialidades')
				->name('planes_especialidades.get');

			// Docentes
			Route::get('docentes','Admin\DataTableController@docentes')
				->name('docentes.get');

			// Clases
			Route::get('clases','Admin\DataTableController@clases')
				->name('clases.get');

			// Kardex
			Route::get('kardex/{estudiante_id}','Admin\DataTableController@kardex')
				->name('kardex.get');

			// Grupos
			Route::get('grupos','Admin\DataTableController@grupos')
				->name('grupos.get');

			// Estados de estudiantes
			Route::get('estados_estudiantes','Admin\DataTableController@estados_estudiantes')
				->name('estados_estudiantes.get');

			// Títulos de docentes
			Route::get('titulos_docentes','Admin\DataTableController@titulos_docentes')
				->name('titulos_docentes.get');

			// Títulos de docentes
			Route::get('tipos_examenes','Admin\DataTableController@tipos_examenes')
				->name('tipos_examenes.get');

			// Oportunidades
			Route::get('oportunidades','Admin\DataTableController@oportunidades')
				->name('oportunidades.get');


			// Oportunidades
			Route::get('niveles_academicos','Admin\DataTableController@niveles_academicos')
				->name('niveles_academicos.get');

		});

		// Selects
		Route::prefix('select')->group(function () {

			// Especialidades
			Route::get('especialidades_nivel/{nivel_academico}','Admin\SelectController@especialidades_nivel')
				->name('select.especialidades_nivel');

			// Especialidades
			Route::get('planes_especialidades/{especialidad_id}','Admin\SelectController@planes_especialidades')
				->name('select.planes_especialidades');

			// Asignaturas Reticula
			Route::get('asignaturas_reticula/{plan_especialidad_id}','Admin\SelectController@asignaturas_reticula')
				->name('select.asignaturas_reticula');

			// Asignaturas Requisito
			Route::get('asignaturas_requisito/{reticula_id}','Admin\SelectController@asignaturas_requisito')
				->name('select.asignaturas_requisito');

			// Municipios
			Route::get('municipios/{estado_id}','Admin\SelectController@municipios')
				->name('select.municipios');

			// Localidades
			Route::get('localidades/{municipio_id}','Admin\SelectController@localidades')
				->name('select.localidades');

		});
		
	});
});