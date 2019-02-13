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

Route::middleware(['auth'])->group(function(){
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
    Route::get('companies/index', 'CompanyController@index')->name('companies.index')->middleware('permission:index_companies');
    Route::get('companies', 'CompanyController@index_administrator')->name('companies.index_administrator')->middleware('permission:index_admin_companies');
    Route::get('companies/users/{company}', 'CompanyController@index_users_company')->name('companies.index_users_company')->middleware('permission:index_users_company');
    Route::get('companies/delegations/{company}', 'CompanyController@index_delegations_company')->name('delegations.index_delegations_company')->middleware('permission:index_delegations_company');
    Route::get('companies/{company}', 'CompanyController@show')->name('companies.show')->middleware('permission:show_companies');
    Route::patch('companies/{company}', 'CompanyController@update')->name('companies.update')->middleware('permission:edit_companies'); 
    Route::get('companies/{company}/edit', 'CompanyController@edit')->name('companies.edit')->middleware('permission:edit_companies');
    Route::delete('companies/{company}', 'CompanyController@destroy')->name('companies.destroy')->middleware('permission:destroy_companies');
    Route::get('companies/{user}/assigncreate', 'CompanyController@create_assign_companies')->name('companies.create_assign_companies')->middleware('permission:assign_admin_companies');
    Route::post('companies/{user}/assignstore', 'CompanyController@store_assign_companies')->name('companies.store_assign_companies')->middleware('permission:assign_admin_companies');

    //Delegations

    Route::get('delegations/create', 'DelegationController@create')->name('delegations.create')->middleware('permission:create_delegations');
    Route::post('delegations/store', 'DelegationController@store')->name('delegations.store')->middleware('permission:create_delegations');
    Route::get('delegations/index', 'DelegationController@index')->name('delegations.index')->middleware('permission:index_delegations');
    Route::get('delegations', 'DelegationController@index_administrator')->name('delegations.index_administrator')->middleware('permission:index_admin_delegations');
    Route::get('delegations/users/{delegation}', 'DelegationController@index_users_delegation')->name('delegations.index_users_delegation')->middleware('permission:index_users_delegation');
    Route::get('delegations/{delegation}', 'DelegationController@show')->name('delegations.show')->middleware('permission:show_delegations');
    Route::patch('delegations/{delegation}', 'DelegationController@update')->name('delegations.update')->middleware('permission:edit_delegations'); 
    Route::get('delegations/{delegation}/edit', 'DelegationController@edit')->name('delegations.edit')->middleware('permission:edit_delegations');
    Route::delete('delegations/{delegation}', 'DelegationController@destroy')->name('delegations.destroy')->middleware('permission:destroy_delegations');

    //Departments

    Route::get('departments/create', 'DepartmentController@create')->name('departments.create')->middleware('permission:create_departments');
    Route::post('departments/store', 'DepartmentController@store')->name('departments.store')->middleware('permission:create_departments');
});