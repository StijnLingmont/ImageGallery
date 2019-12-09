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

//One pages
Route::get('/', 'HomeController@index')->name('home');
Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');

//Image
Route::post('/image', 'ImageController@store')->name('image.store');
Route::post('/image/all', 'ImageController@index')->name('image.index');

//Albums
Route::get('/albums', 'AlbumsController@index')->name('album.index');
//Route::get('/albums/add', 'AlbumsController@create')->name('album.create');
Route::post('/albums', 'AlbumsController@store')->name('album.store');
Route::get('/albums/{album}', 'AlbumsController@show')->name('album.show');
Route::get('/albums/{album}/edit', 'AlbumsController@edit')->name('album.edit');
Route::patch('/albums/{album}', 'AlbumsController@update')->name('album.update');
Route::delete('/albums/{album}', 'AlbumsController@destroy')->name('album.destroy');

//Selected Images
Route::post('/albums/{album}/image', 'SelectedImages@index')->name('album.image.show');
Route::post('/albums/{album}/image/add', 'ImageController@link')->name('album.image.store');

Auth::routes();
