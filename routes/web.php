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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'admin' , 'middleware' => 'auth'], function() { //--'middleware' => 'auth' テキスト
     Route::get('news/create', 'Admin\NewsController@add')->middleware('auth');
     Route::post('news/create', 'Admin\NewsController@create')->middleware('auth');#===テキスト13と15にて追記
     Route::get('news', 'Admin\NewsController@index')->middleware('auth');
     Route::get('news/edit', 'Admin\NewsController@edit')->middleware('auth'); // 16で追記
     Route::post('news/edit', 'Admin\NewsController@update')->middleware('auth'); // 16で追記
     Route::get('news/delete', 'Admin\NewsController@delete')->middleware('auth');
     //『get』は指定した URLの内容を取り出すための要求で、最も基本的な HTTPメソッド
     //『post』URLに対して情報を要求するだけでなく、クライアントからさまざまなデータを送信することができる
     Route::post('profile/edit','Admin\ProfileController@update')->middleware('auth');
     Route::get('profile/create','Admin\ProfileController@add')->middleware('auth');
     Route::post('profile/create','Admin\ProfileController@create')->middleware('auth');
     Route::get('profile/edit', 'Admin\ProfileController@edit')->middleware('auth');
     Route::get('profile/delete', 'Admin\ProfileController@delete')->middleware('auth');
     Route::get('profile', 'Admin\ProfileController@index')->middleware('auth');
     
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'NewsController@index');//１９で追記
Route::get('/profile', 'ProfileController@index');