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

// Route::get('/', function () {
//     return view('welcome');
//});

Auth::routes();
Route::get('/', 'HomeController@index')->name('home');
Route::get('/add', 'HomeController@getadd')->name('addcrud');
Route::post('/add', 'HomeController@postAdd')->name('postAdd');
Route::get('/edit/{Id}', 'HomeController@editcrud')->name('editcrud');
Route::post('/edit/{Id}', 'HomeController@posteditcrud')->name('posteditcrud');
Route::get('/delete/{Id}', 'HomeController@getdelete')->name('getdelete');
Route::get('/api-public-states', 'HomeController@getStates')->name('api-public-states');
//Route::get('/home', 'HomeController@index')->name('home');