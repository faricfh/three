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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('tag', 'TagController@index');
Route::post('tag-store', 'TagController@store');
Route::get('tag-edit/{id}', 'TagController@edit');
Route::delete('tag-delete/{id}', 'TagController@destroy');


Route::get('kategori', 'KategoriController@index');
Route::post('kategori-store', 'KategoriController@store');
Route::get('kategori-edit/{id}', 'KategoriController@edit');
Route::delete('kategori-delete/{id}', 'KategoriController@destroy');

Route::get('artikel', 'ArtikelController@index');
Route::post('artikel-store', 'ArtikelController@store');
Route::get('artikel-edit/{id}', 'ArtikelController@edit');
Route::delete('artikel-delete/{id}', 'ArtikelController@destroy');
