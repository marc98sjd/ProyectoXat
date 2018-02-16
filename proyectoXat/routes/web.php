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

Route::get('servicios/xat', 'proyectoXatController@getXat')->name('xat');

Route::get('servicios/noticias', 'proyectoXatController@getNoticias')->name('noticias');

Route::post('servicios/denuncias/createDenuncia', 'proyectoXatController@store');
Route::post('servicios/denuncias/addComment', 'proyectoXatController@update');
