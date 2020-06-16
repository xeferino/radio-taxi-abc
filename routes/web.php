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
    return view('login');
});

Route::get('/company', 'CompanyController@index')->name('company.index');
Route::post('/services', 'CompanyController@services')->name('company.services');
Route::post('/movil', 'CompanyController@movil')->name('company.movil');
Route::post('/porcentaje', 'CompanyController@porcentaje')->name('company.porcentaje');
Route::post('/store', 'CompanyController@store')->name('company.store');
Route::post('/vale', 'CompanyController@vale')->name('company.vale');
Route::post('/pacientes', 'CompanyController@pacientes')->name('company.pacientes');

