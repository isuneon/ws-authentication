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

Route::get('/', function () {
    return view('welcome');
});


Route::group(['middleware' => ['api','cors'],'prefix' => 'api'], function () {
    //Devuelve el un token en caso de el usuario existir en base de datos
    Route::post('repassword', 'APIController@repassword');
    //Envia token para resetear password
    Route::group(['middleware' => 'jwt-auth'], function () {
    	Route::post('set_new_password', 'APIController@set_new_password');
    });
});