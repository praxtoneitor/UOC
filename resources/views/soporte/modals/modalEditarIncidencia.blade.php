<!-- Modal de incidencias abiertas -->
<div id="modalEditarIncidencia" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Contenido de la ventana modal -->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Editar Incidencia</h4>
                <button type="button" class="close" onclick="hideModalEditarIncidencia()">&times;</button>
            </div>
            <div class="modal-body">
                <p id="descripcion"></p>
                <textarea id="solucion" class="form-control" placeholder="Ingrese la solución..."></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" onclick="hideModalEditarIncidencia()">Cerrar</button>
                <button type="button" class="btn btn-primary" id="botonGuardarSolucion"
                    onclick="guardarSolucion()">Guardar</button>
            </div>
        </div>
    </div>
</div>


<script>
//////////Editar incidencias en el modal
function abrirModalEditarIncidencia(id, fecha, descripcion) {

    $('#modalEditarIncidencia').find('#descripcion').text('Descripción: ' + descripcion);
    $('#modalEditarIncidencia').find('#solucion').val('');


    $('#modalEditarIncidencia').modal('show');

    window.guardarSolucion = function() {


        var solucion = $('#modalEditarIncidencia').find('#solucion').val();

        if (!solucion) {
            Swal.fire({
                title: "Por favor, ingrese la solución",
                icon: "error"
            })
            return;
        }

        $('#botonGuardarSolucion').attr('disabled', true)

        $.post("{{ route('api.updateIncidencia') }}", {
                _token: "{{ csrf_token() }}",
                id,
                solucion
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
                        title: "Solución guardada correctamente",
                        icon: "success"
                    }).then(() => {
                        window.location.reload();
                    })
                }
            })
            .fail(function(response) {
                Swal.fire({
                    title: "Error al guardar la solución",
                    icon: "error"
                })
                $('#botonGuardarSolucion').attr('disabled', false)
            })
    }
}

function hideModalEditarIncidencia() {
    $('#modalEditarIncidencia').modal('hide');
}
</script>