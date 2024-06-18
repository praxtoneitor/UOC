<!------------------ Modal de añadir incidencias ------------------->
<div class="modal fade" id="modalIncidencias" tabindex="-1" role="dialog" aria-labelledby="modalIncidenciasLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalIncidenciasLabel">Añadir nueva incidencia</h5>
                <button type="button" class="close" onclick="hideModalIncidencias()" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="formIncidencias" action="{{ route('guardar_incidencia') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id_cliente" value="{{ $cliente->id }}">

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="motivo">Motivo:</label>
                            <select class="form-control" id="motivo" name="tipo_incidencia">
                                <option value="sinInternet" selected>Sin internet</option>
                                <option value="averia">Avería</option>
                                <option value="bajaServicio">Baja del servicio</option>
                                <option value="otros">Otros</option>
                            </select>
                        </div>

                        <div class="form-group col-md-6 {{ auth()->user()->rol == 'cliente' ? 'd-none' : ''}}">
                            <label for="viaComunicacion">Vía de comunicación:</label>
                            <select class="form-control" id="via_comunicacion" name="via_comunicacion">
                                @if (auth()->user()->rol == 'cliente')
                                    <option value="" selected></option>
                                @endif
                                <option value="telefono" selected>Teléfono</option>
                                <option value="mail">Mail</option>
                                <option value="presencial">Presencial</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="descripcion">Descripción del problema:</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" rows="4"
                                required></textarea>
                        </div>

                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="necesitaVisita"
                                    name="necesitaVisita" onchange="mostrarHoraVisita()">
                                <label class="form-check-label" for="necesitaVisita">Necesita
                                    visita</label>
                            </div>
                        </div>
                        <div class="form-group col-md-6" id="fechaHoraVisita" style="display: none;">
                            <label for="fechaHoraVisitaInput">Fecha y hora previstas de la
                                visita:</label>
                            <input type="datetime-local" class="form-control" id="fechaHoraVisitaInput"
                                name="fechaHoraVisita">
                        </div>
                    </div>

                    <div class="form-group col-md-6 {{ auth()->user()->rol == 'soporte' ? '' : 'd-none'}}">
                        <label for="estado">Estado:</label>
                        <select class="form-control text-white" id="estado" name="estado"
                            onchange="cambiarColorTexto(this)" style="width: 200px;">
                            <option value="abierto" class="estado-abierto" style="background-color: red;" selected>
                                Abierto</option>
                            <option value="enProceso" class="estado-en-proceso" style="background-color: #ff8040;">
                                En
                                proceso</option>
                            <option value="finalizado" class="estado-finalizado" style="background-color: #00df00;">
                                Finalizado</option>
                        </select>
                    </div>


                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
$(document).ready(function() {
    // Escuchar el evento submit del formulario
    $('#formIncidencias').submit(function(event) {
        // Evitar el envío del formulario por defecto
        event.preventDefault();

        // Realizar la petición AJAX para enviar los datos
        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: $(this).serialize(),
            dataType: 'json', // Especificar el tipo de datos esperados como JSON
            success: function(response) {
                // Mostrar el mensaje de éxito con Swal.fire
                Swal.fire({
                    icon: 'success',
                    title: response.message,
                    showConfirmButton: false,
                    timer: 1500 // Cerrar automáticamente después de 1.5 segundos
                }).then(function() {
                    // Recargar la página después de mostrar el mensaje de éxito
                    location.reload();
                });

                // Envía la solicitud AJAX para enviar el correo electrónico
                $.ajax({
                    url: '/enviar_correo',
                    type: 'POST',
                    dataType: 'json',
                    success: function(response) {
                        console.log('Correo electrónico enviado');
                    },
                    error: function(xhr, status, error) {
                        console.error(
                            'Error al enviar el correo electrónico:',
                            error);
                    }
                });
            },
            error: function(xhr, status, error) {
                // Manejar el error si la petición falla
                console.error('Error:', error);
                // Mostrar un mensaje de error con Swal.fire
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: '¡Ha ocurrido un error! Por favor, inténtelo de nuevo más tarde.'
                });
            }
        });
    });
});

function mostrarModalIncidencias() {
    $('#modalIncidencias').modal('show');
}

function hideModalIncidencias() {
    $('#modalIncidencias').modal('hide');
}

$('#formIncidencias').submit(function(event) {
    event.preventDefault();
    var motivo = $('#motivo').val();
    var descripcion = $('#descripcion').val();



    hideModalIncidencias();
});
</script>