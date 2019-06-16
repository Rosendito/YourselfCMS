@extends('layouts.app')

@section('styles')
    
    <style>
        .login-right{
            background: url("{{ asset('svg/mephis_bg.svg') }}");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
    </style>

@endsection

@section('content')
    
    <div class="login">
        <div class="login-left">
            <div class="container">
                <div class="heading">
                    <h1>Bienvenido!</h1>
                    <h3>Identifícate para comenzar</h3>
                </div>
    
                @yield('form')
            </div>
        </div>

        <div class="login-right">
            <p class="heading">
                Votaciones
                <strong>
                    OEMA
                </strong>
            </p>
        </div>
    </div>
@endsection