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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', 'LoginController@index');
Route::post('/login/validate', 'LoginController@ceklogin');
Route::post('/upload', 'UploadController@uploadData')->name("upload");

Route::group(['middleware' => ['login-verification']], function () {
//    Menu backend
    Route::get('/logout', 'LoginController@cekLogout');
    Route::get('/dashboard', 'LoginController@LoginMenu');
    Route::get('/user', 'UserController@index');
    Route::get('/user/createUser', 'UserController@create');
    Route::get('/user/store', 'UserController@store');
    Route::get('/user/update', 'UserController@update');
    Route::get('/user/show/{id}', 'UserController@show');
    Route::get('/user/edit/{id}', 'UserController@edit');
    Route::get('/user/delete/{id}', 'UserController@destroy');
    Route::get('/upload_data', 'UploadController@index');

    Route::resource('/user', 'UserController');

//    Route::get('/upload_data', 'LoginController@LoginMenu');
});



