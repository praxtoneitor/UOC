<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\UsuarioCreado;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if ($request->user() && $request->user()->rol !== 'administrador') {
                abort(403, 'No estás autorizado para entrar a esta página');
            }

            return $next($request);
        });
    }

    public function users ()
    {
        $users = User::where('rol', '!=', 'cliente')->get();
        return view('admin.users', ['users' => $users]);
    }

    public function getUser ()
    {
        $user = User::find(request()->id);
        return response()->json($user);
    }

    public function storeUser ()
    {
        if (request()->name == null || request()->email == null || request()->password == null) {
            return ['error' => 'Todos los campos son requeridos'];
        }

        $user = new User();
        $user->name = request()->name;
        $user->email = request()->email;
        $user->rol = request()->rol;
        $user->password = Hash::make(request()->password);
        $user->save();
 
        // Enviar correo al usuario
        Mail::to($user->email)->send(new UsuarioCreado($user, request()->password));

        return response()->json($user);
    }

    public function updateUser ()
    {
        $user = User::find(request()->id);
        
        $user->name = request()->name;
        $user->email = request()->email;
        $user->rol = request()->rol;

        $password = request()->password;

        if ($password) {
            $user->password = Hash::make($password);
        }

        $user->save();

        return response()->json($user);
    }

    public function deleteUser ()
    {
        $user = User::find(request()->id);
        $user->delete();
        return response()->json($user);
    }
}