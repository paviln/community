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
    return view('home');
});

Route::get('/servers', 'HomeController@servers')->name('servers');
Auth::routes();


Route::middleware('superuser')->name('admin.')->prefix('admin')->namespace('Admin')->group(function () {
    Route::get('/', 'DashboardController')->name('dashboard');
    Route::resource('servers', 'ServerController');
    Route::resource('categories', 'CategoryController');
    Route::resource('games', 'GameController');
    Route::resource('users', 'UserController');
    Route::get('theme', 'ThemeController@index')->name('theme');
    Route::post('theme.upload', 'ThemeController@upload')->name('theme.upload');
    Route::get('setting', 'SettingController@index')->name('setting');
    Route::patch('setting.update/{id}', 'SettingController@update')->name('setting.update');
});
