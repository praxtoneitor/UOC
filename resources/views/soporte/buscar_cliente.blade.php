@extends('layouts.app')

@section('content')
@include('partials.menu_soporte')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Buscar Cliente</div>
                <div class=" card-body">
                    @if (!isset($resultados))

                    <form action="{{ route('buscar_cliente') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="dni">Buscar por DNI:</label>

                            <input type="text" name="dni" class="form-control form-control-sm" style="width: 150px;"
                                placeholder="Introduce el DNI">

                        </div>
                        <div class="form-group">
                            <label for="apellidos">Buscar por Apellidos:</label>
                            <input type="text" name="apellidos" class="form-control"
                                placeholder="Introduce uno o más apellidos">
                        </div>
                        <button type="submit" class="btn btn-primary">Buscar</button>
                    </form>

                    @else
                    <!-- Mostrar los resultados de la búsqueda -->
                    @if ($resultados->isEmpty())
                    <p>No se encontraron resultados.</p>
                    @else
                    <ul>
                        @foreach ($resultados as $cliente)
                        <li>{{ $cliente->nombre }} {{ $cliente->apellidos }}</li>
                        <!-- Mostrar otros datos del cliente si es necesario -->
                        @endforeach
                    </ul>
                    @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection