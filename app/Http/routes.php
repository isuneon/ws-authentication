<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


// Route::get('/', function () {
//     return view('welcome');
// });



// Route::group(['prefix' => 'api'], function () {
//     Route::post('auth', ['as'=>'apiUsers', 'uses'=>'UserController@show']);
// });


// Ruta API

Route::group(['middleware' => ['cors','api'],'prefix' => 'api'], function () {

// Direcciones para el WS de login / logout
    Route::post('register', 'APIController@register');
    Route::post('login', 'APIController@login');
    Route::post('logout', 'APIController@logout');
    Route::group(['middleware' => 'jwt-auth'], function () {
    	Route::post('get_user_details', 'APIController@get_user_details');

    });


// Direcciones para el ws de reset password

    //Devuelve el un token en caso de el usuario existir en base de datos
    Route::post('repassword', 'APIPasswordController@repassword');
    //Envia token para resetear password
    Route::group(['middleware'=>['before'=>'jwt.auth']], function () {
    	Route::post('set_new_password', 'APIPasswordController@set_new_password');
    });


// CRUD DE CLIENTES

    Route::post('/user',            ['middleware' => ['role:admin|vend', 'before'=>'jwt.auth'], 'uses' => 'APIClientController@index']);
    Route::post('/user/store',      ['middleware' => ['role:admin|vend', 'before'=>'jwt.auth'], 'uses' => 'APIClientController@store']);
    Route::post('/user/update/{id}',['middleware' => ['role:admin|vend', 'before'=>'jwt.auth'], 'uses' => 'APIClientController@update']);
    Route::post('/user/delete/{id}',['middleware' => ['role:admin|vend', 'before'=>'jwt.auth'], 'uses' => 'APIClientController@delete']);

});



