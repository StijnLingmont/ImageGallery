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
Route::get('/privacy-policy', 'HomeController@privacyPolicy')->name('privacy-policy');
Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');
Route::post('/dashboard/profile-picture', 'HomeController@storeProfilePicture')->name('dashboard.profile-picture.store');
Route::get('/dashboard/profile-picture', 'HomeController@getProfilePicture')->name('dashboard.profile-picture');

//Image
Route::post('/image', 'PictureController@store')->name('image.store');
Route::post('/image/all', 'PictureController@index')->name('image.index');
Route::delete('/image/{picture}', 'PictureController@destroy')->name('image.destroy');
Route::post('/albums/{album}/image', 'AlbumsController@getImages')->name('album.image.show');
Route::post('/albums/{album}/image/add', 'AlbumsController@link')->name('album.image.store');
Route::delete('/albums/{album}/image/{picture}', 'AlbumsController@removeLink')->name('album.image.delete');
Route::get('/albums/{album}/image/{picture}', 'PictureController@show')->name('image.show');
Route::post('/albums/{album}/image/{picture}', 'PictureController@detailStore')->name('image.store');

//Albums
Route::get('/albums', 'AlbumsController@index')->name('album.index')->middleware('verified');
Route::post('/albums', 'AlbumsController@store')->name('album.store');
Route::get('/albums/{album}', 'AlbumsController@show')->name('album.show');
Route::patch('/albums/{album}', 'AlbumsController@update')->name('album.update');
Route::delete('/albums/{album}', 'AlbumsController@destroy')->name('album.destroy');

//Routes
Auth::routes(['verify' => true]);
Route::post('/change-password', 'Auth\ChangePasswordController@update')->name('password.update');
