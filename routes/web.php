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

// AUTH
Auth::routes(['register' => false]);

// ADMIN

// inicio
Route::get('/', 'AdminController@index')->name('home');
// usuarios
Route::get('/usuarios', 'UserController@index')->name('usuarios.index');
Route::get('/usuarios/registrar', 'UserController@create')->name('usuarios.create');
Route::post('/usuarios', 'UserController@store')->name('usuarios.store');
Route::get('/usuarios/{slug}', 'UserController@show')->name('usuarios.show');
Route::get('/usuarios/{slug}/editar', 'UserController@edit')->name('usuarios.edit');
Route::put('/usuarios/{slug}', 'UserController@update')->name('usuarios.update');
Route::delete('/usuarios/{slug}', 'UserController@destroy')->name('usuarios.destroy');
// Route::get('/perfil', 'UserController@profile')->name('usuarios.profile');
// jugadores
Route::get('/jugadores', 'GamerController@index')->name('jugadores.index');
Route::get('/jugadores/registrar', 'GamerController@create')->name('jugadores.create');
Route::post('/jugadores', 'GamerController@store')->name('jugadores.store');
Route::get('/jugadores/{slug}', 'GamerController@show')->name('jugadores.show');
Route::get('/jugadores/{slug}/editar', 'GamerController@edit')->name('jugadores.edit');
Route::put('/jugadores/{slug}', 'GamerController@update')->name('jugadores.update');
Route::delete('/jugadores/{slug}', 'GamerController@destroy')->name('jugadores.destroy');