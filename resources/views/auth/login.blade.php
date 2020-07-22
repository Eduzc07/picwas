@extends('layouts.master')

@section('title', 'Ingresa como Fotógrafo')

@section('content')
<div class="div-full-screen-background-image" style="background-image: url({{ asset('img/background-image-photographer-login.jpg') }});"></div>

<div class="position-fixed w-100 h-100 bg-black-opacity-50" style="z-index: -888;">
<!--
    class="position-fixed w-100 h-100" style="z-index: -888;" - full width and height div
-->
</div>

<div class="container text-white h-100">
    <div class="row align-items-center" style="height: 80vh;">
        <div class="col-12 text-center">
            <div class="col-12">
                <h1 class="justify-content-center bg-style-1 rounded pr-5 pl-5 pt-1 pb-1 d-inline-flex w-100" style="max-width: 28rem;">Soy Fotógrafo</h1>
            </div>
            <div class="w-100 mt-3 mb-3">
                <h2 style="text-shadow: 0px 0px 6px #000000;">Ingresa</h2>
            </div>
            <div class="row">
                <div class="col-12">
                    <form id="formLogin" class="form-inline justify-content-center mb-4" method="POST" action="{{ route('login') }}" onsubmit="preventMultipleSubmitForm(this, '{{ asset('icons/blocks.svg')}}')">
                        @csrf
                        <input type="email" class="form-control p-3 mb-2 w-100" name="email" placeholder="Correo" style="max-width: 24rem; font-size: 1.2rem;" value="{{ old('email') }}">

                        <div class="w-100"></div>

                        <input type="password" class="form-control p-3 mb-2 w-100" name="password" placeholder="Contraseña" style="max-width: 24rem; font-size: 1.2rem;">

                        <div class="w-100"></div>

                        <button type="submit" class="btn button-style-1 text-white"><h4>Ingresar</h4></button>
                        <div id="espera_icon" class="loader text-center d-none" align="center">
                            <img align="center" src="{{asset('icons/blocks.svg')}}" style="max-width: 60px; width: 100%;"/>
                        </div>

                        <div class="w-100"></div>
                        @if (Route::has('password.request'))
                            <a class="btn btn-link p-1 text-white" href="{{ route('password.request') }}">
                                ¿Olvidaste tu contraseña?
                            </a>
                        @endif
                    </form>

                    <a href="{{ route('register') }}" class="btn btn-link text-white"><h3>Crea una cuenta gratis</h3></a>
                </div>
                <div class="col-6 mx-auto">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show text-left position-fixed" role="alert" style="top: 8px; right: 8px; padding: 10px 40px 0px 10px;">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <a href="{{route('/')}}" class="mx-auto fixed-bottom d-none d-md-block">
        <div class="mx-auto fixed-bottom bg-red-opacity-50 w-100 h-100 rounded-circle d-none d-md-block" style="z-index: -888; max-width: 180px; max-height: 180px; bottom: -30px;">
            <div class="h-100">
                <!-- <img class="img-fluid p-4 align-self-center mt-4" src="{{ asset('img/logo_white_dark_shadow.png') }}" alt=""> -->
                <img class="img-fluid p-4 align-self-center mt-4" src="{{ asset('img/logo_white_shadow.png') }}" alt="">
            </div>
        </div>
    </a>
</div>
@endsection

@section('loadScripts')
    <script src="{{ asset('js/scripts.js') }}"></script>
@endsection
