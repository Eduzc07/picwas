@extends('layouts.master')

@section('title', 'Registrate como cliente')

@section('content')
<div class="div-full-screen-background-image" style="background-image: url({{ asset('img/background-image-customer-login.jpg') }});"></div>

<div class="position-fixed w-100 h-100 bg-green-opacity-50" style="z-index: -888; top: 0px;">
<!--
    class="position-fixed w-100 h-100" style="z-index: -888;" - full width and height div
-->
</div>

<div class="container-fluid bg-white" style="margin-top: 80px;">
    <div class="position-absolute d-none d-md-block" style="top: 3rem; right: 1rem; max-width: 160px; z-index: 2">
        <a href="{{route('/')}}"><img class="img-fluid" src="{{ asset('img/logo_color_white_dark_shadow.png') }}" alt="{{config('app.name')}}"></a>
    </div>

    <div class="row align-items-center" style="height: 100vh;">
        <div class="col-12 text-center bg-white">
            <!-- <div class="col-12">
                <h1 class="justify-content-center pr-5 pl-5 pt-1 pb-1 d-inline-flex w-100" style="max-width: 28rem;">&nbsp</h1>
            </div> -->
            <div id="background-register" class="row pt-4">
                <div class="col-6 mx-auto">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show text-left" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <strong></strong>
                        </div>
                    @endif
                </div>
                <div class="col-12">
                    <h3 class="color-1"><u>Terminos y Condiciones</u></h3>

                    <h4><u> Fotógrafo: </u></h4>
                    <p>

                    </p>

                    <h4><u> Usuario: </u></h4>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('loadScripts')
    <script src="{{ asset('js/scripts.js') }}"></script>
@endsection
