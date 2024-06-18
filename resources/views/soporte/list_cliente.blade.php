@extends('layouts.app')

@section('content')
@include('partials.menu_soporte')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="background-color: #1e3a5e; color: white; border-radius: 8px 8px 0 0;">
                    {{ __('Lista de Clientes') }}
                </div>



                <div class="card-body" style="background-color: #f8f9fa; border-radius: 0 0 4px 4px;">

                    <form action="{{ route('buscar_cliente') }}" method="POST">
                        @csrf
                        <div class="row align-items-center">
                            <div class="col-5">
                                <label for="dni">Buscar por DNI:</label>

                                <input type="text" name="dni" class="form-control" style="width: 150px;"
                                    placeholder="Introduce el DNI">
                            </div>
                            <div class="col-7">
                                <label for="apellidos">Buscar por Apellidos:</label>
                                <input type="text" name="apellidos" class="form-control"
                                    placeholder="Introduce uno o más apellidos">
                            </div>

                            <div class="col-12 mt-2">
                                <button type="submit" class="btn btn-primary form-control">Buscar</button>
                            </div>
                        </div>
                    </form>
                    <hr>

                    @if($resultados->isEmpty())
                    <p>No se encontraron clientes.</p>
                    @else
                    <ul style="list-style-type: none; padding-left: 0;">
                        @foreach($resultados as $cliente)
                        <li style="border-bottom: 1px solid #ccc; padding: 10px 0;">
                            <a href="{{ route('cliente_detalle', ['id' => $cliente->id]) }}"
                                style="text-decoration: none; color: #1e3a5e; font-weight: bold;">
                                <span onmouseover="this.style.color='#004d99'" onmouseout="this.style.color='#1e3a5e'">
                                    {{ $cliente->nombre }} {{ $cliente->apellidos }}
                                </span>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                    @endif
                </div>


            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const addButton = document.querySelector(".btn-toggle[data-target='buscar_cliente'] .fa-magnifying-glass");
    addButton.style.color = '#B92A0C'
});
</script>
@endsection