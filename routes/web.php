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
    return view('index');
})->name('index')->middleware(['checkLogout']);

Route::get('/test', 'authController@test');

Route::post('/login', 'authController@login');
Route::post('/signup', 'authController@signup');

Route::get('/profile', 'profileController@show_profile')->name('profile')->middleware(['checkLogin']);
Route::post('/profile', 'profileController@edit_profile');

Route::get('/logout', 'profileController@logout')->middleware(['checkLogin']);
