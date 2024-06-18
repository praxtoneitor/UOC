@extends('layouts.app')

@section('content')
@include('partials.menu_soporte')
@include('soporte.modals.modalEditarIncidencia')
@include('soporte.modals.modalAñadirIncidencia')

<div class="container">
    <div class="row justify-content-center mb-4">
        <div class="col-md-12 text-center">

        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="border p-3 mt-3 mt-md-0">
                <div
                    style="background-color: #1e3a5e; color: white; padding: 8px; border-radius: 8px; box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2); position: relative;">
                    <h5 style="margin: 0; font-size: 18px; margin-bottom: 1px; padding-bottom: 5px;">Datos
                        Personales</span>

                        <a href="{{ route('change_client', ['id' => $cliente->id]) }}"
                            style="position: absolute; top: 50%; transform: translateY(-50%); right: 10px;">
                            <i class="fa-regular fa-pen-to-square" style="color: white;"></i>
                        </a>

                    </h5>
                </div>
                <br>
                <p><strong>id:</strong> {{ $cliente->id }}</p>
                <p><strong>Nombre:</strong> {{ $cliente->nombre }}</p>
                <p><strong>Apellidos:</strong> {{ $cliente->apellidos }}</p>
                <p><strong>Teléfono:</strong> {{ $cliente->telefono }}</p>
                <p><strong>Móvil:</strong> {{ $cliente->movil }}</p>
                <p><strong>DNI:</strong> {{ $cliente->dni }}</p>
                <p><strong>Email:</strong> {{ $cliente->email }}</p>
                <p><strong>Dirección:</strong> {{ $cliente->direccion }}</p>
                <p><strong>Ciudad:</strong> {{ $cliente->ciudad }}</p>
                <p><strong>Código Postal:</strong> {{ $cliente->codigo_postal }}</p>
                <p><strong>Provincia:</strong> {{ $cliente->provincia }}</p>
                <p><strong>Servicio Asignado:</strong> {{ $cliente->servicio->nombre }}</p>
                @if ($cliente->estado && $cliente->estado->nombre == 'Solicitado')
                <p>
                    <strong>Estado:</strong>
                    <span
                        style="color: {{ $cliente->estado->font_color }}; background-color: {{ $cliente->estado->bg_color }};">
                        {{ $cliente->estado->nombre }}
                    </span>
                </p>
                @elseif ($cliente->estado)
                <p>
                    <strong>Estado:</strong>
                    <span
                        style="color: {{ $cliente->estado->font_color }}; background-color: {{ $cliente->estado->bg_color }};">
                        {{ $cliente->estado->nombre }}
                    </span>
                </p>
                @endif
            </div>
        </div>
        <div class="col-md-4">
            <div class="border p-3 mt-3 mt-md-0">
                @if ($alta)
                <div
                    style="background-color: #1e3a5e; color: white; padding: 8px; border-radius: 8px; box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2); position: relative;">
                    <h5 style="margin: 0; font-size: 18px; margin-bottom: 1px; padding-bottom: 5px;">
                        Observaciones del proceso de alta
                        <a href="#" onclick="mostrarModalObservaciones( {{ $alta->id }} )"
                            style="position: absolute; top: 50%; transform: translateY(-50%); right: 10px;">
                            <i class="fa-regular fa-pen-to-square" style="color: #ffffff;"></i>
                        </a>
                    </h5>
                </div>
                <p style="margin-top: 10px;">
                    {{ $alta->observaciones == null ? 'Sin observaciones' : $alta->observaciones }}</p>
                @else
                <br>
                <h5 style="margin-top: 10px;">Pendiente de instalación</h5>
                @endif
                </h5>
            </div>

            <div class="border p-3 mt-3 mt-md-0">
                <div
                    style="background-color: #1e3a5e; color: white; padding: 8px; border-radius: 8px; box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2); position: relative;">
                    <h5 style="margin: 0; font-size: 18px; margin-bottom: 1px; padding-bottom: 5px;">Disponibilidad
                        <!-- <a href="{{ route('change_client', ['id' => $cliente->id]) }}" -->
                        <a href="#" onclick="mostrarModalDisponibilidad({{ $cliente->id }})"
                            style="position: absolute; top: 50%; transform: translateY(-50%); right: 10px;">
                            <i class="fa-regular fa-pen-to-square" style="color: white;"></i>
                        </a>
                    </h5>
                </div>


                <p><br>{{ $cliente->disponibilidad }}</p>
            </div>


            @if($alta)
            <div class="border p-3 mt-3 mt-md-0">
                <div
                    style="background-color: #1e3a5e; color: white; padding: 8px; border-radius: 8px; box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);">
                    <h5 style="margin: 0; font-size: 18px; margin-bottom: 1px; padding-bottom: 5px;">Equipamiento
                        asignado</h5>
                </div>
                <br>
                @if($materiales_asignados->isNotEmpty())
                <ul style="list-style-type: none; padding: 0;">
                    @foreach($materiales_asignados as $material)
                    <li style="border-bottom: 1px solid #ccc; padding-bottom: 5px; margin-bottom: 5px;">
                        <span style="font-weight: bold; color: #333;">{{ $material->marca }}</span> -
                        <span style="font-style: italic;">{{ $material->modelo }}</span> -
                        <span>{{ $material->num_serie }}</span>
                    </li>
                    @endforeach
                </ul>
                @else
                <p>No hay equipamiento asignado para este cliente.</p>
                @endif
            </div>
            @endif


            <div class="border p-3 mt-3 mt-md-0 {{ !$alta ? '' : 'd-none' }}">

                <button class="btn btn-danger w-100" style="box-shadow: 0 4px 6px rgba(0, 0, 0, 0.5);"
                    onclick="mostrarFormulario()">Proceder con el alta</button>

                <!-- Formulario adicional oculto -->
                <div id="formularioAlta" style="display: none;">
                    <form method="POST" action="{{ route('dar_alta') }}">
                        @csrf
                        <div class="form-group" style="display: none;">
                            <label for="id_cliente">ID del Cliente</label>
                            <input id="id_cliente" type="hidden" name="id_cliente" value="{{ $cliente->id }}">
                        </div>

                        <!-- Agregar campo para la dirección MAC -->
                        <div class="form-group">
                            <label for="mac">Dirección MAC</label>
                            <input id="mac" type="text" class="form-control" name="mac" required>
                        </div>

                        <!-- Resto de los campos -->
                        <div class="form-group">
                            <label for="observaciones">Observaciones del proceso de alta</label>
                            <textarea id="observaciones" class="form-control" name="observaciones" rows="3"
                                required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="rssi">RSSI</label>
                            <input id="rssi" type="text" class="form-control" name="rssi" required>
                        </div>

                        <div class="form-group">
                            <label for="test">Test</label>
                            <input id="test" type="text" class="form-control" name="test" required>
                        </div>

                        <div class="form-group">
                            <label for="nuevo_estado">Nuevo estado</label>
                            <select id="nuevo_estado" class="form-control" name="nuevo_estado" required>
                                <option value="">Seleccionar estado</option> <!-- Opción por defecto -->
                                @foreach ($estados as $estado)
                                <option value="{{ $estado->id }}">{{ $estado->nombre }}</option>
                                @endforeach
                            </select>
                        </div>





                        <button id="botonGuardar" type="submit" class="btn btn-primary"
                            style="display: none;">Guardar</button>
                    </form>
                </div>


            </div>
        </div>
        <!----------------------------- Modal Incidencias --------------------------------->
        <div class="col-md-4">
            <div class="border p-3 mt-3 mt-md-0">
                <div
                    style="background-color: #1e3a5e; color: white; padding: 8px; border-radius: 8px; box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2); position: relative;">
                    <h5 style="margin: 0; font-size: 18px; margin-bottom: 1px; padding-bottom: 5px;">Incidencias

                        <!-- Botón para abrir el modal de incidencias -->
                        <a href="#" onclick="mostrarModalIncidencias()"
                            style="position: absolute; top: 50%; transform: translateY(-50%); right: 10px;">
                            <i class="fa-solid fa-square-plus" style="color: #ffffff;"></i>
                        </a>
                    </h5>
                </div>
                <div>
                </div>






                <br>
                <!-- Botón para abrir la ventana modal de incidencias cerradas -->
                <div id="listado-incidencias">
                    <span>Incidencias resueltas</span> &nbsp;
                    <button type="button" class="btn btn-success " data-toggle="modal"
                        onclick="mostrarModalIncidenciasCerradas()">
                        {{ $numIncidenciasCerradas }}
                    </button>
                </div>



                <div>
                    <br><br>
                    <span>Incidencias por resolver </span>
                    @if($incidencias->isEmpty())
                    <p>No hay incidencias asociadas a este cliente.</p>
                    @else
                    <ul class="list-unstyled">
                        @foreach($incidencias as $incidencia)
                        <li class="list-group-item clickable-incidencia"
                            style="color: maroon; font-weight: bold; text-decoration: underline; cursor: pointer;"
                            onclick="abrirModalEditarIncidencia({{ $incidencia->id }}, '{{ $incidencia->created_at->format('Y-m-d') }}', '{{ $incidencia->descripcion }}')">
                            <div style="display: inline-block;">
                                <strong><span
                                        style="color: black; font-size: smaller;">{{ $incidencia->created_at->format('Y-m-d') }}</span></strong>
                            </div>
                            <div style="display: inline-block; margin: 0 5px;">
                                -
                            </div>
                            <div style="display: inline-block;">
                                {{ $incidencia->descripcion }}
                            </div>
                            <br>
                        </li>
                        <br>
                        @endforeach
                    </ul>











                    @endif
                </div>


                <!-- Modal de incidencias cerradas -->
                <div class="modal fade" id="modalCerradas" tabindex="-1" role="dialog"
                    aria-labelledby="modalCerradasLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalCerradasLabel">Incidencias resueltas</h5>
                                <button type="button" class="close" onclick="hideModalMostrarIncidencias()"
                                    aria-label="Cerrar">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" id="incidenciasCerradasContainer">
                                <!-- Aquí se cargarán dinámicamente las incidencias cerradas -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    onclick="hideModalMostrarIncidencias()">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>










            </div>

            <!-- Ventana Modal para Observaciones -->
            <div class="modal fade" id="modalObservaciones" tabindex="-1" role="dialog"
                aria-labelledby="modalObservacionesLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalObservacionesLabel">Editar Observaciones</h5>
                            <button type="button" class="close" onclick="hideModalObservaciones()" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="formObservaciones">
                                <div class="form-group">
                                    <label for="observaciones">Observaciones:</label>
                                    <textarea class="form-control" id="observaciones"
                                        rows="4">{{ $alta->observaciones ?? 'Sin observaciones' }}</textarea>
                                </div>
                                @if ($alta)
                                <button type="submit" class="btn btn-primary"
                                    onclick="updateObservaciones('{{ $alta->id }}', $('#observaciones').val())">Guardar</button>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Disponibilidad -->

            <div class="modal fade" id="modalDisponibilidad" tabindex="-1" role="dialog"
                aria-labelledby="modalDisponibilidadLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalDisponibilidadLabel">Editar Disponibilidad
                            </h5>
                            <button type="button" class="close" onclick="hideModalDisp()" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="formDisponibilidad">
                                <div class="form-group">
                                    <label for="disponibilidad">Disponibilidad:</label>
                                    <textarea class="form-control" id="disponibilidad" rows="4"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary"
                                    onclick="updateDisponibilidad('{{ $cliente->id }}', $('#disponibilidad').val())">Guardar</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>






            @endsection
            <script>
            function getClienteIdFromUrl() {
                var url = window.location.href;
                var parts = url.split('/');
                return parts[parts.length - 1];
            }

            function mostrarModalIncidenciasCerradas() {

                $.ajax({
                    url: '/incidencias_cerradas',
                    type: 'GET',
                    success: function(response) {
                        var incidencias = response.incidencias;
                        $('#incidenciasCerradasContainer').empty();
                        incidencias.forEach(function(incidencia) {
                            var fecha = new Date(incidencia.created_at);
                            var fechaFormateada = fecha.toLocaleDateString();
                            var solucion = incidencia.solucion;
                            var tecnicoNombre = incidencia.tecnico ? incidencia.tecnico.nombre :
                                'No especificado';
                            var contenidoIncidencia =
                                '<span class="descripcion-incidencia" style="text-decoration: underline; cursor: pointer; color: #28a745;">' +
                                fechaFormateada + ' - ' + incidencia.descripcion +
                                '</span>';
                            contenidoIncidencia +=
                                '<p class="solucion-incidencia" style="display: none;">' +
                                solucion + '</p>';
                            $('#incidenciasCerradasContainer').append(
                                '<div class="clickable-incidencia">' + contenidoIncidencia +
                                '</div>');
                        });
                        $('#modalCerradas').modal('show');

                        // Evento de clic para mostrar la solución de la incidencia
                        $(document).on('click', '.clickable-incidencia', function() {
                            $(this).find('.solucion-incidencia').slideToggle();
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                        alert('Error al obtener las incidencias cerradas.');
                    }
                });
            }

            function hideModalMostrarIncidencias() {
                $('#modalCerradas').modal('hide');
            }

            function hideModalIncAbi() {
                // Ocultar el modal de disponibilidad
                $('#modalIncidenciasCerradas').modal('hide');
            }
            </script>




            <script>
            // Función para configurar el color de fondo del select al cargar la página
            window.onload = function() {
                var select = document.getElementById('estado');
                var option = select.options[select.selectedIndex];
                select.style.backgroundColor = option.style.backgroundColor;
            }

            function cambiarColorTexto(select) {
                var option = select.options[select.selectedIndex];
                var color = getComputedStyle(option).color;
                select.style.color = color;
                select.style.backgroundColor = option.style.backgroundColor;
            }
            </script>







            <script>
            function mostrarHoraVisita() {
                var necesitaVisitaCheckbox = document.getElementById("necesitaVisita");
                var fechaHoraVisitaDiv = document.getElementById("fechaHoraVisita");

                // Si el checkbox está marcado, muestra el campo "Hora de la visita", de lo contrario, lo oculta
                if (necesitaVisitaCheckbox.checked) {
                    fechaHoraVisitaDiv.style.display = "block";
                } else {
                    fechaHoraVisitaDiv.style.display = "none";
                }
            }
            </script>




            <script>
            function mostrarFormulario() {
                var formularioAlta = document.getElementById('formularioAlta');
                formularioAlta.style.display = 'block';
            }


            document.addEventListener('DOMContentLoaded', function() {
                var macInput = document.getElementById('mac');
                var botonGuardar = document.getElementById('botonGuardar');


                macInput.addEventListener('blur', function() {
                    console.log('Campo de entrada MAC fuera de foco');

                    // Restablecer el color de fondo del campo MAC
                    macInput.style.backgroundColor = '';

                    // Verificar si la entrada coincide exactamente con una dirección MAC existente
                    var macValue = macInput.value;
                    console.log('Valor de la MAC ingresada:', macValue);

                    if (macValue !== '') {
                        fetch('/buscar_mac_similar?mac=' + macValue)
                            .then(response => response.json())
                            .then(data => {
                                // Verificar si la MAC existe y no está siendo utilizada
                                console.log('Valor de la MAC ingresada:', data.utilizado);
                                if (data.mac === macValue && data.utilizado === 0) {
                                    macInput.style.backgroundColor = 'lightgreen';
                                    botonGuardar.style.display = 'block';
                                } else {
                                    macInput.style.backgroundColor = 'red';
                                    botonGuardar.style.display = 'none';
                                }
                            })
                            .catch(error => {
                                console.error('Error al buscar la MAC:', error);
                            });
                    }
                });
            });
            </script>


            <!-- /////////////////////////////////////////////////////////ACTUALIZAR OBSERVACIONES//////////////////////////////////////////// -->

            <script>
            // Función para mostrar la ventana modal de observaciones
            function mostrarModalObservaciones() {
                $('#modalObservaciones').modal('show');
            }

            // Función para ocultar la ventana modal de observaciones
            function hideModalObservaciones() {
                $('#modalObservaciones').modal('hide');
            }

            // Función para actualizar las observaciones
            function updateObservaciones(id, observaciones) {
                // Imprimir los parámetros en la consola para verificar que llegan correctamente
                console.log("ID del objeto:", id);
                console.log("Nuevas observaciones:", observaciones);

                var token = '{{ csrf_token() }}';
                // Realizar la llamada AJAX para actualizar las observaciones en la base de datos
                $.ajax({
                    url: "{{ route('actualizar_observaciones') }}",
                    method: 'POST',
                    data: {
                        _token: token, // Incluir el token CSRF en los datos
                        id: id,
                        observaciones: observaciones
                    },
                    success: function(response) {
                        console.log("Observaciones actualizadas correctamente en la base de datos");

                        hideModalObservaciones();
                        window.location.reload();
                    },
                    error: function(xhr, status, error) {
                        console.error("Error al actualizar observaciones:", error);

                    }
                });
            }



            /////////////////////////////////////////////////////////DISPONIBILIDAD////////////////////////////////////////////

            function mostrarModalDisponibilidad(clienteId) {
                var disponibilidad = "{{ $cliente->disponibilidad }}";
                $('#disponibilidad').val(disponibilidad);
                $('#modalDisponibilidad').modal('show');
                $('#formDisponibilidad').submit(function(event) {
                    event.preventDefault();
                    var nuevasDisponibilidad = $('#disponibilidad').val();
                })

                window.updateDisponibilidad = function(clienteId, nuevaDisponibilidad) {

                    $.post("{{ route('api.updateDisponibilidad') }}", {
                            _token: "{{ csrf_token() }}",
                            id: clienteId,
                            disponibilidad: nuevaDisponibilidad,
                        })
                        .done(function(response) {
                            if (response.error) {
                                Swal.fire({
                                    title: response.error,
                                    icon: "error"
                                })
                                $('#botonGuardarSolucion').attr('disabled', false)
                                return;
                            } else {
                                Swal.fire({
                                    title: "Disponibilidad modificada correctamente",
                                    icon: "success"
                                }).then(() => {
                                    window.location.reload();
                                })
                            }
                        })
                        .fail(function(response) {
                            Swal.fire({
                                title: "Error en la modificación de la disponibilidad",
                                icon: "error"
                            })
                            $('#botonGuardarSolucion').attr('disabled', false)
                        })
                }
            }


            function hideModalDisp() {
                // Ocultar el modal de disponibilidad
                $('#modalDisponibilidad').modal('hide');
            }
            </script>





            @php
            /*
            $.post("{{ route('/') }}", {
            // motivo: motivo,
            // descripcion: descripcion,
            // _token: "{{ csrf_token() }}"
            })
            .done(function(response) {
            // Aquí puedes manejar la respuesta del servidor
            })
            .fail(function(xhr, status, error) {
            console.error(xhr.responseText);
            });

            // Luego puedes hacer alguna acción como cerrar el modal
            */
            @endphp



        </div>


    </div>
</div>