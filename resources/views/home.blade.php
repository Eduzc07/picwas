@extends('layouts.master')

@section('title', '¡Bienvenido!')

@section('content')
<div class="div-full-screen-background-image" style="background-image: url({{ asset('img/background-image-home.jpg') }});"></div>

<div class="position-fixed w-100 h-100 bg-black-opacity-50" style="z-index: -888;">
<!--
    class="position-fixed w-100 h-100" style="z-index: -888;" - full width and height div
-->
</div>

<div class="container text-white h-100">
    <div class="row align-items-center" style="height: 100vh;">
        <div class="col-12 text-center">
            <!-- <img src="{{ asset('img/logo_white_dark_shadow.png') }}" alt="" class="card-img-top img-fluid text-nowrap" style="min-width: 170px; max-width: 500px;"> -->
            <img src="{{ asset('img/logo_white_shadow.png') }}" alt="" class="card-img-top img-fluid text-nowrap" style="min-width: 170px; max-width: 600px;">
            <div class="w-100 mt-5 mb-4">
                <h1 style="font-size: 3.5rem; text-shadow: 0px 0px 6px #000000;">¡Bienvenido!</h1>
            </div>
            <div class="row">
                <div class="col-12 col-md-6 mb-2">
                    <a href="{{ route('login') }}" class="btn btn-success w-100 border-0 button-style-1"><h2>Soy Fotógrafo</h2></a>
                </div>
                <div class="col-12 col-md-6">
                    <a href="{{ route('customers.login') }}" class="btn btn-success w-100 border-0 button-style-1"><h2>Quiero buscar mis fotos</h2></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
