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
                <div class="card-header">{{ __('Añadir Estado') }}</div>

                <div class="card-body" style="margin-top: 10px;">
                    <form method="POST" action="{{ route('store_estado') }}">
                        @csrf

                        <div class="form-group">
                            <label for="nombre">{{ __('Nombre del Estado') }}</label>
                            <input id="nombre" type="text" class="form-control" name="nombre" required autofocus>
                        </div>

                        <div class="form-group">
                            <label for="font_color">{{ __('Color del Texto') }}</label>
                            <input id="font_color" type="color" class="form-control" name="font_color"
                                style="width: 40px;" required>
                        </div>

                        <div class="form-group">
                            <label for="bg_color">{{ __('Color de Fondo') }}</label>
                            <input id="bg_color" type="color" class="form-control" name="bg_color" style="width: 40px;"
                                required>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            {{ __('Añadir') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const addButton = document.querySelector(".btn-toggle[data-target='add_estado'] .fa-handshake");
    addButton.style.color = '#B92A0C'
});
</script>


@endsection