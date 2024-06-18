<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Servicio;
use App\Models\Client;
use Illuminate\Support\Facades\View;


class ServicioController extends Controller
{
    /**
     * Muestra el formulario para crear un nuevo servicio.
     *
     * @return \Illuminate\Contracts\View\View
     */

    public function create()
    {
        return view('admin.add_servicio');
    }

    /**
     * Almacena un nuevo servicio en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric',
        ]);

        // Crear una nueva instancia del modelo Servicio con los datos del formulario
        $servicio = new Servicio([
            'nombre' => $request->input('nombre'),
            'precio' => $request->input('precio'),
        ]);

        // Guardar el servicio en la base de datos
        $servicio->save();

        // Redirigir a una página de éxito o mostrar un mensaje de éxito
        return redirect()->route('add_servicio')->with('success', 'Servicio añadido correctamente');
    }

    public function view()
    {
        $servicios = Servicio::all();
        return view('admin.view_servicio', compact('servicios'));
    }
    
  

    public function borrar(Request $request, $id)
    {
        $servicio = Servicio::findOrFail($id);
    
        // Verificar si el servicio está siendo utilizado por algún cliente
        $cliente = Client::where('servicio_id', $id)->first();
        
        if ($cliente) {
            return View::make('admin.error_servicio');
        }
    
        // Si no hay clientes utilizando este servicio, proceder con la eliminación
        if ($servicio->delete()) {
        return redirect()->back()->with('success', 'Servicio borrado correctamente.');
    }
}
}