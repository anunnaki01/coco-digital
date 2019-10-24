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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Crud places
Route::group(['prefix' => "/place"], function () {
    Route::get('/list/index', 'Place\ListController@index')->name('place-list-index');
    Route::get('/list/getAll', 'Place\ListController@getAll')->name('place-list');
    Route::post('/register', 'Place\RegisterController')->name('place-register');
    Route::get('/getById/{id}', 'Place\GetByIdController')->name('place-get-by-id');
    Route::post('/update', 'Place\UpdateController')->name('place-update');
});