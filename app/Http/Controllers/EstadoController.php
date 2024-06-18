<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\Estado; 

class EstadoController extends Controller
{
    /**
     * Muestra el formulario para crear un nuevo estado.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.add_estado');
    }

    /**
     * Almacena un nuevo estado en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:255',
            'font_color' => 'required|string|max:7', // formato de color hexadecimal (#FFFFFF)
            'bg_color' => 'required|string|max:7', // formato de color hexadecimal (#FFFFFF)
        ]);

        // Crear un nuevo estado en la base de datos
        Estado::create([
            'nombre' => $request->nombre,
            'font_color' => $request->font_color,
            'bg_color' => $request->bg_color,
        ]);

        // Redirigir al usuario a una página de éxito
        return redirect()->route('add_estado')->with('success', '¡Estado creado correctamente!');
    }


        public function view()
    {
        $estado = Estado::all(); // Obtener todos los estados
        return view('admin.view_estado', compact('estado')); // Pasar los estados a la vista
        
    }

    public function borrar($id)
    {
    
        $estado = Estado::find($id);

    
        if (!$estado) {
            return redirect()->route('view_estado')->with('error', 'El estado no existe');
        }

     
        try {
            $estado->delete();
            return redirect()->route('view_estado')->with('success', 'El estado se ha eliminado correctamente');
        } catch (\Exception $e) {
            // En caso de error, redirigir con un mensaje de error
            return redirect()->route('view_estado')->with('error', 'Error al eliminar el estado: ' . $e->getMessage());
        }
    }

    public function actualizarEstado(Request $request, $id)
    {
        // Encontrar el estado por su ID
        $estado = Estado::find($id);

        // Verificar si el estado existe
        if (!$estado) {
            return response()->json(['error' => 'Estado no encontrado'], 404);
        }

        // Iniciar una transacción de base de datos
        DB::beginTransaction();

        try {
            // Establecer el campo "default" del estado actual como "si"
            $estado->default = 'si';
            $estado->save();

            // Establecer el campo "default" de los demás estados como "no"
            Estado::where('id', '<>', $id)->update(['default' => 'no']);

            // Confirmar la transacción
            DB::commit();

            // Guardar un mensaje en la sesión para mostrar después de la redirección
            Session::flash('message', 'Estado establecido por defecto');

            // Redirigir de vuelta a la página anterior o a alguna ruta específica
            return redirect()->back();
        } catch (\Exception $e) {
            // Revertir la transacción si hay un error
            DB::rollBack();
            return response()->json(['error' => 'Hubo un error al establecer el estado por defecto'], 500);
        }
    }

}