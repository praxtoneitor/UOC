@extends('layouts.app')

@section('content')
@include('partials.menu_soporte')

<div class="container">
    <div class="row justify-content-center mb-4">
        <div class="col-md-12 text-center">

        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="border p-3 mt-3 mt-md-0">
                <div
                    style="background-color: #1e3a5e; color: white; padding: 8px; border-radius: 8px; box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);">
                    <h5 style="margin: 0; font-size: 18px; margin-bottom: 1px; padding-bottom: 1px;">Modificar Cliente
                    </h5>
                </div>
                <form method="POST" action="{{ route('update_client', ['id' => $cliente->id]) }}">
                    @csrf
                    @method('PUT')
                    <br>
                    <strong>Nombre:</strong> {{ $cliente->nombre }}</p>

                    <strong>Apellidos:</strong> {{ $cliente->apellidos }}</p>

                    <div class="form-group">
                        <label for="telefono">Teléfono</label>
                        <input id="telefono" type="text" class="form-control" name="telefono"
                            value="{{ $cliente->telefono }}" required>
                    </div>

                    <div class="form-group">
                        <label for="movil">Móvil</label>
                        <input id="movil" type="text" class="form-control" name="movil" value="{{ $cliente->movil }}">
                    </div>

                    <strong>DNI:</strong> {{ $cliente->dni }}</p>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input id="email" type="email" class="form-control" name="email" value="{{ $cliente->email }}"
                            required>
                    </div>

                    <div class="form-group">
                        <label for="direccion">Dirección</label>
                        <input id="direccion" type="text" class="form-control" name="direccion"
                            value="{{ $cliente->direccion }}">
                    </div>

                    <div class="form-group">
                        <label for="ciudad">Ciudad</label>
                        <input id="ciudad" type="text" class="form-control" name="ciudad"
                            value="{{ $cliente->ciudad }}">
                    </div>

                    <div class="form-group">
                        <label for="codigo_postal">Código Postal</label>
                        <input id="codigo_postal" type="text" class="form-control" name="codigo_postal"
                            value="{{ $cliente->codigo_postal }}">
                    </div>

                    <div class="form-group">
                        <label for="provincia">Provincia</label>
                        <input id="provincia" type="text" class="form-control" name="provincia"
                            value="{{ $cliente->provincia }}">
                    </div>

                    <div class="form-group">
                        <label for="servicio">Servicio Asignado</label>
                        <input id="servicio" type="text" class="form-control" name="servicio"
                            value="{{ $cliente->servicio->nombre }}" readonly>
                    </div>

                    <div class="form-group">
                        <label for="estado">Estado</label>
                        <input id="estado" type="text" class="form-control" name="estado"
                            value="{{ $cliente->estado->nombre }}" readonly>
                    </div>


                    <button type="submit" class="btn btn-primary">Actualizar Cliente</button>
                </form>
            </div>
        </div>


    </div>
    <script>
    function mostrarFormulario(id) {
        var formulario = document.getElementById(id);
        formulario.style.display = 'block';
    }
    </script>
    @endsection