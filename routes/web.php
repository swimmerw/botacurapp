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



Route::get('test', function(){
    return 'hola';
})->middleware('role:paciente');

Route::get('/', function() {
    return view('welcome');
});




Route::get('home', function(){
    return view ('home');
})->middleware('auth');
Auth::routes(['verify'=> true]);




Route::group(['middleware'=>['auth'], 'as' =>'backoffice.'], function(){
    // Route::get('role', 'RoleController@index')->name('role.index');
    Route::get('admin','AdminController@show')->name('admin.show');
    
    Route::resource('user', 'UserController');
    Route::get('user/{user}/assign_role','UserController@assign_role')->name('user.assign_role');
    Route::post('user/{user}/role_assignment', 'UserController@role_assignment')->name('user.role_assignment');

    Route::get('user/{user}/assign_permission', 'UserController@assign_permission')->name('user.assign_permission');
    Route::post('user/{user}/permission_assignment', 'UserController@permission_assignment')->name('user.permission_assignment');


    Route::resource('role','RoleController' );
    Route::resource('permission', 'PermissionController');
    Route::resource('programa','ProgramaController');
    Route::resource('servicio', 'ServicioController');
});


