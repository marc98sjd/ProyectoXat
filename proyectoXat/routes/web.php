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

Route::get('/', function () {
    return view('welcome');
})->name('root');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('servicios/denuncias', 'proyectoXatController@getDenuncia')->name('denuncias');

Route::get('servicios/debates', 'proyectoXatController@getDebates')->name('debates');

Route::resource('servicios/xat', 'xatController');

Route::get('servicios/xat', 'xatController@index')->name('xat');

Route::get('servicios/xat/crearMensaje/{id}/{mensaje}', 'xatController@crearMensaje');

Route::get('servicios/noticias', 'proyectoXatController@getNoticias')->name('noticias');

Route::post('servicios/denuncias/addComment', 'proyectoXatController@update');

Route::post('servicios/denuncias/createDenuncia', 'proyectoXatController@store');

Route::post('servicios/noticias/createNoticia', 'proyectoXatController@storeNoticia');

Route::get('servicios/xat/comprobarMensajes/{id}/{fecha}', 'xatController@comprobarMensajes');
