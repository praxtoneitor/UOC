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
                <div class="card-header">{{ __('Lista de Servicios') }}</div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Nombre del Servicio</th>

                                </tr>
                            </thead>
                            <tbody>
                                @forelse($servicios as $item)
                                <tr>
                                    <td>{{ $item->nombre }}</td>
                                    <td>
                                        <!-- Botón de borrado -->
                                        <form method="POST" action="{{ route('borrar', ['id' => $item->id]) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('¿Estás seguro de que quieres borrar este elemento?')">Borrar</button>
                                            <input type="hidden" name="id" value="{{ $item->id }}">
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="2">No hay servicios disponibles</td>
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
document.addEventListener("DOMContentLoaded", function() {
    const addButton = document.querySelector(".btn-toggle[data-target='ver_servicios'] .fa-folder-tree");
    addButton.style.color = '#B92A0C';
});
</script>
@endsection