@extends('layouts.app')

@section('content')
@include('partials.menu_soporte')
@include('soporte.modals.modalEditarIncidencia')

<div class="container-fluid d-flex justify-content-center align-items-center">
    <div class="container">
        <h1 class="text-center">Incidencias Abiertas</h1>
        @if($incidenciasAbiertas->isEmpty())
        <p class="text-center">No hay incidencias abiertas.</p>
        @else
        <table class="table table-bordered text-left">
            <thead class="thead-dark">
                <tr>
                    <th>Fecha</th>
                    <th>Cliente</th>
                    <th>Descripción</th>
                    <th>Técnico</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                @foreach($incidenciasAbiertas as $index => $incidencia)
                <tr class="{{ $index % 2 == 0 ? 'green-row' : 'red-row' }}">
                    <td class="text-red2">{{ $incidencia->created_at->format('d/m/Y') }}</td>
                    <td>{{ $incidencia->cliente->nombre }} {{ $incidencia->cliente->apellidos }}</td>

                    <td>{{ $incidencia->descripcion }}</td>
                    <td>{{ $incidencia->tecnico->name }}</td>
                    <td><button class="btn btn-success"
                            onclick="abrirModalEditarIncidencia({{ $incidencia->id }}, '{{ $incidencia->created_at->format('Y-m-d') }}', '{{ $incidencia->descripcion }}')">Visualizar</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
</div>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const addButton = document.querySelector(
        ".btn-toggle[data-target='incidencias_abiertas'] .fa-triangle-exclamation");
    addButton.style.color = '#B92A0C'
});
</script>
@endsection