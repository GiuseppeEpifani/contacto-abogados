<?php

use Illuminate\Support\Facades\Route;

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
    return view('inicio');
});

Route::post('/correo', 'MensajesController@store');
Route::post('/subirInicioImages', 'ContenidoInicioController@subirContenidoInicio');
Route::get('/contenidoInicio', 'ContenidoInicioController@index');
Route::get('/mostrarTodosLosRegistros', 'ContenidoInicioController@showAll');
Route::put('/updateInicioImages/{id}', 'ContenidoInicioController@updateContenidoInicio');
Route::delete('/eliminarContenido/{id}', 'ContenidoInicioController@destroy');


Route::get('/actualizarInformacionInicio/{id}', 'ContenidoInicioController@show');

Auth::routes();

Route::get('/inicio', 'HomeController@index')->name('home');
