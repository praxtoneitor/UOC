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
                <div class="card-header">
                    {{ __('Listado de usuarios') }}
                    <div class="float-right">
                        <button class="btn btn-primary" onclick="openModalAddUser()">
                            <i class="fa-solid fa-plus"></i>
                            Nuevo usuario
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Correo electrónico</th>
                                    <th>Rol</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $item)
                                <tr>
                                    <td>
                                        {{ $item->name }}
                                    </td>
                                    <td>
                                        {{ $item->email }}
                                    </td>
                                    <td>
                                        {{ $item->rol }}
                                    </td>
                                    <td>
                                        <button class="btn btn-primary mr-2" id="editUser_{{ $item->id }}"
                                            onclick="editUser({{ $item->id }})">
                                            <i class="fa-solid fa-pencil"></i>
                                        </button>

                                        @if($item->rol !== 'administrador')
                                        <button class="btn btn-danger" onclick="deleteUser({{ $item->id }})">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="2">No hay estados disponibles</td>
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


<div class="modal" id="editUser" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar usuario</h5>
                <button type="button" class="close" onclick="hideModalEditUser()" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="form-group">
                    <label for="email">Correo electrónico</label>
                    <input type="email" class="form-control" id="email" placeholder="name@example.com">
                </div>

                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input type="text" class="form-control" id="name" placeholder="Nombre">
                </div>

                <div class="form-group">
                    <label for="rol">Rol</label>
                    <select class="form-control" id="rol">
                        <option value="administrador">Administrador</option>
                        <option value="soporte">Soporte</option>
                        <option value="mantenimiento">Mantenimiento</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input id="password" type="password" class="form-control" placeholder="Contraseña">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="buttonEditUser" onclick="updateUser()">Actualizar
                    usuario</button>
                <button type="button" class="btn btn-secondary" onclick="hideModalEditUser()">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="addUser" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Crear usuario</h5>
                <button type="button" class="close" onclick="hideModalAddtUser()" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="form-group">
                    <label for="add_email">Correo electrónico</label>
                    <input type="email" class="form-control" id="add_email" placeholder="name@example.com">
                </div>

                <div class="form-group">
                    <label for="add_name">Nombre</label>
                    <input type="text" class="form-control" id="add_name" placeholder="Nombre">
                </div>

                <div class="form-group">
                    <label for="add_rol">Rol</label>
                    <select class="form-control" id="add_rol">
                        <option value="administrador">Administrador</option>
                        <option value="soporte">Soporte</option>
                        <option value="mantenimiento">Mantenimiento</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="add_password">Contraseña</label>
                    <input id="add_password" type="password" class="form-control" placeholder="Contraseña">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="buttonAddUser" onclick="addUser()">Actualizar
                    usuario</button>
                <button type="button" class="btn btn-secondary" onclick="hideModalAddUser()">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script>
function editUser(id) {
    $.get("{{ route('api.getUser') }}", {
            id
        })
        .done(function(response) {
            $('#email').val(response.email);
            $('#name').val(response.name);
            $('#rol').val(response.rol);

            $('#editUser').modal('show');
        })
        .fail(function(response) {
            Swal.fire({
                title: "Error al traer la información del usuario",
                icon: "error"
            })
        })

    window.updateUser = function() {
        $('#buttonEditUser').attr('disabled', true)

        $.post("{{ route('api.updateUser') }}", {
                _token: "{{ csrf_token() }}",
                id,
                email: $('#email').val(),
                name: $('#name').val(),
                rol: $('#rol').val(),
                password: $('#password').val()
            })
            .done(function(response) {
                Swal.fire({
                    title: "Usuario editado correctamente",
                    icon: "success"
                }).then(() => {
                    window.location.reload();
                })
            })
            .fail(function(response) {
                Swal.fire({
                    title: "Error al editar el usuario",
                    icon: "error"
                })
                $('#buttonEditUser').attr('disabled', false)
            })
    }
}

function openModalAddUser() {
    $('#addUser').modal('show');

    $('#add_email').val('');
    $('#add_name').val('');
    $('#add_password').val('');
    $('#add_rol').val('soporte');

    window.addUser = function() {
        $('#buttonAddUser').attr('disabled', true)

        $.post("{{ route('api.storeUser') }}", {
                _token: "{{ csrf_token() }}",
                email: $('#add_email').val(),
                name: $('#add_name').val(),
                rol: $('#add_rol').val(),
                password: $('#add_password').val()
            })
            .done(function(response) {
                if (response.error) {
                    Swal.fire({
                        title: response.error,
                        icon: "error"
                    })
                    $('#buttonAddUser').attr('disabled', false)
                    return;
                } else {
                    Swal.fire({
                        title: "Usuario creado correctamente",
                        icon: "success"
                    }).then(() => {
                        window.location.reload();
                    })
                }
            })
            .fail(function(response) {
                Swal.fire({
                    title: "Usuario creado correctamente",
                    icon: "success"
                })
                $('#buttonAddUser').attr('disabled', false)
            })
    }
}

function hideModalEditUser() {
    $('#editUser').modal('hide');
}

function hideModalAddUser() {
    $('#addUser').modal('hide');
}

function deleteUser(id) {
    Swal.fire({
        title: "¿Estás seguro?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, eliminar",
        cancelButtonText: "Cancelar"
    }).then((result) => {
        if (result.isConfirmed) {

            $.post("{{ route('api.deleteUser') }}", {
                    _token: "{{ csrf_token() }}",
                    id
                })
                .done(function(response) {
                    Swal.fire({
                        title: "Eliminado correctamente",
                        icon: "success"
                    }).then(() => {
                        window.location.reload();
                    })
                })
        }
    });
}
</script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const addButton = document.querySelector(".btn-toggle[data-target='usuarios'] .fa-user-large");
    addButton.style.color = '#B92A0C';
});
</script>
@endsection