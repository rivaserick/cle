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

Route::group(['prefix' => 'coordinacion', 'as' => 'coordinacion.', 'namespace' => 'coordinacion'], function () {
    Route::get('/', function () {return view('coordinacion.index');})->name('inicio');
    Route::get('/inicio', function () {return view('coordinacion.index');})->name('inicio');
    
    Route::group(['prefix' => 'ajustes', 'as' => 'ajustes.'], function () {
        Route::get('/', 'ajustesController@inicio')->name('inicio');
        Route::get('inicio', 'ajustesController@inicio')->name('inicio');
        Route::post('agregarPeriodo', 'ajustesController@agregarPeriodo')->name('agregarPeriodo');
        Route::post('periodoVigente', 'ajustesController@periodoVigente')->name('periodoVigente');
        Route::post('agregarObservador', 'ajustesController@agregarObservador')->name('agregarObservador');
        Route::post('agregarCategoriaObservaciones', 'ajustesController@agregarCategoriaObservaciones')->name('agregarCategoriaObservaciones');
        Route::post('agregarItemCategoria', 'ajustesController@agregarItemCategoria')->name('agregarItemCategoria');
        Route::post('altaDocentesActivos', 'ajustesController@altaDocentesActivos')->name('altaDocentesActivos');
    });
    Route::group(['prefix' => 'actualizaciones', 'as' => 'actualizaciones.'], function () {
        Route::get('/', 'actualizacionesController@inicio')->name('inicio');
        Route::get('inicio', 'actualizacionesController@inicio')->name('inicio');
        Route::get('ver/{id}', 'actualizacionesController@ver')->name('ver');
        Route::post('guardar/{id}', 'actualizacionesController@guardar')->name('guardar');
        Route::post('reportes', 'actualizacionesController@reportes')->name('reportes');
    });
    Route::group(['prefix' => 'observacion', 'as' => 'observacion.'], function () {
        Route::get('/', 'observacionController@inicio')->name('inicio');
        Route::get('inicio', 'observacionController@inicio')->name('inicio');
        Route::post('feedback', 'observacionController@feedback')->name('feedback');
    });
    Route::group(['prefix' => 'cuenta', 'as' => 'cuenta.'], function () {
        Route::get('/', 'cuentaController@inicio')->name('inicio');
        Route::post('cambiarPassword', 'cuentaController@cambiarPassword')->name('cambiarPassword');
    });
});

Route::group(['prefix' => 'docencia', 'as' => 'docencia.', 'namespace' => 'docencia'], function () {
    Route::get('/', function () {return view('docencia.index');})->name('inicio');
    Route::get('/inicio', function () {return view('docencia.index');})->name('inicio');
    Route::group(['prefix' => 'actualizaciones', 'as' => 'actualizaciones.'], function () {
        Route::get('inicio', 'actualizacionesController@inicio')->name('inicio');
        Route::get('registrar', 'actualizacionesController@registrar')->name('registrar');
        Route::post('guardar', 'actualizacionesController@guardar')->name('guardar');
        Route::get('ver/{id}', 'actualizacionesController@ver')->name('ver');
    });
    Route::group(['prefix' => 'observacion', 'as' => 'observacion.'], function () {
        Route::get('/', 'observacionController@inicio')->name('inicio');
        Route::get('inicio', 'observacionController@inicio')->name('inicio');
        Route::post('guardar', 'observacionController@guardar')->name('guardar');
        Route::post('feedback', 'observacionController@feedback')->name('feedback');
    });
    Route::group(['prefix' => 'cuenta', 'as' => 'cuenta.'], function () {
        Route::get('/', 'cuentaController@inicio')->name('inicio');
        Route::post('cambiarPassword', 'cuentaController@cambiarPassword')->name('cambiarPassword');
    });
});

Route::group(['prefix' => 'observacion', 'as' => 'observacion.', 'namespace' => 'observacion'], function () {
    Route::get('/', 'observacionController@inicio')->name('inicio');
    Route::get('inicio', 'observacionController@inicio')->name('inicio');
    Route::get('registrar', 'observacionController@registrar')->name('registrar');
    Route::post('guardar', 'observacionController@guardar')->name('guardar');
    Route::post('feedback', 'observacionController@feedback')->name('feedback');
    Route::group(['prefix' => 'cuenta', 'as' => 'cuenta.'], function () {
        Route::get('/', 'cuentaController@inicio')->name('inicio');
        Route::post('cambiarPassword', 'cuentaController@cambiarPassword')->name('cambiarPassword');
    });
});

Route::group(['prefix' => 'observacion', 'namespace' => 'Auth'], function () {
    Route::get('login', 'ObservacionLoginController@showLoginForm')->name('observacion.login');
    Route::post('login', 'ObservacionLoginController@login')->name('observacion.login');
    Route::post('logout', 'ObservacionLoginController@logout')->middleware('observacion')->name('observacion.logout');
});

Route::group(['prefix' => 'coordinacion', 'namespace' => 'Auth'], function () {
    Route::get('login', 'CoordinacionLoginController@showLoginForm')->name('coordinacion.login');
    Route::post('login', 'CoordinacionLoginController@login')->name('coordinacion.login');
    Route::post('logout', 'CoordinacionLoginController@logout')->middleware('coordinacion')->name('coordinacion.logout');
});

Route::group(['prefix' => 'docencia', 'namespace' => 'Auth'], function () {
    Route::get('login', 'DocenciaLoginController@showLoginForm')->name('docencia.login');
    Route::post('login', 'DocenciaLoginController@login')->name('docencia.login');
    Route::post('logout', 'DocenciaLoginController@logout')->middleware('docencia')->name('docencia.logout');
});
