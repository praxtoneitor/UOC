@extends('layouts.app')

@section('content')
@include('partials.menu_mantenimiento', ['fullWidth' => true])
<div style="background-color: #f2f2f2; padding: 20px;">
    <h1 style="text-align: center; color: #333; font-family: 'Arial Black', sans-serif; font-size: 24px;">Lista de
        Averías</h1>
</div>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card" style="width: 100%;">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th style="width: 15%;">Nodo</th>
                                    <th style="width: 20%;">Descripción</th>
                                    <th style="width: 20%;">Solución</th>
                                    <th style="width: 20%;">Equipo Sustituido</th>
                                    <th style="width: 20%;">Equipo Nuevo</th>
                                    <th style="width: 15%;">Fecha de Creación</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($averias as $averia)
                                <tr>
                                    <td><strong>{{ $averia->nodo->nombre }}</strong></td>
                                    <td>{{ $averia->descripcion }}</td>
                                    <td>{{ $averia->solucion }}</td>
                                    <td>
                                        @if ($averia->equipoSustituido)
                                        <span style="color: red;">
                                            {{ $averia->equipoSustituido->marca ?? 'N/A' }} -
                                            {{ $averia->equipoSustituido->modelo ?? 'N/A' }} -
                                            {{ $averia->equipoSustituido->mac ?? 'N/A' }}
                                        </span>
                                        @else
                                        N/A
                                        @endif
                                    </td>
                                    <td>
                                        @if ($averia->equipoNuevo)
                                        {{ $averia->equipoNuevo->marca ?? 'N/A' }} -
                                        {{ $averia->equipoNuevo->modelo ?? 'N/A' }} -
                                        {{ $averia->equipoNuevo->mac ?? 'N/A' }}
                                        @else
                                        N/A
                                        @endif
                                    </td>
                                    <td>{{ $averia->created_at->format('d/m/Y') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script>
document.addEventListener("DOMContentLoaded", function() {
    const addButton = document.querySelector(".btn-toggle[data-target='cons_averias'] .fa-list");
    addButton.style.color = '#B92A0C';
});
</script>