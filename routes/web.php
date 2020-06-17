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
    return redirect('login');
});

/* routes login*/
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('Formlogin');
Route::post('/login', 'Auth\LoginController@login')->name('login');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
/* routes login*/

/* routes company*/
Route::middleware(['auth'])->get('/company', 'CompanyController@index')->name('company.index');
Route::middleware(['auth'])->post('/services', 'CompanyController@services')->name('company.services');
Route::middleware(['auth'])->post('/movil', 'CompanyController@movil')->name('company.movil');
Route::middleware(['auth'])->post('/movilChofer', 'CompanyController@movilChofer')->name('company.chofer');
Route::middleware(['auth'])->post('/porcentaje', 'CompanyController@porcentaje')->name('company.porcentaje');
Route::middleware(['auth'])->post('/store', 'CompanyController@store')->name('company.store');
Route::middleware(['auth'])->post('/vale', 'CompanyController@vale')->name('company.vale');
Route::middleware(['auth'])->post('/pacientes', 'CompanyController@pacientes')->name('company.pacientes');
/* routes company*/
