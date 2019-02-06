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
Route::get('roles/{role}/edit', 'RoleController@edit')->name('roles.edit')->middleware('permission:edit_roles');
Route::patch('roles/{role}', 'RoleController@update')->name('roles.update')->middleware('permission:edit_roles');
Route::delete('roles/{role}', 'RoleController@destroy')->name('roles.destroy')->middleware('permission:destroy_roles');