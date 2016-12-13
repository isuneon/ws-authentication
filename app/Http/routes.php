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

Route::get('/login', 'APIController@login' );
Route::get('/logout', 'APIController@logout' );


Route::group(['prefix' => 'api'], function() {
    Route::post('/user', ['middleware' => ['role:admin|vend'], 'uses' => 'APIController@index']);
    Route::post('/user/store', ['middleware' => ['role:admin|vend'], 'uses' => 'APIController@index']);
    Route::post('/user/update/{id}', ['middleware' => ['role:admin|vend'], 'uses' => 'APIController@index']);
    Route::post('/user/delete/{id}', ['middleware' => ['role:admin|vend'], 'uses' => 'APIController@index']);
    // Route::get('/manage', ['middleware' => ['permission:manage-admins'], 'uses' => 'AdminController@manageAdmins']);
});