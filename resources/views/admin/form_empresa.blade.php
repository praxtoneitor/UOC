@extends('layouts.app')
@section('content')
@include('partials.menu_admin')
@php
$isAdmin = true;
@endphp

<!DOCTYPE html>
<html>

<head>
    <title>Cambiar nombre de la empresa</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h3>Cambiar nombre de la empresa</h3>
            </div>
            <div class="card-body">
                @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif

                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form action="{{ route('admin.store_empresa') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="app_name">Nombre de la Aplicación:</label>
                        <input type="text" class="form-control" id="app_name" name="app_name" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
@endsection

<script>
document.addEventListener("DOMContentLoaded", function() {
    const addButton = document.querySelector(".btn-toggle[data-target='app-name'] .fa-building");
    addButton.style.color = '#B92A0C';
});
</script>