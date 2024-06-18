@extends('layouts.app')

@section('content')
@include('partials.menu_cliente')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Facturas del Cliente') }}</div>

                <div class="card-body" style="margin-top: 10px;">
                    @if($facturas->isEmpty())
                    <p>No hay facturas para mostrar.</p>
                    @else
                    <ul class="list-group">
                        @foreach($facturas as $factura)
                        <li class="list-group-item">
                            <a href="{{ url('facturas/' . $factura->nombre_factura) }}" target="_blank">
                                {{ $factura->nombre_factura }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                    @endif
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