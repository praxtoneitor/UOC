<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Models\Factura;
use App\Models\Cliente;
use Illuminate\Support\Facades\Auth;

class FacturaController extends Controller
{
    public function index()
    {

        // Obtener el usuario autenticado
        $cliente = Client::with('user')->whereHas('user', function ($query) {
            $query->where('id', Auth::id());
        })->first();

        // Obtener las facturas del cliente
        $facturas = Factura::with('cliente.user')->where('cliente_id', $cliente->id)->get();

        // Retornar la vista con las facturas
        return view('clientes.factura_cliente', compact('facturas', 'cliente'));
    }
}