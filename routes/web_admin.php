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

Route::group([
    'prefix' => 'admin',
    'middleware' => 'admin',
] , function (){

    Route::group([
        'prefix' => 'index',
        'middleware' => 'admin_auth',
    ], function(){
        Route::any('index' , 'Admin\IndexController@indexAction');
    });

    Route::group(['prefix' => 'public'], function(){
        Route::any('login' , 'Admin\PublicController@loginAction')->name('login');
    });

});
