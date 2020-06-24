@extends('layouts.master')

@section('title', '!Gracias por registrarte¡')

@section('content')
<div class="div-full-screen-background-image" style="background-image: url({{ asset('img/background-image-photographer-login.jpg') }});"></div>

<div class="position-fixed w-100 h-100 bg-green-opacity-50" style="z-index: -888; top: 0px;"></div>

<div class="container-fluid bg-white" style="margin-top: 80px;">

    <div class="row align-items-center" style="height: 100vh;">
        <div class="col-12 text-center bg-white">
            <div class="row justify-content-center">
                <div class="col-8 col-sm-4">
                    <img src="{{ asset('img/logo_gray.png') }}" alt="{{config('app.name')}}" class="img-fluid" style="min-width: 150px;">
                </div>
                <div class="w-100"></div>
                <div class="col-12">
                    <h3 class="mt-5 mb-4">¡Gracias {{Auth::user()->first_name . " " . Auth::user()->last_name}}!</h3>
                    <p>Revise su correo electrónico para verificar su cuenta.</p>
                    <p>El correo electrónico se envió a: <b>{{Auth::user()->email}}</b>.</p>
                    <p>¿No recibió un correo electrónico? <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline"><b>Volver a enviar</b></button>
                    </form></p>
                    <p>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Salir</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
