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
		Route::get('/menu','Admin\MenuController@index')->name('admin.menu');

		//Estudiantes
		Route::resource('/estudiantes','Admin\EstudianteController');

		//DataTable
		Route::get('/datatable/estudiantes','Admin\DataTableController@estudiantes')->name('estudiantes.get');		 

		//Municipios
		Route::resource('/municipios','Admin\MunicipioController')->only('show');

		
	});
});