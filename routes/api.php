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

Route::group(['prefix' => 'v1'], function() {
    Route::group(['prefix' => 'oauth'], function(){
        Route::post('signin', 'AuthController@signin');
        Route::post('register', 'AuthController@register');
    });

    Route::group(['prefix' => 'film', 'middleware' => 'auth:api'], function() {
	    Route::post('comment/{id}', 'Api\FilmController@comment');
		Route::post('rating/{id}', 'Api\FilmController@rating');
		Route::get('create/prerequisite', 'Api\FilmController@prerequisite');
    });

	Route::post('upload-image', 'Api\FilmController@fileUpload');

    Route::resource('film', 'Api\FilmController');

});

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
