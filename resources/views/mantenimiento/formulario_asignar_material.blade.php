@extends('layouts.app')

@section('content')
@include('partials.menu_mantenimiento')
<div style="background-color: #f2f2f2; padding: 20px;">
    <h1 style="text-align: center; color: #333; font-family: 'Arial Black', sans-serif; font-size: 24px;">Asignar
        material a nodo</h1>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">


                <div class="card-body">
                    @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                    @endif

                    <form method="POST" action="{{ route('save_nodo_material') }}">
                        @csrf

                        <div class="form-group">
                            <label for="nodo_id">Nodo:</label>
                            <select id="nodo_id" name="nodo_id" class="form-control">
                                @foreach($nodos as $nodo)
                                <option value="{{ $nodo->id }}">{{ $nodo->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="material_id">Material:</label>
                            <select id="material_id" name="material_id" class="form-control">
                                @foreach($materiales as $material)
                                <option value="{{ $material->id }}">{{ $material->marca }} - {{ $material->modelo }} -
                                    {{ $material->mac }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="ip">IP:</label>
                            <input type="text" id="ip" name="ip" value="{{ old('ip') }}" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="alias">Alias:</label>
                            <input type="text" id="alias" name="alias" value="{{ old('alias') }}" class="form-control">
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Asignar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const addButton = document.querySelector(".btn-toggle[data-target='add_material'] .fa-paperclip");
    addButton.style.color = '#B92A0C'
});
</script>
@endsection