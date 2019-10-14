<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->group(
    function()
    {

        //return information of logged in user
        Route::get('/user', function (Request $request) {
            return $request->user();
        });

        //return all meta details of logged in user
        Route::get('/user/meta', 'API\V1\UserDataController@showAll');

        //return all values of specific key
        Route::get('/user/meta/{key}', 'API\V1\UserDataController@show');

        //delete all values from key - key included
        Route::delete('/user/meta/{key}', 'API\V1\UserDataController@destroy');

        //add field value to key
        Route::post('/user/meta/{key}', 'API\V1\UserDataController@addValue');

        //delete field value from key
        Route::put('/user/meta/{key}', 'API\V1\UserDataController@deleteValue');
        
    }
);

#Socialiate login routings
Route::get('login/github', 'Auth\LoginController@redirectToProvider', 'github');
Route::get('login/facebook', 'Auth\LoginController@redirectToProvider', 'facebook');