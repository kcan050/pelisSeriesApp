@extends('base')

@section('content')
@if(Auth::check())
    @if(auth()->user()->email_verified_at == null)
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header" style="background-color:black; color:white;">{{ __('Verificacion de email') }}</div>
        
                        <div class="card-body" style="background:#0b0c2a; color:white;">
                            @if (session('resent'))
                                <div class="alert alert-success" role="alert">
                                    {{ __('El email se ha enviado correctamente') }}
                                </div>
                            @endif
        
                            {{ __('Antes de ingresar a la pagina debe verificarse') }}
                            {{ __('Haga click en enviar para poder completar el ingreso') }},
                            <form class="d-inline" method="POST" action="{{ url('email/resend') }}">
                                @csrf
                                <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('Enviar') }}</button>.
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else    
    
    
    <h1 style="color:#e53637; text-align:center;">GRACIAS POR VERIFICARTE</h1>
    
    @endif    
@endif
@endsection
