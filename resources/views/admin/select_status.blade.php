@extends('layouts.app')

@section('content')
@include('partials.menu_admin')
@php
$isAdmin = true;
@endphp
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Generar PDFs de Clientes
                </div>
                <div class="card-body">
                    <form action="{{ route('pdf.generate') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="estado_id">Seleccionar Estado del Cliente:</label>
                            <select class="form-control" name="estado_id" id="estado_id" required>
                                <option value="">Seleccione un estado</option>
                                @foreach($estados as $estado)
                                <option value="{{ $estado->id }}">{{ $estado->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Generar PDFs</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const addButton = document.querySelector(".btn-toggle[data-target='facturas'] .fa-money-bill-1-wave");
    addButton.style.color = '#B92A0C'
});
</script>
@endsection