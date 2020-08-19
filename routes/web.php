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

Route::prefix('/admin')->namespace('Admin')->group(function () {
    // All the admin routes will be defined here :-
    Route::get('/', 'AdminController@login');
    Route::match(['get', 'post'], '/login', 'AdminController@login');
    Route::group(['middleware' => ['admin']], function () {
        Route::get('dashboard', 'AdminController@dashboard');
        Route::get('settings', 'AdminController@settings');
        Route::get('logout', 'AdminController@logout');

        // Sections 
        Route::match(['get', 'post'], '/sections', 'SectionController@sections');
        Route::post('update-section-status', 'SectionController@updateSectionStatus');
        
        // Categories
        Route::get('categories', 'CategoryController@categories');
        Route::post('update-category-status', 'CategoryController@updateCategoryStatus');
        Route::match(['get', 'post'], 'add-edit-category/{id?}', 'CategoryController@addEditCategpry');
    });
});

