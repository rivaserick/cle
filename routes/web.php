<?php

use Illuminate\Support\Facades\Hash;
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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/home', 'HomeController@resetPassword')->name('home');

Route::get('coordinacion', function () {return view('coordinacion.index');})->name('coordinacion');

Route::group(['prefix' => 'coordinacion', 'as' => 'coordinacion.', 'namespace' => 'coordinacion'], function () {
    Route::group(['prefix' => 'ajustes', 'as' => 'ajustes.'], function () {
        Route::get('inicio', 'ajustesController@inicio')->name('inicio');
        Route::post('agregarPeriodo', 'ajustesController@agregarPeriodo')->name('agregarPeriodo');
        Route::post('periodoVigente', 'ajustesController@periodoVigente')->name('periodoVigente');
        Route::post('altaDocentesActivos', 'ajustesController@altaDocentesActivos')->name('altaDocentesActivos');
    });
    Route::group(['prefix' => 'actualizaciones', 'as' => 'actualizaciones.'], function () {
        Route::get('inicio', 'actualizacionesController@inicio')->name('inicio');
        Route::get('ver/{id}', 'actualizacionesController@ver')->name('ver');
        Route::post('guardar', 'actualizacionesController@guardar')->name('guardar');
        Route::post('reportes', 'actualizacionesController@reportes')->name('reportes');
    });
});

Route::group(['prefix' => 'docencia', 'as' => 'docencia.'], function () {
    Route::group(['prefix' => 'actualizaciones', 'as' => 'actualizaciones.'], function () {
        Route::get('inicio', 'actualizacionesController@inicio')->name('inicio');
        Route::get('registrar', 'actualizacionesController@registrar')->name('registrar');
        Route::post('guardar', 'actualizacionesController@guardar')->name('guardar');
        Route::get('ver/{id}', 'actualizacionesController@ver')->name('ver');
    });
});

Route::group(['prefix' => 'observacion', 'namespace' => 'Auth'], function () {
    Route::get('login', 'ObservacionLoginController@showLoginForm')->name('observacion.login');
    Route::post('login', 'ObservacionLoginController@login')->name('observacion.login');
    Route::post('logout', 'ObservacionLoginController@logout')->middleware('observacion')->name('observacion.logout');
});
