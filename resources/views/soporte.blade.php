@extends('layouts.app')

@section('content')
@include('partials.menu_soporte')

<br>
<br>
<br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Helpdesk news') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    {{ __('Estas logueado en el sistema como ') }}{{ $mensaje }}
                </div>
            </div>
        </div>
    </div>
</div>


</div>
</div>
</div>
@endsection