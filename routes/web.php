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

# signup
Route::get('signup', 'SignupController@index')->name('signup.index');
Route::post('signup', 'SignupController@postIndex');
Route::get('signup/confirm', 'SignupController@confirm')->name('signup.confirm');
Route::post('signup/confirm', 'SignupController@postConfirm');
Route::get('signup/thanks', 'SignupController@thanks')->name('signup.thanks');

# login
Route::prefix('admin')->namespace('Admin')->as('admin.')->group(function(){
    Route::middleware('guest:admin')->group(function(){
        # login
        Route::get('login', 'LoginController@showLoginForm')->name('login');
        Route::post('login', 'LoginController@login');

    });
    Route::middleware('auth:admin')->group(function(){
        # logout
        Route::get('logout', 'LoginController@logout')->name('logout');

        # top
        Route::get('', 'IndexController@index')->name('top');

    });
});

//# login
//Route::get('admin/login', 'Admin\LoginController@showLoginForm')->name('admin.login');
//Route::post('admin/login', 'Admin\LoginController@login');
//# logout
//Route::get('admin/logout', 'Admin\LoginController@logout')->name('admin.logout');
//
//# top
//Route::get('admin', 'Admin\IndexController@index')->name('admin.top');
