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

Route::get('/', 'User\LoginController@index');
Route::get('back_to_home', 'User\RolePermissionController@back_to_home')->name('back_to_home');
Route::get('/login', 'User\LoginController@index');
Route::post('login', 'User\LoginController@Auth');


Route::group(['middleware' => ['preventbackbutton','auth']], function(){

    Route::get('dashboard', 'User\HomeController@index');
    Route::get('logout', 'User\LoginController@logout');

    Route::group(['prefix' => 'role'], function () {
        Route::get('/', 'User\RoleController@index')->name('add-role.index');
        Route::post('/store', 'User\RoleController@store')->name('add-role.store');
        Route::get('/create', 'User\RoleController@create')->name('add-role.create');
        Route::get('/edit/{id}', 'User\RoleController@edit')->name('add-role.edit');
        Route::put('/update/{id}', 'User\RoleController@update')->name('add-role.update');
        Route::get('/destroy', 'User\RoleController@destroy')->name('add-role.destroy');
    });

    Route::group(['prefix' => 'permission'], function () {
        Route::get('/', 'User\RolePermissionController@index')->name('permission.index');
        Route::post('/store', 'User\RolePermissionController@store')->name('permission.store');
        Route::post('/get_all_menu', 'User\RolePermissionController@getAllMenu')->name('permission.getAllMenu');
    });

    Route::group(['prefix' => 'user'], function () {
        Route::get('/', 'User\UserController@index')->name('user.index');
        Route::post('/store', 'User\UserController@store')->name('user.store');
        Route::get('/create', 'User\UserController@create')->name('user.create');
        Route::get('/edit/{id}', 'User\UserController@edit')->name('user.edit');
        Route::put('/update/{id}', 'User\UserController@update')->name('user.update');
        Route::get('/destroy', 'User\UserController@destroy')->name('user.destroy');
    });

    Route::group(['prefix' => 'changePassword'], function () {
        Route::get('/', 'User\ChangePasswordController@index')->name('changePassword.index');
        Route::put('/update/{id}', 'User\ChangePasswordController@update')->name('changePassword.update');
    });

});

