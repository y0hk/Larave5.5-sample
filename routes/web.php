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

//# login
//Route::get('admin/login', 'Admin\LoginController@showLoginForm')->name('admin.login');
//Route::post('admin/login', 'Admin\LoginController@login');
//# logout
//Route::get('admin/logout', 'Admin\LoginController@logout')->name('admin.logout');
//
//# top
//Route::get('admin', 'Admin\IndexController@index')->name('admin.top');

// Admin
Route::prefix('admin')->namespace('Admin')->as('admin.')->group(function(){
    Route::middleware('guest:admin')->group(function(){
        # login
        Route::get('login', 'LoginController@showLoginForm')->name('login');
        Route::post('login', 'LoginController@login');

    });
    // Admin
    Route::middleware('auth:admin')->group(function(){
        # logout
        Route::get('logout', 'LoginController@logout')->name('logout');

        # top
        Route::get('', 'IndexController@index')->name('top');

        # messages
        Route::get('message', 'MessageController@index')->name('message.index');
        Route::get('message/create', 'MessageController@create')->name('message.create');
        Route::post('message/create', 'MessageController@store');
        Route::get('message/edit/{message}', 'MessageController@edit')->name('message.edit');
        Route::post('message/edit/{message}', 'MessageController@update');

        // User maintenance
        Route::get('user', 'UserController@index')->name('user.index');
        Route::delete('user/destroy/{user}', 'UserController@destroy')->name('user.destroy');
    });
});

// User
Route::prefix('user')->namespace('User')->as('user.')->group(function(){
    Route::middleware('guest:user')->group(function(){
       Route::get('login', 'LoginController@showLoginForm')->name('login');
       Route::post('login', 'LoginController@login');
    });

    Route::middleware('auth:user')->group(function(){
       Route::get('', 'IndexController@index')->name('top');
       Route::get('logout', 'LoginController@logout')->name('logout');

       // Profile edit
       Route::get('profile/edit', 'ProfileController@edit')->name('profile.edit');
       Route::post('profile/edit', 'ProfileController@update');

       // Message
       Route::get('message', 'MessageController@index')->name('message.index');
       Route::get('message/show/{message}', 'MessageController@show')->name('message.show');
    });
});
