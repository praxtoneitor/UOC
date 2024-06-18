<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Client;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Editar el perfil del usuario.
     */
    public function edit(Request $request): View
    {
        $user = User::find(auth()->id());
        $cliente = Client::with('user')->whereHas('user', function ($query) {
            $query->where('id', Auth::id());
        })->first();

        return view('profile', [
            'user' => $user,
            'cliente' => $cliente
        ]);
    }

    /**
     *Actualizar el perfil del usuario.
     */
    public function update(Request $request)
    {
        if (request()->current_password == null || request()->password == null || request()->password_confirmation == null){
            return response()->json(['status' => 'error', 'message' => 'Por favor, rellena todos los campos.']);
        }

        if (request()->password != request()->password_confirmation){
            return response()->json(['status' => 'error', 'message' => 'Las contraseñas no coinciden.']);
        }

        $user = User::find(auth()->id());
        // Compobamos si la contraseña actual es correcta
        if (!Hash::check(request()->current_password, $user->password)){
            return response()->json(['status' => 'error', 'message' => 'La contraseña actual no es correcta.']);
        }


        $user->password = Hash::make(request()->password);
        $user->save();

        return response()->json(['status' => 'success', 'message' => 'Contraseña actualizada correctamente.']);
    }
}