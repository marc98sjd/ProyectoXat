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

Route::get('/', 'HomeController@welcome')->name('root');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('servicios/denuncias', 'proyectoXatController@getDenuncia')->name('denuncias');

Route::get('servicios/debates', 'proyectoXatController@getDebates')->name('debates');

Route::resource('servicios/xat', 'xatController');

Route::get('servicios/xat/comprobarInvitacion/{id}', 'xatController@compInvi');

Route::get('servicios/xat/comprobarCreada/{id}', 'xatController@compCreada');

Route::get('servicios/xat/cogerMovimientos/{idpartida}', 'xatController@getMov');

Route::get('servicios/xat/comprobarTurno/{idpartida}', 'xatController@compTurno');

Route::get('servicios/xat/primerMov/{idpartida}', 'xatController@primerMov');

Route::get('servicios/xat/crearMovimiento/{pos}/{idpartida}', 'xatController@crearMov');

Route::get('servicios/xat/victoria/{idpartida}', 'xatController@victoria');

Route::get('servicios/xat/derrota/{idpartida}', 'xatController@derrota');

Route::get('servicios/xat', 'xatController@index')->name('xat');

Route::get('servicios/xat/crearMensaje/{id}/{mensaje}', 'xatController@crearMensaje');

Route::get('servicios/noticias', 'proyectoXatController@getNoticias')->name('noticias');

Route::post('servicios/denuncias/addComment', 'proyectoXatController@update');

Route::post('servicios/denuncias/createDenuncia', 'proyectoXatController@store');

Route::post('servicios/noticias/createNoticia', 'proyectoXatController@storeNoticia');

Route::post('servicios/noticias/updateNoticia', 'proyectoXatController@updateNoticiaImportant');

Route::get('servicios/noticias/{categoria}', 'proyectoXatController@getCat');

Route::get('servicios/xat/comprobarMensajes/{id}/{fecha}', 'xatController@comprobarMensajes');

Route::get('servicios/xat/crearPartida/{id}', 'xatController@crearPartida');
