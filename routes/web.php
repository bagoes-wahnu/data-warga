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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/','WargaController@index')->name('warga.index');
Route::get('/tambah_data','WargaController@create')->name('warga.create');
Route::post('/tambah_data','WargaController@store')->name('warga.store');
Route::get('/edit_data/{id}','WargaController@edit')->name('warga.edit');
Route::put('/edit_data/{id}','WargaController@update')->name('warga.update');
Route::delete('/{id}','WargaController@destroy')->name('warga.destroy');
// Route::resource('warga', 'WargaController')->except(['show']);