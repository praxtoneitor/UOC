<?php

namespace App\Http\Controllers;

use App\Mail\NuevaIncidenciaMail;
use App\Models\Client;
use App\Models\Incidencia;
use Illuminate\Support\Facades\Mail;

class IncidenciaController extends Controller
{
    public function obtenerIncidenciasCerradas()
    {
        $incidencias = Incidencia::where('estado', 'cerrado')->get();
        return response()->json(['incidencias' => $incidencias]);
    }

    public function mostrarIncidenciasAbiertas()
    {
        $incidenciasAbiertas = Incidencia::where('estado', 'abierto')->get();

        return view('soporte/incidencias_abiertas', compact('incidenciasAbiertas'));
    }

    public function update()
    {
        $incidencia = Incidencia::find(request()->id);
        $incidencia->solucion = request()->solucion;
        $incidencia->estado = 'cerrado';
        $incidencia->save();

        $cliente = Client::find($incidencia->id_cliente);
        $this->enviarCorreo($cliente, 'cambio');

        return response()->json($incidencia);
    }

    public function enviarCorreo(Client $cliente, $estado)
    {
        Mail::to($cliente->email)->send(new NuevaIncidenciaMail($cliente, $estado));
    }

}