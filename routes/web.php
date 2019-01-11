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

Route::get('/', 'PreguntasController@inicio');

Auth::routes();

Route::get('/pregunta','PreguntasController@add');
Route::post('/pregunta','PreguntasController@create');

Route::get('/pregunta/{pregunta}','PreguntasController@edit');
Route::post('/pregunta/pregunta/{pregunta}','PreguntasController@update');

Route::get('/preguntas', 'PreguntasController@index');
Route::get('/prueba', 'PruebasController@index');
Route::get('/prueba_add','PruebasController@add');
Route::post('/prueba_add','PruebasController@create');
Route::get('/prueba_activar/{pregrunta}','PruebasController@activar');
Route::get('/prueba_publicar/{pregrunta}','PruebasController@publicar');
Route::get('/prueba_edit/{prueba}','PruebasController@edit');
Route::post('/prueba_edit/prueba_edit/{prueba}','PruebasController@update');
Route::get('/prueba_details/{prueba}','PruebasController@details');
Route::post('/prueba_details/prueba_edit/{prueba}','PruebasController@delete');

Route::get('/prueba/uno', 'PruebasController@prueba');
Route::get('/prueba/{prueba}', 'PruebasController@index');

Route::get('/items/{prueba}/{item?}', 'ItemsController@index');
Route::get('/lista_preguntas/{prueba}', 'ItemsController@lista');
Route::post('/lista_preguntas/{prueba}', 'PruebasController@preguntas');
Route::post('/pruebaNino', 'TestsController@indexParaAuthNino');


Route::get('/test', 'TestsController@index');
Route::post('/test', 'TestsController@cambiar');

Route::get('/reporte', 'ReportesController@index');