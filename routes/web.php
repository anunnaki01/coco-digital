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
    Route::get('/list/index', 'Place\ListPlacesController@index')->name('place-list-index');
    Route::get('/list/getAll', 'Place\ListPlacesController@getAll')->name('place-list');
    Route::post('/register', 'Place\RegisterPlaceController')->name('place-register');
    Route::get('/getById/{id}', 'Place\GetPlaceByIdController')->name('place-get-by-id');
    Route::post('/update', 'Place\UpdatePlaceController')->name('place-update');
});

//Crud services
Route::group(['prefix' => "/service"], function () {
    Route::get('/list/index', 'Service\ListServicesController@index')->name('service-list-index');
    Route::get('/list/getAll', 'Service\ListServicesController@getAll')->name('service-list');
});