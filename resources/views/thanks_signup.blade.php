@extends('layouts.master')

@section('title', '!Gracias por registrarte¡')

@section('content')
<div class="div-full-screen-background-image" style="background-image: url({{ asset('img/background-image-photographer-login.jpg') }});"></div>

<div class="position-fixed w-100 h-100 bg-green-opacity-50" style="z-index: -888; top: 0px;">
<!--
    class="position-fixed w-100 h-100" style="z-index: -888;" - full width and height div
-->
</div>

<div class="container-fluid bg-white" style="margin-top: 80px;">

    <div class="row align-items-center" style="height: 100vh;">
        <div class="col-12 text-center bg-white">
            <div class="row justify-content-center">
                <div class="col-8 col-sm-4">
                    <img src="{{ asset('img/tmp-logo-image-dark-white-circle.png') }}" alt="Foteando" class="img-fluid" style="min-width: 150px;">
                </div>
                <div class="w-100"></div>
                <div class="col-12">
                    <h3 class="mt-5 mb-4">¡Gracias Fabiola!</h3>
                    <p>Revise su correo electrónico para verificar su cuenta.</p>
                    <p>El correo electrónico se envió a: fzarate.caceres@gmail.com <b><a href="">cambiar</a></b></p>
                    <p>¿No recibió un correo electrónico? <b><a href="">Volver a enviar</a></b></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
