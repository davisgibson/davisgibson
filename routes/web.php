<?php

use Illuminate\Support\Facades\Route;

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
    return redirect('/home');
});
Auth::routes();

Route::get('/home', 'HomeController@dashboard')->name('home');
Route::get('/search','SearchController@index')->name('search');
Route::get('/tasks', 'TaskController@index')->name('tasks');
Route::get('/tasks/create', 'TaskController@create');
Route::post('/tasks/create', 'TaskController@store');
Route::get('/tasks/{task}/complete', 'TaskController@complete');
Route::get('/tasks/{task}/edit', 'TaskController@edit');
Route::put('/tasks/{task}', 'TaskController@update');
Route::delete('/tasks/{task}', 'TaskController@delete');

Route::get('/onboarding', 'UserController@onboarding');
Route::put('/onboarding/assign', 'UserController@assignHome');
Route::get('/onboarding/code', 'UserController@code');
Route::post('/onboarding/code', 'UserController@assignHome');
Route::post('/onboarding/create', 'UserController@newHome');

Route::get('/myhome', 'HomeController@index');
Route::get('/profile', 'ProfileController@index')->name('profile');
Route::post('/profile/update','ProfileController@updateProfile')->name('profile.update');

Route::get('/house','HouseController@index')->name('house');
Route::post('/house','HouseController@insert')->name('regHouse');

Route::get('/houses/{id}','HousesController@index');
Route::get('/houses/{id}/upload','HouseUploadController@index')->name('houseUp');
Route::post('/houses/{id}/upload/upload','HouseUploadController@uploadFiles')->name('house.update');

Route::get('/settings','SettingsController@index')->name('settings');
Route::post('/settings','SettingsController@update')->name('settings.update');

Route::get('welcome','HomepageController@index');
