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

Route::get('/post_job', 'jobController@show')->middleware(['checkLoginEmployer']);
Route::post('/post_job', 'jobController@postJob')->middleware(['checkLoginEmployer']);
Route::get('/posted_jobs', 'jobController@showPostedJobs')->name('posted_jobs')->middleware(['checkLoginEmployer']);
Route::get('/posted_jobs/{job}', 'jobController@showEditPostedJob')->name('edit_posted_job')->middleware(['checkLoginEmployer']);
Route::post('/edit_posted_job/{job}', 'jobController@editPostedJob')->middleware(['checkLoginEmployer']);


Route::get('/search', 'searchController@show')->name('search')->middleware(['checkLogin']);
Route::get('/searchFor', 'searchController@searchFor')->middleware(['checkLogin']);
Route::get('/searchForDetail', 'searchController@searchForDetail')->middleware(['checkLogin']);

Route::get('/about', function() {
    if(Auth::check()) {
        return view('about_login', [
            'user' => Auth::user()
        ]);
    }
    else {
        return view('about_logout');
    }
});



