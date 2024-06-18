@extends('layouts.app')

@section('content')
@if ($rol = auth()->user()->rol == 'administrador')
@include('partials.menu_admin')
@php
$isAdmin = true;
@endphp
@elseif ($rol = auth()->user()->rol == 'soporte')
@include('partials.menu_soporte')
@elseif ($rol = auth()->user()->rol == 'mantenimiento')
@include('partials.menu_mantenimiento')
@elseif ($rol = auth()->user()->rol == 'cliente')
@include('partials.menu_cliente')
@endif


<br>
<br>
<br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Cambiar contraseña') }}</div>

                <div class="card-body">

                    <div class="form-group">
                        <label for="current_password">Contraseña actual</label>
                        <input id="current_password" name="current_password" type="password" class="form-control"
                            autocomplete="current-password" />
                    </div>

                    <div class="form-group">
                        <label for="password">Nueva contraseña</label>
                        <input id="password" name="password" type="password" class="form-control"
                            autocomplete="new-password" />
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Repetir contraseña</label>
                        <input id="password_confirmation" name="password_confirmation" type="password"
                            class="form-control" autocomplete="new-password" />
                    </div>

                    <button onclick="savePassword()" class="btn btn-primary">{{ __('Guardar') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
function savePassword() {
    $.post("{{ route('profile.update') }}", {
            _token: "{{ csrf_token() }}",
            current_password: $("#current_password").val(),
            password: $("#password").val(),
            password_confirmation: $("#password_confirmation").val()
        })
        .done(function(response) {
            if (response.status == "success") {
                Swal.fire({
                    title: "Contraseña actualizada",
                    icon: "success"
                }).then(() => {
                    window.location.reload();
                })
            } else {
                Swal.fire({
                    title: "Error",
                    text: response.message,
                    icon: "error"
                })
            }
        })
}
</script>





@endsection