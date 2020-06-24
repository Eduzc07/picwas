@extends('layouts.master')

@section('title', "Mis fotos compradas")

@section('content')

@include("layouts.navbar")

<div class="container-fluid mt-3 px-md-5">
    <div class="row">
        <div class="col-12 col-md-12">
            <div class="mx-auto mx-md-4 mx-xl-5 profile-photo-border rounded-circle bg-white">
                <div class="mx-md-0 mx-auto border profile-photo-img rounded-circle" style="background-image: url({{ asset('/storage/avatars/'.Auth::user()->avatar) }});">
                    @can('is_photographer', Auth::user())
                        <div class="rounded-circle profile-photo-inside-container">
                            <img src="{{ asset('icons/icon_escudo_fotografos_2.png') }}" alt="" class="rounded-circle p-0 border-0 img-thumbnail">
                        </div>
                    @endcan
                </div>
            </div>
        </div>
        <div class="w-100"></div>

        <div class="col-12 col-md-4 col-lg-3 text-center">
            <div class="row mx-auto mx-lg-0" style="max-width: 300px">
                <div class="col-12 pl-lg-0">
                    <p><h2>{{ Auth::user()->first_name . " " . Auth::user()->last_name}}</h2></p>
                    <p><h5 class="text-break">{{ "@".Auth::user()->username }}</h5></p>
                    <p></span><h6><span class="flag-icon flag-icon-{{strtolower(App\Country::find(Auth::user()->country_id)->alpha_2_code)}} rounded"></span> {{App\Country::find(Auth::user()->country_id)->name}}</h6></p>
                    <hr>
                    <p>{{Auth::user()->description}}</p>
                </div>

                @can('edit', Auth::user())
                    <div class="col-12 pl-lg-0">
                        <a href="{{route('user.edit', [Auth::user()->username])}}" class="btn button-style-2 text-white font-weight-bold px-3" style="font-size: 1.2rem;">Editar perfil</a>
                        <hr>

                        @can('is_photographer')
                            <a href="{{route('user', [Auth::user()->username])}}" class="btn button-style-2 text-white font-weight-bold px-3" style="font-size: 1.2rem;">Todos los álbumes</a>
                        @endcan
                    </div>
                @endcan
            </div>
        </div>

        <div class="col-12 col-md-8 col-lg-9 py-3 px-1">
            <div class="container-fluid">
                @if (session()->get('success'))
                    <div class="alert alert-success alert-dismissible fade show text-left" role="alert">
                        <h4>{{ session()->get('success') }}</h4>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="row mb-2">
                    <div class="col-12 col-md-6 text-center text-md-left">
                        <h4 class="pt-2">
                            Fotos compradas
                        </h4>
                    </div>
                    <div class="col-12 col-md-6 text-center text-md-right">
                        <form action="{{route('search')}}" method="POST">
                            @csrf
                            <input type="hidden" name="search" value="">
                            <button type="submit" class="btn btn-sm button-style-2 text-white font-weight-bold px-5 py-1" style="font-size: 1.2rem;">Buscar fotos</button>
                        </form>
                    </div>
                </div>

                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3">
                    @forelse($photos as $photo)
                        <div class="col my-4 text-center">
                            <a class="thumbnail text-decoration-none text-dark" href="#" data-image-id="" data-toggle="modal" data-title="" data-image="{{asset('storage/purchased_photos_thumbnails/'.$photo->modified_image)}}" data-target="#image-gallery">

                                <img class="w-100 h-100 rounded" src="{{asset('storage/purchased_photos_thumbnails/'.$photo->modified_image)}}" style="object-fit: cover;">
                            </a>
                            <a href="{{ route('photo.download', [$photo->id]) }}" class="btn btn-link">Descargar</a>
                        </div>
                    @empty
                        <div class="my-4 text-center mx-auto">
                            <h4 class="text-warning">No has comprado ninguna foto.</h4>
                        </div>
                    @endforelse
                </div>

                <div class="modal fade" id="image-gallery" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body border p-0">
                                <div class="position-absolute h-100" style="z-index:1">
                                    <div class="row h-100 align-items-center">
                                        <div class="col">
                                            <button type="button" class="btn text-white" id="show-previous-image"><i class="fa fa-arrow-circle-left" style="font-size: 2rem"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="position-absolute h-100" style="z-index:1; right: 0px">
                                    <div class="row h-100 align-items-center">
                                        <div class="col">
                                            <button type="button" id="show-next-image" class="btn text-white"><i class="fa fa-arrow-circle-right" style="font-size: 2rem"></i></button>
                                        </div>
                                    </div>
                                </div>

                                <img id="image-gallery-image" class="img-responsive col-md-12 p-0" src="">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="justify-content-center my-4">{{ $photos->onEachSide(3)->links() }}</div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('loadScripts')
    <script src="{{ asset('js/gallery.js')}}"></script>
    <script src="{{ asset('js/bootstrap.confirm.js') }}"></script>
@endsection