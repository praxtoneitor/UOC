@extends('layouts.app')

@section('content')
@include('partials.menu_mantenimiento')
<div style="background-color: #f2f2f2; padding: 20px;">
    <h1 style="text-align: center; color: #333; font-family: 'Arial Black', sans-serif; font-size: 24px;">Listado de
        equipamiento</h1>
</div>
<div class="container">

    <div class="filters">
        <form id="filter-form">
            

            
        </form>

        <form action="{{ route('mostrar_material') }}" method="POST">
            @csrf
            <div class="row align-items-center">
                <div class="col-5">
                    <label for="marca">Marcas:</label>

                    <select name="marca">
                        <option value="">Todas las Marcas</option>
                        @foreach($marcas as $marca)
                            <option value="{{ $marca }}" {{ old('marca') == $marca ? 'selected': '' }}>{{ $marca }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-7">
                    <label for="modelo">Modelos:</label>

                    <select name="modelo">
                        <option value="">Todos los Modelos</option>
                        @foreach($modelos as $modelo)
                            <option value="{{ $modelo }}" {{ old('modelo') == $modelo ? 'selected': '' }}>{{ $modelo }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12 mt-2">
                    <button type="submit" class="btn btn-primary form-control">Buscar</button>
                </div>
            </div>
        </form>
    </div>

    <table class="table table-striped" id="materiales-table">
        <!-- Encabezados de la tabla -->
        <thead>
            <tr>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Número de Serie</th>
                <th>MAC</th>
                <th>Utilizado</th>
            </tr>
        </thead>
        <tbody>
            <!-- Filas de la tabla -->
            @foreach($materiales as $material)
            <tr>
                <td>{{ $material->marca }}</td>
                <td>{{ $material->modelo }}</td>
                <td>{{ $material->num_serie }}</td>
                <td>{{ $material->mac }}</td>
                <td>{{ $material->utilizado ? 'Sí' : 'No' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection



@section('scripts')
<script>
$(document).ready(function() {
    console.log('Script de JavaScript cargado correctamente');

    // Captura los cambios en los filtros y realiza la solicitud AJAX
    $('#marca-filter, #modelo-filter').on('change', function() {
        console.log('Cambio detectado en el selector');

        // Recolecta los valores de los filtros
        var marca = $('#marca-filter').val();
        var modelo = $('#modelo-filter').val();

        // Envía la solicitud AJAX
        $.ajax({
            url: '{{ route("filtrar-materiales") }}',
            type: 'GET',
            data: {
                marca: marca,
                modelo: modelo
            },
            success: function(response) {
                // Actualiza la tabla con los datos filtrados
                $('#materiales-table tbody').html(response);
            },
            error: function(xhr, status, error) {
                console.log('Error en la solicitud AJAX:', error);
            }
        });
    });
});
</script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const addButton = document.querySelector(".btn-toggle[data-target='mostrar_material'] .fa-store");
    addButton.style.color = '#B92A0C'
});
</script>
@endsection