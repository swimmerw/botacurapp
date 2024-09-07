<?php

use App\CategoriaCompra;
use App\Sector;
use App\TipoDocumento;
use App\TipoProducto;
use App\TipoTransaccion;
use App\Ubicacion;
use App\UnidadMedida;
use App\Venta;
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
    Route::get('reserva/{reserva}', 'ReservaController@show')->name('reserva.show');

    // Edit - Mostrar el formulario para editar una reserva
    // Route::get('reserva/{id}/edit', 'ReservaController@edit')->name('reserva.edit');

    Route::get('reserva/{reserva}/edit', 'ReservaController@edit')->name('reserva.edit');

    // Update - Actualizar una reserva específica
    Route::put('reserva/{reserva}', 'ReservaController@update')->name('reserva.update');

    Route::delete('reserva/{reserva}', 'ReservaController@destroy')->name('reserva.destroy');




    // Metodos Complementos CREAR
    Route::get('sectores/create', function () {
        return view('themes.backoffice.pages.sector.create');
    })->name('sectores.create');

    Route::get('ubicaciones/create', function () {
        return view('themes.backoffice.pages.ubicacion.create');
    })->name('ubicaciones.create');

    Route::get('unidades_medidas/create', function () {
        return view('themes.backoffice.pages.unidad_medida.create');
    })->name('unidades_medidas.create');

    Route::get('tipo_documentos/create', function () {
        return view('themes.backoffice.pages.tipo_documento.create');
    })->name('tipo_documentos.create');

    Route::get('tipo_transacciones/create', function () {
        return view('themes.backoffice.pages.tipo_transaccion.create');
    })->name('tipo_transacciones.create');

    Route::get('categoria_compras/create', function () {
        return view('themes.backoffice.pages.categoria_compra.create');
    })->name('categoria_compras.create');

    Route::get('tipo_productos/create', function () {
        $sectores = Sector::all();
        return view('themes.backoffice.pages.tipo_producto.create', compact('sectores'));
    })->name('tipo_productos.create');




    // Metodos Complementos EDITAR
    Route::get('sector/{id}/edit', function ($id) {

        $sector = Sector::findOrFail($id);
        return view('themes.backoffice.pages.sector.edit', compact('sector'));

    })->name('sector.edit');

    Route::get('ubicacion/{id}/edit', function ($id) {

        $ubicacion = Ubicacion::findOrFail($id);
        return view('themes.backoffice.pages.ubicacion.edit', compact('ubicacion'));

    })->name('ubicacion.edit');

    Route::get('unidad_medida/{id}/edit', function ($id) {
        $unidad = UnidadMedida::findOrFail($id);
        return view('themes.backoffice.pages.unidad_medida.edit', compact('unidad'));
    })->name('unidad_medida.edit');

    Route::get('tipo_documento/{id}/edit', function ($id) {
        $documento = TipoDocumento::findOrFail($id);
        return view('themes.backoffice.pages.tipo_documento.edit', compact('documento'));
    })->name('tipo_documento.edit');

    Route::get('tipo_transaccion/{id}/edit', function ($id) {
        $transaccion = TipoTransaccion::findOrFail($id);
        return view('themes.backoffice.pages.tipo_transaccion.edit', compact('transaccion'));
    })->name('tipo_transaccion.edit');

    Route::get('categoria_compras/{id}/edit', function ($id) {
        $categoria = CategoriaCompra::findOrFail($id);
        return view('themes.backoffice.pages.categoria_compra.edit', compact('categoria'));
    })->name('categoria_compras.edit');

    Route::get('tipo_producto/{id}/edit', function ($id) {
        $producto = TipoProducto::findOrFail($id);
        return view('themes.backoffice.pages.tipo_producto.edit', compact('producto'));
    })->name('tipo_producto.edit');

    Route::resource('role', 'RoleController');
    Route::resource('permission', 'PermissionController');
    Route::resource('programa', 'ProgramaController');
    Route::resource('servicio', 'ServicioController');
    Route::resource('cliente', 'ClienteController');
    Route::resource('complemento', 'ComplementoController');
    Route::resource('reserva.reagendamientos', 'ReagendamientoController');
    Route::resource('reserva.visitas', 'VisitaController');
    Route::resource('visita', 'VisitaController');
    Route::resource('reserva.venta', 'VentaController');
});
