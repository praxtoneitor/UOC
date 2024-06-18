<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MaterialCliente;

class MaterialClienteController extends Controller
{
    /**
     * Almacena una nueva asignación de material a cliente.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    // Valida los datos del formulario
    $request->validate([
        'material_id' => 'required',
        'cliente_id' => 'required',
    ]);

    // Crea una nueva entrada en la tabla material_cliente
    MaterialCliente::create([
        'material_id' => $request->material_id,
        'cliente_id' => $request->cliente_id,
    ]);

   
    return redirect()->route('cliente_detalle', ['id' => $request->cliente_id])->with('success', '¡La asignación de material al cliente se ha guardado correctamente!');
}



}