<?php

namespace App\Http\Controllers;

use App\Models\Averia;

use Illuminate\Http\Request;

class AveriaController extends Controller
{
    public function listarAverias()
    {
        $averias = Averia::with('nodo')->get();
        return view('mantenimiento.averias_lista', compact('averias'));
    }
}