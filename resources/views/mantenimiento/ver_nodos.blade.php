@extends('layouts.app')

@section('content')
@include('partials.menu_mantenimiento')
<div style="background-color: #f2f2f2; padding: 20px;">
    <h1 style="text-align: center; color: #333; font-family: 'Arial Black', sans-serif; font-size: 24px;">Ver
        localizaciones</h1>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">


                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Nombre del Nodo</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($nodos as $nodo)
                                <tr>
                                    <td style="margin-right: 100px;">{{ $nodo->nombre }}</td>
                                    <td>
                                        <button class="btn btn-danger" onclick="deleteNodo({{ $nodo->id }})">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </td>
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
<script>
    function deleteNodo(id) {
        Swal.fire({
            title: "¿Estás seguro que deseas eliminarlo?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Sí",
            cancelButtonText: "No"
        }).then(() => {
            
                $.post("{{ route('api.destroy_nodo') }}", {
                    _token: "{{ csrf_token() }}",
                    id
                })
                .done(function(response) {
                    if (response.status == "error") {
                        Swal.fire({
                            title: response.message,
                            icon: "error"
                        })
                        $('#buttonAddUser').attr('disabled', false)
                        return;
                    } else {
                        Swal.fire({
                            title: response.message,
                            icon: "success"
                        }).then(() => {
                            window.location.reload();
                        })
                    }
                })
                .fail(function(response) {
                    Swal.fire({
                        title: "Error al eliminar el nodo",
                        icon: "error"
                    })
                    $('#buttonAddUser').attr('disabled', false)
                })
        })
    }
</script>

@endsection