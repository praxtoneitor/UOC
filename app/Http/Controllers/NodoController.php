<?php

namespace App\Http\Controllers;

use App\Models\Averia;
use Illuminate\Http\Request;
use App\Models\Material;
use App\Models\Nodo;
use App\Models\RelMaterialNodo;


class NodoController extends Controller
{

    public function index()
    {
        $nodos = Nodo::all();
        return view('mantenimiento.ver_nodos', compact('nodos'));
    }

    public function destroy()
    {
        $node_id = request()->id;
        // Verificar si el nodo está presente en la tabla relacionada
        if (RelMaterialNodo::where('id_nodo', $node_id)->exists()) {
            return ['status' => 'error', 'message' => 'No se puede borrar el nodo porque tiene materiales asignados.'];
        }

        // Si no está presente en la tabla relacionada, proceder con el borrado
        $nodo = Nodo::find($node_id);
        $nodo->delete();
        return ['status' => 'success', 'message' => 'Nodo borrado correctamente.'];
    }

    public function create()
    {
        return view('mantenimiento.crear_localizacion');
    }

    public function store(Request $request)
    {
        $nodo = new Nodo();
        $nodo->nombre = $request->input('nombre');
        $nodo->geoposicionamiento = $request->input('geoposicionamiento');
        $nodo->save();


        return redirect()->route('crear_localizacion');
    }

    public function formularioAsignarMaterial()
    {
        $nodos = Nodo::all();
        $materiales = Material::where('utilizado', 0)->get();

        return view('/mantenimiento/formulario_asignar_material', compact('nodos', 'materiales'));
    }

    public function asignarMaterial(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'nodo_id' => 'required|exists:nodos,id',
            'material_id' => 'required|exists:material,id',
            'ip' => 'required|string',
            'alias' => 'required|string',
        ]);

        // Obtener el nodo y el material
        $nodo = Nodo::findOrFail($request->nodo_id);
        $material = Material::findOrFail($request->material_id);

        // Asignar el material al nodo
        $nodo->material()->attach($material, [
            'ip' => $request->ip,
            'alias' => $request->alias,
        ]);

        //Marco el equipo como utilizado
        $material->update(['utilizado' => 1]);

        // Redirigir con un mensaje de éxito
        return redirect()->back()->with('success', 'Material asignado correctamente al nodo.');
    }

    public function mostrarNodos()
    {

        $nodos = Nodo::all();

        // Retornar la vista con los datos
        return view('mantenimiento.mostrar_nodos', compact('nodos'));
    }

    public function mostrarFormulario()
    {
        $nodos = Nodo::all();

        return view('mantenimiento.averias', compact('nodos'));
    }

    public function obtenerEquipos($nodoId)
    {
        // Obtener los equipos asociados con el nodo seleccionado
        $nodo = Nodo::find($nodoId);
        $relacion = RelMaterialNodo::where('id_nodo', $nodo->id)->first();
        $materialUsado = Material::where('id', $relacion->id_material)->get();

        $material = Material::where('utilizado', 0)->get();

        // Devolver los equipos en formato JSON
        return compact('materialUsado', 'material');
    }

    public function guardarAveria(Request $request)
    {
        $averia = new Averia();
        $averia->id_nodo = $request->input('nodo_id');
        $averia->descripcion = $request->input('descripcion');
        $averia->solucion = $request->input('solucion');
        $averia->susti_A = $request->input('equipo_id');
        $averia->susti_B = $request->input('material_id');
        $averia->save();

        $relacion = RelMaterialNodo::where('id_nodo', $request->input('nodo_id'))->first();
        $materialLibre = $relacion->id_material;
        $relacion->id_material = $averia->susti_B;
        $relacion->save();

        $material = Material::find($materialLibre);
        $material->utilizado = 0;
        $material->save();

        $material = Material::find($averia->susti_B);
        $material->utilizado = 1;
        $material->save();

        return response()->json(['success' => true, 'message' => 'Avería reportada con éxito']);
    }



    public function formularioEliminarMaterial()
    {
        $nodos = Nodo::all();
        return view('mantenimiento.formulario_eliminar_material', compact('nodos'));
    }

    public function obtenerMaterialesNodo($id)
    {
        $nodo = Nodo::with('material')->findOrFail($id);
        $materiales = $nodo->material;
        return response()->json($materiales);
    }

    public function eliminarMaterial()
    {
        $id = request()->id;
        $relacion = RelMaterialNodo::where('id_material', $id)->get()->first();

        // Actualizar el material a no utilizado
        $material = Material::find($relacion->id_material);
        $material->utilizado = 0;
        $material->save();

        // Eliminar la relación
        $relacion->delete();

        return ['status' => 'success', 'message' => 'Material eliminado correctamente.'];
    }



}