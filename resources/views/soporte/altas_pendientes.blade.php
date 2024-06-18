@extends('layouts.app')

@section('content')
@include('partials.menu_soporte')

<div class="container text-center">
    <h5
        style="color: #004d99; font-weight: bold; background-color: #1e3a5e; color: white; padding: 3px 5px; border-radius: 8px;">
        Altas Pendientes</h5>




    @if ($altas_pendientes->isEmpty())
    <p>No hay altas pendientes en este momento.</p>
    @else
    <ul style="list-style: none; text-align: left; margin: 0 auto;">
        @foreach ($altas_pendientes as $cliente)
        <li>
            <a href="{{ route('cliente_detalle', ['id' => $cliente->id]) }}"
                style="text-decoration: none; color: black;">
                <span style="color: #004d99; font-weight: bold;">Cliente:</span> <span
                    style="font-weight:bold; color:black;">{{ $cliente->nombre }} {{ $cliente->apellidos }}</span> |
                <span style="color: #004d99; font-weight: bold;">Email:</span> <span
                    style="color:black;">{{ $cliente->email }}</span> |
                <span style="color: #004d99; font-weight: bold;">Teléfono:</span> <span
                    style="color:black;">{{ $cliente->telefono }}</span> |
                <span style="color: #004d99; font-weight: bold;">Dirección:</span> <span
                    style="color:black;">{{ $cliente->direccion }}</span> |
                <span style="color: #004d99; font-weight: bold;">Localidad:</span> <span
                    style="color:black;">{{ $cliente->localidad }}</span> |
                <span style="color: #004d99; font-weight: bold;">Disponibilidad:</span> <span
                    style="color:black;">{{ $cliente->disponibilidad }}</span>
            </a>
        </li>
        @endforeach
    </ul>
    @endif
</div>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const addButton = document.querySelector(".btn-toggle[data-target='altas_pendientes'] .fa-stopwatch");
    addButton.style.color = '#B92A0C'
});
</script>
@endsection