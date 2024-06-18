<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\EstadoController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\IncidenciaController;
use App\Http\Controllers\NodoController;
use App\Http\Controllers\AveriaController;
use App\Mail\addClientPassword;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\MailController;
use App\Http\Controllers\MaterialClienteController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FacturaController;
use App\Http\Controllers\AppNameController;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('home');
    }
    return redirect()->route('login');
});

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
});


//MAIL
Route::get('/contact', [MailController::class, 'showContactForm'])->name('contact.form');
Route::post('/send-email', [MailController::class, 'sendEmail'])->name('send.email');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('/soporte', [App\Http\Controllers\HomeController::class, 'index'])->name('soporte');
    Route::get('/mantenimiento', [App\Http\Controllers\HomeController::class, 'index'])->name('mantenimiento');

    Route::prefix('servicio')->group(function () {
        Route::get('/', [ServicioController::class, 'view'])->name('view_servicio');
        Route::get('/add', [ServicioController::class, 'create'])->name('add_servicio');
    });


    Route::get('/add_client', [ClientController::class, 'create'])->name('add_client');
    Route::post('/store_client', [ClientController::class, 'store'])->name('store_client');
    Route::match (['get', 'post'], '/buscar-cliente', 'App\Http\Controllers\ClientController@buscar')->name('buscar_cliente');
    Route::post('/store_servicio', [ServicioController::class, 'store'])->name('store_servicio');
    Route::get('/add_estado', [EstadoController::class, 'create'])->name('add_estado');
    Route::post('/add_estado', [EstadoController::class, 'store'])->name('store_estado');
    Route::get('/view_estado', [EstadoController::class, 'view'])->name('view_estado');
    Route::delete('/servicio/{id}', [ServicioController::class, 'borrar'])->name('borrar');
    Route::delete('/estado/{id}', [EstadoController::class, 'borrar'])->name('borrar_estado');
    Route::get('/test', [ClientController::class, 'test'])->name('test');


    //SOPORTE
    Route::get('/cliente/{id}', [ClientController::class, 'detalle'])->name('cliente_detalle');
    Route::post('/dar_alta', [ClientController::class, 'darAlta'])->name('dar_alta');
    Route::get('/buscar_mac_similar', [MaterialController::class, 'buscarMacSimilar'])->name('buscar_mac_similar');
    Route::post('/material_cliente', [MaterialClienteController::class, 'store'])->name('material_cliente.store');
    Route::get('/altas_pendientes', [ClientController::class, 'altasPendientes'])->name('altas_pendientes');
    Route::get('/change_client/{id}', [ClientController::class, 'edit'])->name('change_client');
    Route::put('/update_client/{id}', [ClientController::class, 'update'])->name('update_client');
    Route::post('/guardar_incidencia', [ClientController::class, 'storeIncidencia'])->name('guardar_incidencia');
    Route::post('/clientes/actualizar-observaciones', [ClientController::class, 'actualizar'])->name('actualizar_observaciones');
    Route::put('/cliente/{id}/update-disponibilidad', [ClientController::class, 'updateDisponibilidad'])->name('update_disponibilidad');
    Route::get('/clientes_incidencias/{id}', [ClientController::class, 'mostrarDetallesIncidencias'])->name('clientes_incidencias');
    Route::get('/incidencias_cerradas', [IncidenciaController::class, 'obtenerIncidenciasCerradas'])->name('incidencias.cerradas');
    Route::get('/clientes_incidencias_list/{id}/', [IncidenciaController::class, 'mostrarIncidenciasCliente'])->name('clientes_incidencias_list');
    Route::get('/soporte/incidencias_abiertas', [IncidenciaController::class, 'mostrarIncidenciasAbiertas'])->name('incidencias_abiertas');
    Route::post('/enviar_correo', [ClientController::class, 'enviarCorreo'])->name('enviar.correo');


    //MANTENIMIENTO
    Route::get('/crear_material', [MaterialController::class, 'create'])->name('crear_material');
    Route::post('/store_material', [MaterialController::class, 'store'])->name('store_material');
    Route::match (['get', 'post'], '/mantenimiento/mostrar_material', [MaterialController::class, 'mostrarMateriales'])->name('mostrar_material');
    Route::get('/filtrar-materiales', [MaterialController::class, 'filtrarMateriales'])->name('filtrar-materiales');
    Route::get('/crear_localizacion', [NodoController::class, 'create'])->name('crear_localizacion');
    Route::post('/store_localizacion', [NodoController::class, 'store'])->name('store_localizacion');
    Route::get('/mostrar_localizaciones', [NodoController::class, 'mostrarLocalizaciones'])->name('mostrar_localizaciones');
    Route::get('/formulario_asignar_material', [NodoController::class, 'formularioAsignarMaterial'])->name('formulario_asignar_material');
    Route::post('/save_nodo_material', [NodoController::class, 'asignarMaterial'])->name('save_nodo_material');
    Route::get('/mostrar_nodos', [NodoController::class, 'mostrarNodos'])->name('mostrar_nodos');
    Route::get('/formulario_eliminar_material', [NodoController::class, 'formularioEliminarMaterial'])->name('formulario_eliminar_material');
    Route::get('/nodo/{id}/materiales', [NodoController::class, 'obtenerMaterialesNodo'])->name('obtener_materiales_nodo');
    Route::post('/eliminar_material', [NodoController::class, 'eliminarMaterial'])->name('eliminar_material');
    //////////////MOSTRAR LOCALIZACIONES
    Route::get('/ver_nodos', [NodoController::class, 'index'])->name('ver_nodos');
    Route::delete('/nodos/{nodo}', [NodoController::class, 'destroy'])->name('nodos.destroy');
    Route::get('/averias', [NodoController::class, 'mostrarFormulario'])->name('averias');
    Route::post('/guardar_averia', [NodoController::class, 'guardarAveria'])->name('guardar_averia');
    Route::get('/obtener_equipos/{nodoId}', [NodoController::class, 'obtenerEquipos']);
    Route::get('/averias_lista', [AveriaController::class, 'listarAverias'])->name('averias_lista');



    //CLIENTES
    Route::get('/facturas-cliente', [FacturaController::class, 'index'])->name('facturas.index');



    // ADMIN
    Route::get('/users', [App\Http\Controllers\AdminController::class, 'users'])->name('admin.users');
    Route::post('/default_estado/{id}', [EstadoController::class, 'actualizarEstado'])->name('default_estado');
    Route::get('/generate-all-pdfs', [PdfController::class, 'generateAllPdfs'])->name('generate.all.pdfs');
    Route::get('/pdf-success', [PdfController::class, 'showSuccessMessage'])->name('pdf.success');
    Route::get('/select-status', [PdfController::class, 'showSelectStatusForm'])->name('select_status');


    // Ruta para mostrar el formulario de generación de PDFs
    Route::get('/pdf-generate', [PdfController::class, 'showPdfGenerateForm'])->name('pdf.generate_form');

    // Ruta para manejar el formulario y generar los PDFs basados en el estado seleccionado
    Route::post('/generate-pdfs', [PdfController::class, 'generateAllPdfs'])->name('pdf.generate');

    // Ruta para mostrar el mensaje de éxito después de generar los PDFs
    Route::get('/pdf-success', [PdfController::class, 'showSuccessMessage'])->name('pdf.success');
    //Para establecer nombre de la empresa
    Route::get('/app-name', [AppNameController::class, 'showForm'])->name('admin.form_empresa');
    Route::post('/app-name', [AppNameController::class, 'store'])->name('admin.store_empresa');



    Route::prefix('api')->group(function () {
        Route::get('/admin/users', [App\Http\Controllers\AdminController::class, 'getUser'])->name('api.getUser');
        Route::post('/admin/users/update', [App\Http\Controllers\AdminController::class, 'updateUser'])->name('api.updateUser');
        Route::post('/admin/users/store', [App\Http\Controllers\AdminController::class, 'storeUser'])->name('api.storeUser');
        Route::post('/admin/users/delete', [App\Http\Controllers\AdminController::class, 'deleteUser'])->name('api.deleteUser');
        \Illuminate\Support\Facades\Log::info('Llegó a la ruta api');
        Route::post('/soporte/client/updateDisponibilidad', [App\Http\Controllers\ClientController::class, 'updateDisponibilidad'])->name('api.updateDisponibilidad');
        Route::get('/soporte/client/updateObservaciones', [App\Http\Controllers\ClientController::class, 'updateObservaciones'])->name('api.updateObservaciones');
        Route::post('/soporte/incidencia/update', [App\Http\Controllers\IncidenciaController::class, 'update'])->name('api.updateIncidencia');

        // NODOS
        Route::post('/destroy_nodo', [NodoController::class, 'destroy'])->name('api.destroy_nodo');

    });

});