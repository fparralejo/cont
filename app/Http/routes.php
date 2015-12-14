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
Route::get('main/nuevoMotivo', 'mainController@nuevoMotivo');
Route::post('main/motivo', 'mainController@motivoCreateEdit');


////seguimiento
//Route::get('seguimiento/{id_oferta}', 'seguimientoController@main');
//Route::get('seguimiento/{id_oferta}/show', 'seguimientoController@seguimientoShow');
//Route::get('seguimiento/{id_oferta}/delete', 'seguimientoController@seguimientoDelete');
//Route::post('seguimiento', 'seguimientoController@seguimientoCreateEdit');
//
////entrevistas
//Route::get('entrevistas/{id_oferta}', 'entrevistasController@main');
//Route::get('entrevistas/{id_oferta}/show', 'entrevistasController@entrevistaShow');
//Route::get('entrevistas/{id_oferta}/delete', 'entrevistasController@entrevistaDelete');
//Route::post('entrevistas', 'entrevistasController@entrevistaCreateEdit');
//
////web trabajo
//Route::get('web', 'webController@main');
//Route::get('web/show', 'webController@webShow');
//Route::get('web/delete', 'webController@webDelete');
//Route::post('web', 'webController@webCreateEdit');
//
