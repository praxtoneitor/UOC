<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController; 
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\EstadoController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MaterialController;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('home');
    }
    return redirect()->route('login');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function() {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('/soporte', [App\Http\Controllers\HomeController::class, 'index'])->name('soporte');
    Route::get('/mantenimiento', [App\Http\Controllers\HomeController::class, 'index'])->name('mantenimiento');

    Route::prefix('servicio')->group(function () {
        Route::get('/', [ServicioController::class, 'view'])->name('view_servicio');
        Route::get('/add', [ServicioController::class, 'create'])->name('add_servicio');
    });


    Route::get('/add_client', [ClientController::class, 'create'])->name('add_client');
    Route::post('/store_client', [ClientController::class, 'store'])->name('store_client'); 
    Route::match(['get', 'post'], '/buscar-cliente', 'App\Http\Controllers\ClientController@buscar')->name('buscar_cliente');
    // Route::get('/add_servicio', [ServicioController::class, 'create'])->name('add_servicio');
    Route::post('/store_servicio', [ServicioController::class, 'store'])->name('store_servicio');
    Route::get('/add_estado', [EstadoController::class, 'create'])->name('add_estado');
    Route::post('/add_estado', [EstadoController::class, 'store'])->name('store_estado');
    // Route::get('/view_servicio', [ServicioController::class, 'view'])->name('view_servicio');
    Route::get('/view_estado', [EstadoController::class, 'view'])->name('view_estado');
    Route::delete('/servicio/{id}', [ServicioController::class, 'borrar'])->name('borrar');
    Route::delete('/estado/{id}', [EstadoController::class, 'borrar'])->name('borrar_estado');
    //Route::get('/add_client', [ServicioController::class, 'viewServicios'])->name('add_client');




    //SOPORTE
    Route::get('/cliente/{id}', [ClientController::class, 'detalle'])->name('cliente_detalle');
    Route::post('/dar_alta', [ClientController::class, 'darAlta'])->name('dar_alta');
    Route::get('/buscar_mac_similar', [MaterialController::class, 'buscarMacSimilar'])->name('buscar_mac_similar');
    //Route::get('/material_cliente', [MaterialClienteController::class, 'index'])->name('material_cliente.index');
    Route::post('/material_cliente', [MaterialClienteController::class, 'store'])->name('material_cliente.store');
    Route::get('/altas_pendientes', [ClientController::class, 'altasPendientes'])->name('altas_pendientes');
    Route::get('/change_client/{id}', [ClientController::class, 'edit'])->name('change_client');
    Route::put('/update_client/{id}', [ClientController::class, 'update'])->name('update_client');

    Route::put('/clientes/{id}/update_observations', [ClientController::class, 'updateObservations'])->name('update_observations');
    Route::put('/cliente/{id}/update-disponibilidad', [ClientController::class, 'updateDisponibilidad'])->name('update_disponibilidad');






    //MANTENIMIENTO
    Route::get('/crear_material', [MaterialController::class, 'create'])->name('crear_material');
    Route::post('/store_material', [MaterialController::class, 'store'])->name('store_material');





    // ADMIN
    Route::get('/users', [App\Http\Controllers\AdminController::class, 'users'])->name('admin.users');
    Route::post('/default_estado/{id}', [EstadoController::class, 'actualizarEstado'])->name('default_estado');


    Route::prefix('api')->group(function () {
        Route::get('/admin/users', [App\Http\Controllers\AdminController::class, 'getUser'])->name('api.getUser');
        Route::post('/admin/users/update', [App\Http\Controllers\AdminController::class, 'updateUser'])->name('api.updateUser');
        Route::post('/admin/users/store', [App\Http\Controllers\AdminController::class, 'storeUser'])->name('api.storeUser');
        Route::post('/admin/users/delete', [App\Http\Controllers\AdminController::class, 'deleteUser'])->name('api.deleteUser');
      Route::post('/soporte/client/updateDisponibilidad', [App\Http\Controllers\ClientController::class, 'updateDisponibilidad'])->name('api.updateDisponibilidad');
    });

});