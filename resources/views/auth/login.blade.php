@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/style.css') }}">
@endsection

@section('content')

    <section class="section li-wrapped">
        
        <div class="columns">
            <div class="column is-4 is-offset-4">
                <div class="box li-box">
                    <h1 class="title">Inicio de sesión</h1>

                    <form method="POST" action="{{ route('login') }}" id="login_form">
                        @csrf
                        
                        <div class="field">
                            <label for="login_email" class="label">E-mail</label>
                            <div class="control">
                                <input type="email" class="input {{ $errors->has('email') ? 'is-danger' : '' }}" id="login_email" name="email" autofocus placeholder="invitado@yourself.com">
                            </div>

                            @if($errors->has('email'))
                                <div class="help is-danger">
                                    Los datos que ingresaste son incorrectos, recuerda que esta sección es sólo para administradores.
                                </div>
                            @endif
                        </div>
                        
                        <div class="field">
                            <label for="login_password" class="label">Contraseña</label>
                            <div class="control">
                                <input type="password" class="input" id="login_password" name="password" placeholder="contraseña">
                            </div>
                        </div>
                        
                        <div class="field is-grouped" style="display: flex; justify-content: flex-end;">
                            <div class="control">'
                                <a href="" class="button is-simple">Regresar a home</a>
                            </div>
                            <div class="control">
                                <input type="submit" class="button is-primary" value="Iniciar Sesión">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </section>


@endsection