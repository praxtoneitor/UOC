@extends('layouts.app')

@section('content')
@include('partials.menu_mantenimiento')
<div style="background-color: #f2f2f2; padding: 20px;">
    <h1 style="text-align: center; color: #333; font-family: 'Arial Black', sans-serif; font-size: 24px;">Reportar
        Avería</h1>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <!-- Formulario para reportar la avería -->
                    <form id="averiaForm" method="POST" action="{{ route('guardar_averia') }}">
                        @csrf

                        <div class="form-group">
                            <label for="nodo_id">Selecciona un nodo:</label>
                            <select id="nodo_id" name="nodo_id" class="form-control">
                                <option value="">Selecciona un nodo</option>
                                @foreach($nodos as $nodo)
                                <option value="{{ $nodo->id }}">{{ $nodo->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Campo para la descripción del problema -->
                        <div class="form-group">
                            <label for="descripcion">Descripción del problema:</label>
                            <textarea id="descripcion" name="descripcion" class="form-control"></textarea>
                        </div>

                        <!-- Campo para la descripción del problema -->
                        <div class="form-group">
                            <label for="solucion">Solución al problema:</label>
                            <textarea id="solucion" name="solucion" class="form-control"></textarea>
                        </div>

                        <!-- Checkbox para mostrar u ocultar los selects de equipos y materiales -->
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="mostrar_materiales">
                            <label class="form-check-label" for="mostrar_materiales">Mostrar Material del nodo</label>
                        </div>

                        <!-- Selects para mostrar equipos y materiales -->
                        <div id="materiales_select" style="display: none;">
                            <div class="form-group">
                                <label for="equipo_id">Selecciona el equipo del nodo:</label>
                                <select id="equipo_id" name="equipo_id" class="form-control">
                                    <!-- Options se cargarán dinámicamente -->
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="material_id">Selecciona el equipo del almacen:</label>
                                <select id="material_id" name="material_id" class="form-control">
                                    <!-- Options se cargarán dinámicamente -->
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Reportar Avería</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const addButton = document.querySelector(".btn-toggle[data-target='averias'] .fa-circle-exclamation");
    addButton.style.color = '#B92A0C'
});
</script>

<script>
$(document).ready(function() {
    // Escuchar el cambio del checkbox
    $('#mostrar_materiales').on('change', function() {
        // Verificar si el checkbox está marcado
        if ($(this).is(':checked')) {
            // Obtener el ID del nodo seleccionado
            var nodoId = $('#nodo_id').val();
            // Si hay un nodo seleccionado, cargar y mostrar los materiales
            if (nodoId) {
                cargarMateriales(nodoId);
            } else {
                // Si no se selecciona ningún nodo, ocultar los selects de materiales
                $('#materiales_select').hide();
            }
            $('#materiales_select').show();
        } else {
            // Si el checkbox no está marcado, ocultar los selects de materiales
            $('#materiales_select').hide();
        }
    });
    // Función para cargar y mostrar los materiales del nodo seleccionado
    function cargarMateriales(nodoId) {
        // Hacer una solicitud AJAX al servidor para obtener los materiales del nodo
        $.ajax({
            url: '/obtener_equipos/' + nodoId,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                // Limpiar y llenar el select de equipos
                $('#equipo_id').empty().append(
                    '<option value="">Selecciona el equipo del nodo</option>');
                $.each(data.materialUsado, function(key, value) {
                    $('#equipo_id').append('<option value="' + value.id + '">' +
                        value.modelo + ' - ' + value.marca + ' - ' + value.mac +
                        '</option>');
                });

                // Limpiar y llenar el select de materiales
                // No mostrar los materiales que ya están en uso
                $('#material_id').empty().append(
                    '<option value="">Selecciona el material del almacen</option>');
                $.each(data.material, function(key, value) {
                    $.each(data.materialUsado, function(key, value2) {
                        if (value.id != value2.id) {
                            $('#material_id').append('<option value="' + value.id +
                                '">' +
                                value.modelo + ' - ' + value.marca + ' - ' +
                                value.mac +
                                '</option>');
                        }
                    });
                });

                // Mostrar los selects de materiales
                $('#materiales_select').show();
            }
        });
    }

    // Validar campos antes de enviar el formulario
    $('#averiaForm').submit(function(event) {
        // Evitar el envío predeterminado del formulario
        event.preventDefault();

        // Obtener los valores de los campos de descripción y solución
        var descripcion = $('#descripcion').val().trim();
        var solucion = $('#solucion').val().trim();

        // Verificar si los campos están vacíos
        if (descripcion === "" || solucion === "") {
            // Mostrar mensaje de error
            Swal.fire({
                title: 'Error',
                text: 'Los campos "Descripción del problema" y "Solución al problema" son obligatorios.',
                icon: 'error'
            });
        } else {
            // Mostrar la ventana de confirmación
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¿Deseas guardar esta avería?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, insertar avería'
            }).then((result) => {
                // Si el usuario confirma, enviar el formulario
                if (result.isConfirmed) {
                    // Envío del formulario mediante AJAX
                    $.ajax({
                        url: $('#averiaForm').attr('action'),
                        type: 'POST',
                        data: $('#averiaForm').serialize(),
                        dataType: 'json', // Esperamos una respuesta JSON del servidor
                        success: function(response) {
                            // Mostrar mensaje de éxito con SweetAlert
                            Swal.fire({
                                title: 'Éxito',
                                text: response.message,
                                icon: 'success'
                            }).then((result) => {
                                // Redireccionar a la página de averías
                                window.location.href =
                                    "{{ route('averias') }}";
                            });
                        },
                        error: function(xhr, status, error) {
                            // Manejar errores si es necesario
                        }
                    });
                }
            });
        }
    });
});
</script>

@endsection