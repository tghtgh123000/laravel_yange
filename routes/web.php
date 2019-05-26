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


//use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::group(['prefix' => 'user'] , function (){
    Route::any('/smscode/send' , 'User\SmscodeController@send');
});

Route::group([
    'prefix' => 'active',
    'middleware' => 'web',
] , function (){
    Route::any('/fruits' , 'Active\FruitsController@index');
    Route::any('/test' , 'Active\FruitsController@test');
    Route::any('/fresh' , 'Active\FruitsController@fresh');
});

Route::get('/dev/table/{table}' , function($table){
    $list = DB::table('information_schema.COLUMNS')->where([
        'TABLE_SCHEMA' => 'laravel_blog',
        'TABLE_NAME' => $table,
    ])->get();
    echo '<pre>';
    echo "<h1>$table</h1>";
    if(count($list) == 0)echo "不存在";
    echo "<h2>Model注释</h2>";
    foreach ($list as $r){
        echo " * @property string {$r->COLUMN_NAME} {$r->COLUMN_COMMENT}" . "\n";
    }
    return;
});

Route::group(['prefix' => 'yg'] , function (){
    Route::group(['prefix' => 'public'], function(){
        Route::any('swagger' , 'Yg\PublicController@swagger');
    });
});
