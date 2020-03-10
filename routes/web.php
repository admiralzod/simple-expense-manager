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

Route::get('/', 'HomeController@index');

Auth::routes();

Route::get('/dashboard', 'HomeController@index')->name('home');
Route::group(['middleware' => 'auth'], function(){
    Route::group(['middleware' => 'admin'], function(){
        Route::resource('roles','RolesController');
        Route::resource('users','UsersController');
        Route::resource('expense-categories', 'ExpenseCategoriesController');
    });
    Route::get('profile','ProfileController@profile');
    Route::post('profile','ProfileController@update');
    Route::resource('expenses','ExpensesController');
});

