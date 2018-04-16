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

//Home
Route::get('/',function(){return redirect(route('showLoginForm'));})->name('home');

//Login
Route::get('/login','Auth\LoginController@showLoginForm')->name('showLoginForm');
Route::post('/login','Auth\LoginController@login')->name('login');
Route::get('/logout','Auth\LoginController@logout')->name('logout');

Route::group(['middleware' => ['login']], function () {
	
	Route::prefix('admin')->group(function () {
		
		//Menu Principal (Admin)
		Route::get('menu','Admin\MenuController@index')->name('admin.menu');

		//Academicos
		Route::prefix('academicos')->group(function () {

			//Estudiantes
			Route::resource('estudiantes','Admin\EstudianteController');

			//Docentes
			Route::resource('docentes','Admin\DocenteController');

			//Clases
			Route::resource('clases','Admin\ClaseController');

			//Empresas
			Route::resource('empresas','Admin\EmpresaController')->only('store');

			//InstitutosProcedencias
			Route::resource('institutos_procedencias','Admin\InstitutoProcedenciaController')->only('store');


		});

		//Escolares
		Route::prefix('escolares')->group(function () {

			//Asignaturas
			Route::resource('asignaturas','Admin\AsignaturaController')->only([
    		'index', 'store', 'update'
			]);

			//Periodos
			Route::resource('periodos','Admin\PeriodoController')->except('show');
			Route::prefix('periodos')->group(function () {

				Route::resource('fechas_examenes','Admin\FechaExamenController')->only([
    			'index', 'store', 'update', 'destroy'
				]);

			});

			//Especialidades
			Route::resource('especialidades','Admin\EspecialidadController')->only([
    		'index', 'show', 'store', 'update', 'destroy'
			]);
			

			//PlanEspecialidad
			Route::resource('/planes_especialidades','Admin\PlanEspecialidadController');

			//Reticulas
			Route::resource('reticulas','Admin\ReticulaController')->only([
				'store','destroy'
			]);
			Route::get('reticulas/asignaturas','Admin\AsignaturaReticulaController@asignaturas_periodo')->name('reticulas.asignaturas');
			Route::get('reticulas/asignaturas_requisito/{reticula_id}','Admin\AsignaturaReticulaController@asignaturas_requisito')->name('reticulas.asignaturas_requisito');

			//Requisitos
			Route::resource('requisitos_reticulas','Admin\RequisitoReticulaController')->only([
				'store','destroy'
			]);

		});

		//Datatable
		Route::prefix('datatable')->group(function () {

			//Estudiantes
			Route::get('estudiantes','Admin\DataTableController@estudiantes')->name('estudiantes.get');
			
			//Asignaturas
			Route::get('asignaturas','Admin\DataTableController@asignaturas')->name('asignatuas.get');

			//Periodos
			Route::get('periodos','Admin\DataTableController@periodos')->name('periodos.get');

			//Fechas de Examenes
			Route::get('fechas_examenes/{periodo_id}','Admin\DataTableController@fechas_examenes')->name('fechas_examenes.get');

			//Especialidades
			Route::get('especialidades','Admin\DataTableController@especialidades')->name('especialidades.get');

			//Planes especialidades
			Route::get('planes_especialidades/{especialidad_id}','Admin\DataTableController@planes_especialidades')->name('planes_especialidades.get');

			//Docentes
			Route::get('docentes','Admin\DataTableController@docentes')->name('docentes.get');

			//Clases
			Route::get('clases','Admin\DataTableController@clases')->name('clases.get');

		});

		//Selects
		Route::prefix('select')->group(function () {

			//Especialidades
			Route::get('especialidades_nivel/{nivel_academico}','Admin\SelectController@especialidades_nivel')->name('select.especialidades_nivel');

			//Especialidades
			Route::get('planes_especialidades/{especialidad_id}','Admin\SelectController@planes_especialidades')->name('select.planes_especialidades');

			//Asignaturas Reticula
			Route::get('asignaturas_reticula/{plan_especialidad_id}','Admin\SelectController@asignaturas_reticula')->name('select.asignaturas_reticula');

			//Asignaturas Requisito
			Route::get('asignaturas_requisito/{reticula_id}','Admin\SelectController@asignaturas_requisito')->name('select.asignaturas_requisito');

			//Municipios
			Route::get('municipios/{estado_id}','Admin\SelectController@municipios')->name('select.municipios');

			//Localidades
			Route::get('localidades/{municipio_id}','Admin\SelectController@localidades')->name('select.localidades');

		});
		
	});
});