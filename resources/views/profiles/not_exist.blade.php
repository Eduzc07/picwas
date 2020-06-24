@extends('layouts.master')

@section('title', '¡Este usuario no existe!')

@section('content')

@include("layouts.navbar")

<div class="container-fluid mt-3 px-md-5">
    <div class="row">
        <div class="col-12 mt-5">
            <h1 class="text-warning p-5 m-5 text-center">{{$username . " no se ha encontrado en nuestros registros."}}</h1>
        </div>
    </div>
</div>
@endsection
