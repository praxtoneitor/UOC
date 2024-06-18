@extends('layouts.app')

@section('content')
@include('partials.menu_soporte')
<div class="container">
    <div class="row justify-content-center">
        <!-- Margen superior negativo -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Añadir Cliente') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('store_client') }}">
                        @csrf

                        <div class="form-group">
                            <label for="nombre">{{ __('Nombre') }}</label>
                            <input id="nombre" type="text" class="form-control" name="nombre" required autofocus>
                        </div>

                        <div class="form-group">
                            <label for="apellidos">{{ __('Apellidos') }}</label>
                            <input id="apellidos" type="text" class="form-control" name="apellidos" required>
                        </div>

                        <div class="form-group">
                            <label for="telefono">{{ __('Teléfono') }}</label>
                            <input id="telefono" type="text" class="form-control" name="telefono" pattern="[0-9]+" title="Este campo contiene caracteres no validos, limitese a introducir el numero" required>
                        </div>

                        <div class="form-group">
                            <label for="movil">{{ __('Móvil') }}</label>
                            <input id="movil" type="text" class="form-control" pattern="[0-9]+" name="movil" title="Este campo contiene caracteres no validos, limitese a introducir el numero">
                        </div>

                        <div class="form-group">
                            <label for="dni">{{ __('DNI') }}</label>
                            <input id="dni" type="text" class="form-control" name="dni" pattern="[0-9]{8}[A-Z]" title="Asegurese de que sea correcto, 8 numeros seguidos de una letra mayuscula" required>
                        </div>

                        <div class="form-group">
                            <label for="email">{{ __('Email') }}</label>
                            <input id="email" type="email" class="form-control" name="email" required>
                        </div>

                        <div class="form-group">
                            <label for="direccion">{{ __('Dirección') }}</label>
                            <input id="direccion" type="text" class="form-control" name="direccion">
                        </div>

                        <div class="form-group">
                            <label for="ciudad">{{ __('Ciudad') }}</label>
                            <input id="ciudad" type="text" class="form-control" name="ciudad">
                        </div>

                        <div class="form-group">
                            <label for="codigo_postal">{{ __('Código Postal') }}</label>
                            <input id="codigo_postal" type="text" class="form-control" name="codigo_postal" pattern="[0-9]+" title="Este campo contiene caracteres no validos, limitese a introducir el numero">
                        </div>

                        <div class="form-group">
                            <label for="estado">{{ __('Estado') }}</label>
                            <input id="estado" type="text" class="form-control" name="estado">
                        </div>

                        <button type="submit" class="btn btn-primary">
                            {{ __('Add Client') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
