<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Material;

class MaterialController extends Controller
{
    public function create()
    {
        return view('mantenimiento.crear_material');
    }


    public function store(Request $request)
    {
// Verificar si la dirección MAC ya existe
$existingMac = Material::where('mac', $request->input('mac'))->first();
if ($existingMac) {
    // Si existe, retornar un error
    return response()->json(['error' => 'La dirección MAC ya está registrada.'], 409); 
}


        $material = new Material();
        $material->marca = $request->input('marca');
        $material->modelo = $request->input('modelo');
        $material->num_serie = $request->input('num_serie');
        $material->mac = $request->input('mac');
        $material->save();

        return redirect()->route('crear_material');
    }

    public function mostrarMateriales(Request $request)
    {
        $request->flash();

        $materiales = Material::marca($request->input('marca'))->modelo($request->input('modelo'))->get();
        $marcas = Material::distinct()->pluck('marca');
        $modelos = Material::distinct()->pluck('modelo');

        $oldRequest = session()->getOldInput();
        unset($oldRequest["page"]);

        return view('mantenimiento.mostrar_material', compact('materiales', 'marcas', 'modelos', 'oldRequest'));
    }

    
    
    public function buscarMacSimilar(Request $request)
    {
        $mac = $request->input('mac');
        $material = Material::where('mac', 'LIKE', $mac . '%')->first();
        if ($material) {
            return response()->json(['mac' => $material->mac, 'utilizado' => $material->utilizado]);
        } else {
            return response()->json(['mac' => null]);
        }
    }



    public function filtrar(Request $request) {
        $marca = $request->input('marca');
        $modelo = $request->input('modelo');
    
        $query = Material::query();
    
        if ($marca) {
            $query->where('marca', $marca);
        }
    
        if ($modelo) {
            $query->where('modelo', $modelo);
        }
    
        $materiales = $query->get();
    
        return view('partials.material_table', ['materiales' => $materiales]);
    }
}