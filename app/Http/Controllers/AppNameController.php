<?php



namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppNameController extends Controller
{
    public function showForm()
    {
        return view('admin.form_empresa');
    }

    public function store(Request $request)
    {
        $request->validate([
            'app_name' => 'required|string|max:255',
        ]);

        $filePath = public_path('appName.txt');
        file_put_contents($filePath, $request->app_name);

        return redirect()->route('admin.form_empresa')->with('success', 'El nombre de la aplicación se ha guardado correctamente.');
    }
}