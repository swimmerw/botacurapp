<?php

use App\Http\Controllers\ReservaController;
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

Route::get('test', function () {
    return 'hola';
})->middleware('role:paciente');

Route::get('/', function () {
    return view('welcome');
});

Route::get('home', function () {
    return view('home');
})->middleware('auth');
Auth::routes(['verify' => true]);

Route::group(['middleware' => ['auth'], 'as' => 'backoffice.'], function () {
    // Route::get('role', 'RoleController@index')->name('role.index');
    // Route::get('home','AdminController@show')->name('admin.show');
    Route::get('home', 'AdminController@show')->name('admin.show');

    Route::resource('user', 'UserController');
    Route::get('user/{user}/assign_role', 'UserController@assign_role')->name('user.assign_role');
    Route::post('user/{user}/role_assignment', 'UserController@role_assignment')->name('user.role_assignment');

    Route::get('user/{user}/assign_permission', 'UserController@assign_permission')->name('user.assign_permission');
    Route::post('user/{user}/permission_assignment', 'UserController@permission_assignment')->name('user.permission_assignment');

    // Metodos Reservas
    
    // Index - Mostrar una lista de reservas
    Route::get('reserva', 'ReservaController@index')->name('reserva.index');
    
    // Create - Ingresa al formulario para nueva reserva
    Route::get('reserva/create/{cliente}', 'ReservaController@create')->name('reserva.create');

    // Store - Guardar la nueva reserva
    Route::post('reserva', 'ReservaController@store')->name('reserva.store');

    // Show - Mostrar una reserva específica
    Route::get('reserva/{id}', 'ReservaController@show')->name('reserva.show');

    // Edit - Mostrar el formulario para editar una reserva
    Route::get('reserva/{id}/edit', 'ReservaController@edit')->name('reserva.edit');

    // Update - Actualizar una reserva específica
    Route::put('reserva/{id}', 'ReservaController@update')->name('reserva.update');

    Route::resource('role', 'RoleController');
    Route::resource('permission', 'PermissionController');
    Route::resource('programa', 'ProgramaController');
    Route::resource('servicio', 'ServicioController');
    Route::resource('cliente', 'ClienteController');
    // Route::resource('reserva', 'ReservaController');
});
