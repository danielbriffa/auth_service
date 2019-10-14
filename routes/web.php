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

/*
Route::get('/', function () {
    return view('welcome');
});
*/

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

#Socialite callback routings (called by third parties)
Route::get('login/github/callback', 'Auth\LoginController@handleProviderCallback', 'github');
Route::get('login/facebook/callback', 'Auth\LoginController@handleProviderCallback', 'facebook');