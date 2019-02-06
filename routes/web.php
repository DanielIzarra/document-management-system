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

Auth::routes(['register' => true]);

Route::get('/home', 'HomeController@index')->name('home');

// Roles

Route::post('roles/store', 'RoleController@store')->name('roles.store')->middleware('permission:create_roles');
Route::get('roles/create', 'RoleController@create')->name('roles.create')->middleware('permission:create_roles');
Route::get('roles', 'RoleController@index')->name('roles.index')->middleware('permission:index_roles');