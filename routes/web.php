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

// Inicio
Route::get('/', 'AdminController@index')->name('home');

// Usuarios
Route::get('/usuarios', 'UserController@index')->name('usuarios.index');
Route::get('/usuarios/registrar', 'UserController@create')->name('usuarios.create');
Route::post('/usuarios', 'UserController@store')->name('usuarios.store');
Route::get('/usuarios/{slug}', 'UserController@show')->name('usuarios.show');
Route::get('/usuarios/{slug}/editar', 'UserController@edit')->name('usuarios.edit');
Route::put('/usuarios/{slug}', 'UserController@update')->name('usuarios.update');
Route::delete('/usuarios/{slug}', 'UserController@destroy')->name('usuarios.destroy');
// Route::get('/perfil', 'UserController@profile')->name('usuarios.profile');

// Jugadores
Route::get('/jugadores', 'GamerController@index')->name('jugadores.index');
Route::get('/jugadores/registrar', 'GamerController@create')->name('jugadores.create');
Route::post('/jugadores', 'GamerController@store')->name('jugadores.store');
Route::get('/jugadores/{slug}', 'GamerController@show')->name('jugadores.show');
Route::get('/jugadores/{slug}/editar', 'GamerController@edit')->name('jugadores.edit');
Route::put('/jugadores/{slug}', 'GamerController@update')->name('jugadores.update');
Route::delete('/jugadores/{slug}', 'GamerController@destroy')->name('jugadores.destroy');

// Torneos
Route::get('/torneos', 'TournamentController@index')->name('torneos.index');
Route::get('/torneos/registrar', 'TournamentController@create')->name('torneos.create');
Route::post('/torneos', 'TournamentController@store')->name('torneos.store');
Route::get('/torneos/{slug}', 'TournamentController@show')->name('torneos.show');
Route::get('/torneos/{slug}/editar', 'TournamentController@edit')->name('torneos.edit');
Route::put('/torneos/{slug}', 'TournamentController@update')->name('torneos.update');
Route::delete('/torneos/{slug}', 'TournamentController@destroy')->name('torneos.destroy');
Route::get('/torneos/{slug}/agregar', 'TournamentController@addGamers')->name('torneos.add.gamers');
Route::post('/torneos/{slug}/agregar', 'TournamentController@addGamersStore')->name('torneos.store.gamers');
Route::get('/torneos/{slug}/jugadores', 'TournamentController@listGamers')->name('torneos.list.gamers');
Route::get('/torneos/{slug}/parejas', 'TournamentController@listCouples')->name('torneos.list.couples');
Route::get('/torneos/{slug}/iniciar', 'TournamentController@start')->name('torneos.start');
Route::get('/torneos/{slug}/fase-de-grupos', 'TournamentController@phaseGroups')->name('torneos.phase.groups');
Route::get('/torneos/{slug}/semifinal', 'TournamentController@semifinal')->name('torneos.phase.semifinal');
Route::get('/torneos/{slug}/final', 'TournamentController@finale')->name('torneos.phase.final');
Route::get('/torneos/{slug}/{phase}/{group}', 'TournamentController@group')->name('torneos.group');
Route::get('/torneos/{slug}/juego', 'TournamentController@game')->name('torneos.add.game');
Route::post('/torneos/{slug}/juego', 'TournamentController@gameStore')->name('torneos.store.game');

//Clubes
Route::get('/clubes', 'ClubController@index')->name('clubes.index');
Route::get('/clubes/registrar', 'ClubController@create')->name('clubes.create');
Route::post('/clubes', 'ClubController@store')->name('clubes.store');
Route::get('/clubes/{slug}', 'ClubController@show')->name('clubes.show');
Route::get('/clubes/{slug}/editar', 'ClubController@edit')->name('clubes.edit');
Route::put('/clubes/{slug}', 'ClubController@update')->name('clubes.update');
Route::delete('/clubes/{slug}', 'ClubController@destroy')->name('clubes.destroy');

// Juegos
Route::get('/juegos', 'GameController@index')->name('juegos.index');
Route::get('/juegos/registrar', 'GameController@create')->name('juegos.create');
Route::post('/juegos', 'GameController@store')->name('juegos.store');
Route::get('/juegos/{slug}', 'GameController@show')->name('juegos.show');
Route::get('/juegos/{slug}/editar', 'GameController@edit')->name('juegos.edit');
Route::put('/juegos/{slug}', 'GameController@update')->name('juegos.update');
Route::delete('/juegos/{slug}', 'GameController@destroy')->name('juegos.destroy');

// Parejas
Route::get('/parejas/{slug}/agregar', 'CouplesController@addCouples')->name('parejas.add.couples');
Route::post('/parejas/{slug}/agregar', 'CouplesController@addCouplesStore')->name('parejas.store.couples');