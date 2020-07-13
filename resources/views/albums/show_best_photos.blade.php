@extends('layouts.master')

@section('title', "Mejores fotos de " . Auth::user()->username)

@section('content')

@include("layouts.navbar")

<div class="container-fluid pt-3 px-md-4">
    <div class="row">
        <div class="col-12 col-md-4 col-lg-3 text-center pt-3">
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

            <div class="row mx-auto mx-lg-0" style="max-width: 300px">
                <div class="col-12 pl-lg-0">
                    <p><h2>{{ Auth::user()->first_name}}<br>
                    {{ Auth::user()->last_name}}</h2></p>
                    <p><h5 class="text-break">{{ "@".Auth::user()->username }}</h5></p>
                    <p></span><h6><span class="flag-icon flag-icon-{{strtolower(App\Country::find(Auth::user()->country_id)->alpha_2_code)}} rounded"></span> {{App\Country::find(Auth::user()->country_id)->name}}</h6></p>
                    <hr>
                    <p>{{Auth::user()->description}}</p>
                </div>

                @can('edit', Auth::user())
                    <div class="col-12 pl-lg-0">
                        <a href="{{route('user.edit', [Auth::user()->username])}}" class="btn button-style-2 text-white font-weight-bold px-3" style="font-size: 1.2rem;">Editar perfil</a>
                        <hr>

                        <a href="{{route('user', [Auth::user()->username])}}" class="btn button-style-2 text-white font-weight-bold px-3" style="font-size: 1.2rem;">Todos los álbumes</a>
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
                            Mis mejores fotos
                        </h4>
                    </div>
                    @can('edit', Auth::user())
                        <div class="col-12 col-md-6 text-center text-md-right">
                            <a href="{{route('albums.create')}}" class="btn btn-sm button-style-2 text-white font-weight-bold px-3 py-1" style="font-size: 1.2rem;">Crear nuevo álbum</a>
                        </div>
                    @endcan
                </div>

                <hr class="bg-color-1" style="height: 1px">

                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3">
                    @forelse($photos as $photo)
                        <div class="col my-4 text-center">
                            <a class="thumbnail text-decoration-none text-dark" href="#" data-image-id="" data-toggle="modal" data-title="" data-image="{{asset('storage/albums_photos/'.$photo->modified_image)}}" data-target="#image-gallery">

                                <img class="w-100 h-100 rounded" src="{{asset('storage/albums_photos/'.$photo->modified_image)}}" style="object-fit: cover;">
                            </a>
                            <a onclick="addOrRemoveBestPhoto({{$photo->id}})" title="Añadir a mejores fotos" style="cursor: copy;"><i id="star-{{$photo->id}}" class="fa fa-star {{$photo->best ? 'text-warning' : 'text-white'}}" style="position: absolute; top: 10px; right: 22px; font-size: 1.3rem"></i></a>
                        </div>
                    @empty
                        <div class="my-4 text-center mx-auto">
                            <h4 class="text-warning">No tienes mejores fotos.</h4>
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
    <script>
        function addOrRemoveBestPhoto(photoReference) {

            $.ajax({
                type: "POST",
                url: "{{route('photos.add.best')}}",
                data: {
                    _token: "{{ csrf_token() }}",
                    photo: photoReference
                },
                dataType: 'JSON',
                success: function (response) {
                    switch (response.status) {
                        case 0:
                            if ($('#star-'+photoReference).hasClass('text-warning')) {
                                $('#star-'+photoReference).removeClass('text-warning');
                                $('#star-'+photoReference).addClass('text-white');
                            } else {
                                $('#star-'+photoReference).removeClass('text-white');
                                $('#star-'+photoReference).addClass('text-warning');
                            }
                            location.reload();
                            break;
                        default:
                            break;
                    }
                }
            });
        }
    </script>
@endsection
