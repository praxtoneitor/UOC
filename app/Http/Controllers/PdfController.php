<?php

// app/Http/Controllers/PdfController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Estado;
use App\Models\Factura;
use PDF;
use Storage;

class PdfController extends Controller
{

    public function showSelectStatusForm()
    {
        $estados = Estado::all(); // Obtener todos los estados

        return view('admin.select_status', compact('estados'));
    }

    public function showPdfGenerateForm()
    {
        $estados = Estado::all(); // Obtener todos los estados

        return view('admin.pdf_generate', compact('estados'));
    }

    public function generateAllPdfs(Request $request)
    {
        // Validar la entrada del formulario
        $request->validate([
            'estado_id' => 'required|integer|exists:estados,id'
        ]);

        // Obtener el estado seleccionado
        $estadoId = $request->input('estado_id');

        // Obtener los clientes con el estado seleccionado
        $clientes = Client::with('servicio')->where('estado_id', $estadoId)->get();

        // Obtener el nombre del mes actual
        $nombreMes = date('F');

        // Iterar sobre cada cliente y generar un PDF
        foreach ($clientes as $cliente) {
            // Asegurarnos de que cada cliente tiene un servicio asociado y obtener el precio
            if ($cliente->servicio) {
                $precioServicio = $cliente->servicio->precio;
                $descripcionServicio = $cliente->servicio->nombre;
            } else {
                // Si el cliente no tiene un servicio asociado, usamos 0 como precio por defecto
                $precioServicio = 0;
                $descripcionServicio = 'Sin servicio';
                \Log::info("Cliente sin servicio: {$cliente->nombre} {$cliente->apellidos}");
                continue; // Omitir la generación de PDF para este cliente
            }

            $data = [
                'nombre' => $cliente->nombre,
                'apellidos' => $cliente->apellidos,
                'direccion' => $cliente->direccion,
                'email' => $cliente->email,
                'precio' => $precioServicio,
                'descripcion_servicio' => $descripcionServicio,
                'total' => $precioServicio
            ];

            // Generar el contenido del PDF usando una vista
            $pdf = PDF::loadView('admin.pdf_template', $data);

            // Crear el nombre del archivo con el nombre del mes y el nombre del cliente
            $fileName = date('Y-m-d') . '_' . $cliente->nombre . '_' . $cliente->apellidos . '.pdf';


            // Guardar en public/facturas
            if (!is_dir(public_path('facturas'))) {
                mkdir(public_path('facturas'));
            }
            $pdf->save(public_path('facturas/' . $fileName));

            Factura::create([
                'cliente_id' => $cliente->id,
                'nombre_factura' => $fileName,
            ]);
        }


        return redirect()->route('pdf.success');
    }

    public function showSuccessMessage()
    {
        return view('admin.pdf_success');
    }

}