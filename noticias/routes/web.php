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

Route::get('/', 'NoticiaController@index')->name('noticias.index');

Route::get('/noticias', 'NoticiaController@index')->name('noticias.index');
Route::get('/noticias/create', 'NoticiaController@create')->name('noticias.create');
Route::post('/noticias', 'NoticiaController@store')->name('noticias.store');
Route::get('/noticias/{noticia}', 'NoticiaController@show')->name('noticias.show');
Route::get('/noticias/{noticia}/edit', 'NoticiaController@edit')->name('noticias.edit');
Route::put('/noticias/{noticia}', 'NoticiaController@update')->name('noticias.update');
Route::delete('/noticias/{noticia}', 'NoticiaController@destroy')->name('noticias.destroy');

Auth::routes();