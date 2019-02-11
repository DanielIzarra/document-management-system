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

// Users
    
Route::get('users/create', 'UserController@create')->name('users.create')->middleware('permission:create_users');
Route::post('users/store', 'UserController@store')->name('users.store')->middleware('permission:create_users');
Route::get('users', 'UserController@index')->name('users.index')->middleware('permission:index_users');
Route::get('users/{user}', 'UserController@show')->name('users.show')->middleware('permission:show_users');
Route::patch('users/{user}', 'UserController@update')->name('users.update')->middleware('permission:edit_users'); 
Route::get('users/{user}/edit', 'UserController@edit')->name('users.edit')->middleware('permission:edit_users');
Route::delete('users/{user}', 'UserController@destroy')->name('users.destroy')->middleware('permission:destroy_users');

//Companies

Route::get('companies/create', 'CompanyController@create')->name('companies.create')->middleware('permission:create_companies');
Route::post('companies/store', 'CompanyController@store')->name('companies.store')->middleware('permission:create_companies');
Route::get('companies', 'CompanyController@index')->name('companies.index')->middleware('permission:index_companies');
Route::get('companies/{company}', 'CompanyController@show')->name('companies.show')->middleware('permission:show_companies');