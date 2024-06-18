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
                <div class="card-header">{{ __('Añadir Servicio') }}</div>

                <div class="card-body" style="margin-top: 10px;">
                    <form method="POST" action="{{ route('store_servicio') }}">
                        @csrf

                        <div class="form-group">
                            <label for="nombre">{{ __('Nombre del Servicio') }}</label>
                            <input id="nombre" type="text" class="form-control" name="nombre" required autofocus>
                        </div>

                        <div class="form-group">
                            <label for="precio">{{ __('Precio') }}</label>
                            <input id="precio" type="number" step="0.01" class="form-control" name="precio" required>
                        </div>

                        <div>
                            <p></p>
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
    const addButton = document.querySelector(".btn-toggle[data-target='add_servicio'] .fa-coins");
    addButton.style.color = '#B92A0C';
});
</script>




@endsection