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

//Torneos
Route::get('/torneos', 'TournamentController@index')->name('torneos.index');
Route::get('/torneos/registrar', 'TournamentController@create')->name('torneos.create');
Route::post('/torneos', 'TournamentController@store')->name('torneos.store');
Route::get('/torneos/{slug}', 'TournamentController@show')->name('torneos.show');
Route::get('/torneos/{slug}/editar', 'TournamentController@edit')->name('torneos.edit');
Route::put('/torneos/{slug}', 'TournamentController@update')->name('torneos.update');
Route::delete('/torneos/{slug}', 'TournamentController@destroy')->name('torneos.destroy');


//Clubes
Route::get('/clubes', 'ClubController@index')->name('clubes.index');
Route::get('/clubes/registrar', 'ClubController@create')->name('clubes.create');
Route::post('/clubes', 'ClubController@store')->name('clubes.store');
Route::get('/clubes/{slug}', 'ClubController@show')->name('clubes.show');
Route::get('/clubes/{slug}/editar', 'ClubController@edit')->name('clubes.edit');
Route::put('/clubes/{slug}', 'ClubController@update')->name('clubes.update');
Route::delete('/clubes/{slug}', 'ClubController@destroy')->name('clubes.destroy');

//Asignación de Parejas por Torneos

//Club

Route::get('/parejas', 'CouplesAssignamentController@index')->name('couples_assignament_list');
Route::get('/parejas/registrar', 'CouplesAssignamentController@create')->name('couples_assignament.');
Route::post('/parejas', 'CouplesAssignamentController@store')->name('couples_assignament.store');
Route::get('/parejas/{slug}', 'CouplesAssignamentController@show')->name('couples_assignament.show');
Route::get('/parejas/{slug}/editar', 'CouplesAssignamentController@edit')->name('couples_assignament.edit');
Route::put('/parejas/{slug}', 'CouplesAssignamentController@update')->name('couples_assignament.update');
Route::delete('/parejas/{slug}', 'CouplesAssignamentController@destroy')->name('couples_assignament.destroy');

