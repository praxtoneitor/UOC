@extends('layouts.app')

@section('content')
@include('partials.menu_admin')
@php
$isAdmin = true;
@endphp
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Lista de Estados') }}</div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Nombre del Estado</th>
                                    <th>Acciones</th> <!-- Agregado -->
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($estado as $item)
                                <tr>
                                    <td style="background-color: transparent; color: {{ $item->font_color }}">
                                        <span
                                            style="background-color: {{ $item->bg_color }}; padding: 2px;">{{ $item->nombre }}</span>
                                        <!-- Mostrar "default" si el estado es "si" -->
                                        @if($item->default == 'si')
                                        <span style="margin-left: 5px; color: green;">default</span>
                                        @endif

                                    </td>
                                    <td>
                                        <!-- Botón de borrado -->
                                        <form method="POST" action="{{ route('borrar_estado', ['id' => $item->id]) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Borrar</button>
                                        </form>
                                    </td>
                                    <td>
                                        <!-- Botón de establecer como predeterminado -->
                                        <form method="POST" action="{{ route('default_estado', ['id' => $item->id]) }}">
                                            @csrf
                                            <input type="hidden" name="estado_id" value="{{ $item->id }}">
                                            <button type="submit" class="btn btn-sm btn-primary">Predet.</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3">No hay estados disponibles</td> <!-- Ajustado colspan -->
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
// Verificar si hay un mensaje en la sesión
var message = "{{ Session::get('message') }}";

// Si hay un mensaje, mostrar la ventana emergente
if (message) {
    alert(message);
}
</script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const addButton = document.querySelector(".btn-toggle[data-target='ver_estados'] .fa-money-bill-transfer");
    addButton.style.color = '#B92A0C'
});
</script>
@endsection