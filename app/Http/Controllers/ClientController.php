<?php

namespace App\Http\Controllers;

use App\Mail\ClienteCreado;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Estado;
use App\Models\Servicio;
use App\Models\Alta;
use App\Models\Factura;
use App\Models\Material;
use App\Models\MaterialCliente;
use App\Models\User;
use App\Models\Incidencia;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;




class ClientController extends Controller
{

    public function create()
    {
        $default_estado_nombre = $this->getDefaultEstadoId();
        $servicios = Servicio::all();
        return view('soporte.add_client', compact('default_estado_nombre', 'servicios'));
    }


    protected function getDefaultEstadoId()
    {
        // Utiliza el modelo Estado para obtener el ID del estado predeterminado
        $default_estado = Estado::where('default', 'si')->firstOrFail();
        return $default_estado->nombre;
    }


    public function buscar(Request $request)
    {
        $resultados = Client::dni($request->input('dni'))->apellidos($request->input('apellidos'))->get();
        return view('soporte.list_cliente', ['resultados' => $resultados]);

        if ($request->isMethod('post')) {
            // Procesar la búsqueda si la solicitud es POST

            // Obtener los datos de entrada del formulario
            $dni = $request->input('dni');
            $apellidos = $request->input('apellidos');

            // Inicializar una colección vacía para los resultados
            $resultados = collect();

            // Verificar si se proporcionó un DNI en la solicitud
            if ($dni) {
                $clientesByDNI = Client::where('dni', $dni)->get();
                $resultados = $clientesByDNI->isEmpty() ? $resultados : $resultados->merge($clientesByDNI);
            }

            // Verificar si se proporcionaron apellidos en la solicitud
            if ($apellidos) {
                $clientesByApellidos = Client::where('apellidos', 'LIKE', "%$apellidos%")->get();
                $resultados = $clientesByApellidos->isEmpty() ? $resultados : $resultados->merge($clientesByApellidos);
            }

            // Devolver la vista con los resultados de la búsqueda
            return view('soporte.list_cliente', ['resultados' => $resultados->unique()]);
        } else {
            // Mostrar el formulario si la solicitud es GET
            return view('soporte.buscar_cliente');
        }
    }


