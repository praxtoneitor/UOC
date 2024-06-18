<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Muestra la vista de inicio.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Obtener el rol del usuario
        $rol = auth()->user()->rol;

        // Inicializar el mensaje como una cadena vacía
        $mensaje = '';
        $mensaje2 = '';

        $cliente = Client::with('user')->whereHas('user', function ($query) {
            $query->where('id', Auth::id());
        })->first();

        // Determinar el mensaje de saludo dependiendo del rol
        if ($rol === 'soporte') {
            $mensaje .= 'técnico de soporte';
            // Si es un usuario de soporte, mostrar la vista home.blade.php
            return view('soporte', ['mensaje' => $mensaje]);

        } elseif ($rol === 'mantenimiento') {
            $mensaje .= 'técnico de mantenimiento';
            return view('mantenimiento', ['mensaje' => $mensaje]);

        } elseif ($rol === 'administrador') {
            $mensaje2 .= 'administrador';
            return view('admin', ['mensaje' => $mensaje2, 'isAdmin' => true]);

        } elseif ($rol === 'cliente') {
            $mensaje2 .= 'cliente';
            return view('cliente', ['mensaje' => $mensaje2, 'cliente' => $cliente]);

        } else {

            return view('cliente', ['isAdmin' => false]);
        }
    }
}