<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
*/

Route::get('/', function()
{	
    return View::make('login');	
});

Route::post('login', 'loginController@login');
Route::get('logout', 'loginController@logout');


Route::get('main', 'mainController@main');
Route::get('main/show', 'mainController@mainShow');
Route::get('main/delete', 'mainController@mainDelete');
Route::post('main', 'mainController@mainCreateEdit');

Route::get('main/motivosListado', 'mainController@listadoMotivos');
Route::get('main/existeMotivo', 'mainController@existeMotivo');
Route::post('main/nuevoMotivo', 'mainController@motivoCreate');

Route::get('main/deudorListado', 'mainController@listadoDeudores');
Route::get('main/existeDeudor', 'mainController@existeDeudor');
Route::post('main/nuevoDeudor', 'mainController@deudorCreate');


//informes
Route::get('informes/ultdias/{dias}', 'informesController@infUltdias');
Route::get('informes/mesesEjercicio/{year}', 'informesController@infMesesYear');


//graficas
Route::get('graficas/meses/{year}', 'graficasController@graficasMeses');