    public function store(Request $request)
    {

        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'telefono' => 'required|numeric|digits_between:1,20',
            'movil' => 'nullable|string|max:20',
            'dni' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'direccion' => 'nullable|string|max:255',
            'ciudad' => 'nullable|string|max:255',
            'codigo_postal' => 'nullable|string|max:10',
            'provincia' => 'nullable|string|max:255',
            'disponibilidad' => 'nullable|string|max:255',
        ]);

        // Verificar que no exista un cliente con el mismo DNI
        $dni = $request->input('dni');
        $clienteExistente = Client::where('dni', $dni)->first();
        if ($clienteExistente) {
            return redirect()->route('add_client')->with('error', 'Ya existe un cliente con el DNI proporcionado');
        }

   

       
      
        //$default_estado = Estado::where('default', 'si')->firstOrFail();
        $client = new Client([
            'nombre' => $request->input('nombre'),
            'apellidos' => $request->input('apellidos'),
            'telefono' => $request->input('telefono'),
            'movil' => $request->input('movil'),
            'dni' => $request->input('dni'),
            'email' => $request->input('email'),
            'direccion' => $request->input('direccion'),
            'ciudad' => $request->input('ciudad'),
            'codigo_postal' => $request->input('codigo_postal'),
            'provincia' => $request->input('provincia'),
            'disponibilidad' => $request->input('disponibilidad'),
        ]);
        $client->save();


        // Generar contraseña aleatoria 9 caracteres
        $password = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 9);

        $user = new User([
            'name' => $request->input('nombre'),
            'email' => $request->input('email'),
            'dni' => $request->input('dni'),
            'rol' => 'cliente',
            'password' => Hash::make($password),
        ]);

        // Enviar correo al cliente
        $user->save();
       Mail::to($request->input('email'))->send(new ClienteCreado($user, $password));


        // Obtener el servicio por su nombre
        $servicioNombre = $request->input('servicio');
        $servicio = Servicio::where('nombre', $servicioNombre)->firstOrFail();

        // Asignar el servicio al cliente
        $client->servicio_id = $servicio->id;

        // Obtener el estado por su nombre
        $estadoNombre = $request->input('estado');
        $estado = Estado::where('nombre', $estadoNombre)->firstOrFail();

        // Asignar el estado al cliente
        $client->estado_id = $estado->id;



        // Guardar el cliente en la base de datos
        $client->save();

        // Redirigir a una página de éxito o mostrar un mensaje de éxito
        return redirect()->route('soporte')->with('success', 'Cliente añadido correctamente');
    }


    public function detalle($id)
    {
        // Buscar el cliente por su ID
        $cliente = Client::findOrFail($id);
        $alta = Alta::where('id_cliente', $cliente->id)->first();
        $estado_actual = $cliente->estado;

        // Obtener los materiales asignados al cliente
        $materiales_asignados = MaterialCliente::where('cliente_id', $cliente->id)
            ->join('material', 'material_cliente.material_id', '=', 'material.id')
            ->select('material.*')
            ->get();

        $estados = Estado::where('id', '!=', $estado_actual->id)->get();

        $numIncidenciasAbiertas = Incidencia::where('id_cliente', $cliente->id)
            ->where('estado', 'abierto')
            ->count();

        $numIncidenciasCerradas = Incidencia::where('id_cliente', $cliente->id)
            ->where('estado', 'cerrado')
            ->count();

        $incidencias = Incidencia::where('id_cliente', $cliente->id)
            ->where('estado', 'abierto')->get();



        // Devolver la vista de detalle del cliente con los datos del cliente
        return view('soporte.cliente_detalle', compact('cliente', 'alta', 'estados', 'materiales_asignados', 'numIncidenciasAbiertas', 'numIncidenciasCerradas', 'incidencias'));
    }

    public function darAlta(Request $request)
    {
        // Valida los datos del formulario
        $request->validate([
            'observaciones' => 'required',
            'rssi' => 'required',
            'test' => 'required',
            'nuevo_estado' => 'required',
        ]);
        $cliente_id = $request->input('id_cliente');

        Alta::create([
            'id_cliente' => $cliente_id,
            'observaciones' => $request->observaciones,
            'rssi' => $request->rssi,
            'test' => $request->test,
        ]);

        ////////////////MATERIALES
        // Buscar el material por su MAC
        $mac = $request->input('mac');
        $material = Material::where('mac', $mac)->where('utilizado', 0)->first();

        // Verificar si se encontró el material
        if ($material) {
            // Crear una nueva entrada en la tabla material_cliente
            MaterialCliente::create([
                'material_id' => $material->id,
                'cliente_id' => $cliente_id,
            ]);

            // Actualizo el campo utilizado en la tabla material
            $material->update(['utilizado' => 1]);
            $mac_existe = true;

        } else {
            return back()->with('error', 'La MAC proporcionada no está disponible.');
        }

        // Obtengo el ID del nuevo estado seleccionado desde el formulario
        $nuevo_estado_id = $request->input('nuevo_estado');


        // Asigna directamente el ID del estado al cliente
        $cliente = Client::findOrFail($cliente_id);
        $cliente->estado_id = $nuevo_estado_id;
        $cliente->save();


        return redirect()->route('cliente_detalle', ['id' => $cliente_id])->with('success', '¡El alta se ha guardado correctamente!');
    }



    public function updateObservaciones(Request $request, $id)
    {
        // Buscar el cliente por su ID
        $cliente = Client::findOrFail($id);

        // Verificar si se enviaron datos para actualizar las observaciones
        if ($request->has('observaciones')) {
            // Actualizar las observaciones
            $alta = Alta::where('id_cliente', $id)->first();
            if ($alta) {
                $alta->observaciones = $request->input('observaciones');
                $alta->save();
            }
        }

        // Obtener las observaciones actualizadas del cliente
        $observaciones = $alta ? $alta->observaciones : '';

        // Retornar una respuesta JSON con las observaciones actualizadas
        return response()->json(['observaciones' => $observaciones]);
    }





    public function altasPendientes()
    {
        // Obtener el ID del estado predeterminado
        $estado_predeterminado = Estado::where('default', 'si')->first();

        // Buscar todos los clientes con el estado predeterminado
        $altas_pendientes = Client::where('estado_id', $estado_predeterminado->id)->get();

        // Pasar los clientes encontrados a la vista
        return view('soporte.altas_pendientes', compact('altas_pendientes'));
    }

    ///////////////MODIFICAR CLIENTE//////////
    public function edit($id)
    {
        // Buscar el cliente por su ID
        $cliente = Client::findOrFail($id);

        // Buscar el alta asociada al cliente
        $alta = Alta::where('id_cliente', $cliente->id)->first();


        $materiales_asignados = MaterialCliente::where('cliente_id', $cliente->id)
            ->join('material', 'material_cliente.material_id', '=', 'material.id')
            ->select('material.*')
            ->get();

        // Obtener los estados (excluyendo el estado actual del cliente)
        $estado_actual = $cliente->estado;
        $estados = Estado::where('id', '!=', $estado_actual->id)->get();

        // Pasar los datos del cliente, alta y estados a la vista
        return view('soporte.change_client', compact('cliente', 'alta', 'materiales_asignados', 'estados'));
    }


    public function update(Request $request, $id)
    {
        // Buscar el cliente por su ID
        $cliente = Client::findOrFail($id);

        // Validar los datos del formulario
        $request->validate([
            'telefono' => 'required|string|max:20',
            'movil' => 'nullable|string|max:20',
            'email' => 'required|email|max:255',
            'direccion' => 'nullable|string|max:255',
            'ciudad' => 'nullable|string|max:255',
            'codigo_postal' => 'nullable|string|max:10',
            'provincia' => 'nullable|string|max:255',
        ]);

        $cliente->telefono = $request->input('telefono');
        $cliente->movil = $request->input('movil');
        $cliente->email = $request->input('email');
        $cliente->direccion = $request->input('direccion');
        $cliente->ciudad = $request->input('ciudad');
        $cliente->codigo_postal = $request->input('codigo_postal');
        $cliente->provincia = $request->input('provincia');

        // Guardar los cambios en la base de datos
        $cliente->save();

        // Redirigir a la página de detalle del cliente con un mensaje de éxito
        return redirect()->route('cliente_detalle', ['id' => $id])->with('success', '¡Los cambios se han guardado correctamente!');
    }


    public function updateDisponibilidad(Request $request)
    {

        // Buscar el cliente por su ID
        $cliente = Client::findOrFail(request()->id);

        // Validar los datos del formulario
        $request->validate([
            'disponibilidad' => 'required|string|max:255',
        ]);

        // Actualizar la disponibilidad del cliente
        $cliente->disponibilidad = $request->input('disponibilidad');

        // Guardar los cambios en la base de datos
        $cliente->save();

        // Redirigir a la página de detalle del cliente con un mensaje de éxito
        return redirect()->route('cliente_detalle', ['id' => request()->id])->with('success', '¡La disponibilidad se ha actualizado correctamente!');
    }

    public function storeIncidencia(Request $request)
    {

        // Validar los datos de entrada
        $clienteId = $request->id_cliente;

        $request->validate([

            'via_comunicacion' => 'required',
            'tipo_incidencia' => 'required',
            'descripcion' => 'required',
            'necesita_visita' => 'boolean',
            'fecha_visita' => 'nullable|date',
            'estado' => 'required',
        ]);

        $descripcion = $request->descripcion;
        $id_tecnico = auth()->user()->id;
        if (auth()->user()->rol === 'soporte') {
            $id_tecnico = auth()->user()->id;

        }else{
            // Buscar primer usuario con rol soporte
            $tecnico = User::where('rol', 'soporte')->first();
            $id_tecnico = $tecnico->id;
            $descripcion = 'Incidencia creada por el cliente: ' . $descripcion;
        }

        $fecha_visita = $request->fechaHoraVisita;
        if ($fecha_visita) {
            $fecha_visita = substr($fecha_visita, 0, 10);
        }

        Incidencia::create([
            'id_cliente' => $clienteId,
            'id_tecnico' => $id_tecnico,

            'via_comunicacion' => $request->via_comunicacion,
            'tipo_incidencia' => $request->tipo_incidencia,
            'necesita_visita' => $request->has('necesita_visita') ? true : false,
            'fecha_visita' => $request->fechaHoraVisita,
            'descripcion' => $descripcion,
            'solucion' => $request->solucion,
            'estado' => $request->estado,
        ]);


        $controladorIncidencias = new IncidenciaController();
        $cliente = Client::find($clienteId);
        $controladorIncidencias->enviarCorreo($cliente, 'nueva');

        return response()->json(['message' => '¡Guardado correctamente!', 'reload' => true]);

    }

    public function mostrarDetallesIncidencias($id)
    {
        // Obtener el cliente
        $cliente = Client::findOrFail($id);

        // Obtener el número de incidencias abiertas y cerradas asociadas al cliente
        $numIncidenciasAbiertas = Incidencia::where('id_cliente', $cliente->id)
            ->where('estado', 'abierto')
            ->count();

        $numIncidenciasCerradas = Incidencia::where('id_cliente', $cliente->id)
            ->where('estado', 'cerrada')
            ->count();

        // Pasar el cliente y los números de incidencias a la vista
        return view('soporte.cliente_detalle', [
            'cliente' => $cliente,
            'numIncidenciasAbiertas' => $numIncidenciasAbiertas,
            'numIncidenciasCerradas' => $numIncidenciasCerradas,
        ]);
    }

    public function actualizar(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:altas,id',
            'observaciones' => 'required|string',
        ]);

        $alta = Alta::find($request->id);
        $alta->observaciones = $request->observaciones;
        $alta->save();

        // Devolver una respuesta de éxito
        return response()->json(['message' => 'Observaciones actualizadas correctamente']);
    }

    public function facturas()
    {
        return $this->hasMany(Factura::class);
    }


}