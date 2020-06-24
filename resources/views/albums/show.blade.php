@extends('layouts.master')

@section('title', $album->name)

@section('content')

@include("layouts.navbar")

@php
    $ownerUser = App\User::findOrFail($album->user_id);

    $withCart = false;

    if (DB::table('cart')->where('user_id', Auth::user()->id)->first()) {
        $cartId = DB::table('cart')->where('user_id', Auth::user()->id)->first()->id;
        $photoIdInCart = App\CartDetail::where('cart_id', $cartId)->pluck('photo_id')->toArray();
        $withCart = true;
    }

@endphp

<div class="container-fluid mt-3 px-md-5">
    <div class="row">
        <div class="col-12">
            <div class="mx-auto profile-photo-border rounded-circle bg-white">
                <div class="mx-md-0 mx-auto border profile-photo-img rounded-circle" style="background-image: url({{ asset('/storage/avatars/'.$ownerUser->avatar) }});width: 130px; height: 130px; padding-top: 86px; padding-left: 86px;">
                    <div class="rounded-circle profile-photo-inside-container">
                        <img src="{{ asset('icons/icon_escudo_fotografos_2.png') }}" alt="" class="rounded-circle p-0 border-0 img-thumbnail">
                    </div>
                </div>
            </div>
        </div>
        <div class="w-100"></div>

        <div class="col-12 text-center">
            <div class="row mx-auto">
                <div class="col-12">
                    <p><h6>{{ $ownerUser->first_name . " " . $ownerUser->last_name}}</h6></p>
                    <p><h6><small><span class="flag-icon flag-icon-{{strtolower(App\Country::find($ownerUser->country_id)->alpha_2_code)}} rounded"></span> {{App\Country::find($ownerUser->country_id)->name}}</small></h6></p>
                    <p>
                        <h3>{{$album->name}}</h3>
                        <h6><small>#{{$album->category}}</small></h6>
                        @if($album->publication_time <= date('Y-m-d'))
                            @can('album_owner', $album)
                                <div class="p-1">
                                    <p class="text-danger">No disponible desde {{date('d-m-Y', strtotime($album->publication_time))}}</p>
                                </div>
                            @endcan
                        @else
                            <div class="p-1">
                                <p class="text-success">Disponible hasta {{date('d-m-Y', strtotime($album->publication_time))}}</p>
                            </div>
                        @endif

                        @can('album_owner', $album)
                            <a href="{{route('albums.edit', $album->id)}}" class="btn button-style-2 text-white font-weight-bold">Editar álbum</a>
                            <form action="{{route('albums.destroy', [$album->id])}}" method="POST" id="formDeleteAlbum">
                                @method("DELETE")
                                @csrf

                                <button class="btn btn-link" data-toggle="confirm" data-title="Eliminar álbum" data-message="¿Est
                                as seguro?<p class='text-muted'>Se van a eliminar todas las fotos del álbum." data-type="danger">Eliminar</button>
                            </form>
                        @endcan

                        @cannot('album_owner', $album)
                            @if(!$photos->isEmpty())
                                <form action="{{route('cart.add.album')}}" method="POST" id="formAddAlbumToCart">
                                    @csrf
                                    <input type="hidden" name="album" value="{{$album->id}}">
                                    <button onclick="showLoad(this, 'loader-add-album-to-cart')" class="btn button-style-2 text-white font-weight-bold" type="submit">Añadir álbum al carrito</button>
                                    <div id="loader-add-album-to-cart" class="loader d-none" align="center">
                                        <img id="espera_icon" align="center" src="{{ asset('icons/blocks.svg')}}" style="max-width: 60px; width: 100%;"/>
                                    </div>
                                </form>
                            @endif
                        @endcannot
                    </p>
                </div>
            </div>
        </div>

        <div class="col-12 py-3">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <form id="formAddPhotos" method="POST" action="{{ route('photos.store', [$album->id]) }}" class="px-md-5" enctype="multipart/form-data" onsubmit="preventMultipleSubmitForm(this, '{{ asset('icons/blocks.svg')}}', 'left')">
                            @csrf

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

                            @if (session()->get('success'))
                                <div class="alert alert-success alert-dismissible fade show text-left" role="alert">
                                    <h4>{{ session()->get('success') }}</h4>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            @can('album_owner', $album)
                                <div class="form-group">
                                    <label for="add_photos" class="form-label">Agrega fotos al album</label>

                                    <input type="file" id="add_photos" name="add_photos[]" class="filestyle color-1 d-none" data-text="Seleccionar fotos" data-btnClass="btn-secondary text-white rounded-0" data-buttonBefore="true" data-size="sm" data-dragdrop="false" multiple="">
                                </div>

                                <button type="submit" class="btn button-style-2 text-white font-weight-bold">Añadir fotos</button>
                            @endcan
                        </form>
                    </div>
                </div>
                <hr>

                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4">
                    @forelse($photos as $photo)
                        <div class="col my-4 text-center">
                            <a class="thumbnail text-decoration-none text-dark" href="#" data-image-id="" data-toggle="modal" data-title="" data-image="{{asset('storage/albums_photos/'.$photo->modified_image)}}" data-target="#image-gallery" data-reference="{{$photo->id}}" data-in-cart="{{($withCart && in_array($photo->id, $photoIdInCart)) ? 'true' : 'false'}}" data-test='<form action="{{route('cart.add.photo')}}" method="POST" id="formAddPhotoToCart">@csrf<input type="hidden" name="album" value="{{$album->id}}"><input type="hidden" name="reference" value="{{$photo->id}}"><button onclick="showLoadModal(this)" class="btn btn-success btn-sm" type="submit">Añadir al carrito</button><span class="font-weight-bold align-middle ml-3 color-1" style="font-size: 1.8rem">S/. <small class="font-weight-bold">{{config('app.price_per_photo')}}</small></span></form>'>

                                <img class="w-100 h-100 rounded" src="{{asset('storage/albums_photos/'.$photo->modified_image)}}" style="object-fit: cover;">
                            </a>
                            @can('album_owner', $album)

                                <a onclick="addOrRemoveBestPhoto({{$photo->id}})" title="Añadir a mejores fotos" style="cursor: copy;"><i id="star-{{$photo->id}}" class="fa fa-star {{$photo->best ? 'text-warning' : 'text-white'}}" style="position: absolute; top: 10px; right: 22px; font-size: 1.3rem"></i></a>

                                <form action="{{route('photos.delete', [$album->id, $photo->id])}}" method="POST" id="formDelete">
                                    @method("DELETE")
                                    @csrf

                                    <button class="btn btn-link" data-toggle="confirm" data-title="Eliminar foto" data-message="¿Estas seguro?" data-type="danger">Eliminar</button>
                                </form>
                            @endcan
                            @cannot('album_owner', $album)
                                @if($photo->best)
                                    <i id="star-{{$photo->id}}" class="fa fa-star text-warning" style="position: absolute; top: 10px; right: 22px; font-size: 1.3rem"></i>
                                @endif
                                <div class="text-right">
                                    <span class="font-weight-bold align-middle text-right color-1" style="font-size: 1.2rem">S/. <small class="font-weight-bold">{{config('app.price_per_photo')}}</small></span>
                                </div>
                            @endcannot
                        </div>
                    @empty
                        <div class="my-4 text-center mx-auto">
                            <h4 class="text-warning">El álbum esta vacio.</h4>
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
                            <div class="modal-footer d-block py-0 w-100">
                                @cannot('album_owner', $album)
                                    <div id="modal-gallery-footer" class="text-right m-0">
                                    </div>
                                @endcannot
                                <div id="loader-cart" class="loader text-center d-none" align="center">
                                    <img id="espera_icon" align="center" src="{{ asset('icons/blocks.svg')}}" style="max-width: 60px; width: 100%;"/>
                                </div>
                                <div id="cart-result">
                                </div>
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
    <script src="{{ asset('js/scripts.js') }}"></script>
    <script src="{{ asset('js/bootstrap-filestyle.min.js') }}"></script>
    <script src="{{ asset('js/gallery.js')}}"></script>
    <script src="{{ asset('js/bootstrap.confirm.js') }}"></script>
    <script>
        function addOrRemoveBestPhoto(photoReference) {

            $.ajax({
                type: "POST",
                url: "{{route('photos.add.best')}}",
                data: {
                    _token: "{{ csrf_token() }}",
                    photo: photoReference,
                    album: "{{ $album->id }}"
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
                            break;
                        default:
                            break;
                    }
                }
            });
        }

        function addToCart(reference) {
            $("#cart-button-container").addClass('d-none');
            $("#loader-cart").removeClass('d-none');

            $.ajax({
                type: "POST",
                url: "{{route('cart.add.photo')}}",
                data: {
                    _token: "{{ csrf_token() }}",
                    reference: reference,
                    album: "{{ $album->id }}"
                },
                dataType: 'JSON',
                success: function (response) {
                    switch (response.status) {
                        case 0:
                            $("#loader-cart").addClass('d-none');
                            $("#cart-result").html('<p class="text-success mb-0">Añadido al <a href="{{ route("cart") }}">carrito</a></p>');
                            break;
                        case 1:
                            $("#loader-cart").addClass('d-none');
                            $("#cart-result").html('<p class="text-success mb-0">Foto en el <a href="{{ route("cart") }}">carrito</a></p>');
                            break;
                        case 2:
                            $("#loader-cart").addClass('d-none');
                            $("#cart-result").html('<p class="text-danger mb-0">Foto no disponible</p>');
                            break;
                        default:
                            $("#loader-cart").addClass('d-none');
                            $("#cart-result").html('<p class="text-danger mb-0">Ha ocurrido un error, recargue la pagina y vuelva a intentar mas tarde.</p>');
                            break;
                    }
                }
            });
        }

        function addAlbumToCart(reference) {
            console.log("albumId: "+reference);
            $.ajax({
                type: "POST",
                url: "{{route('cart.add.album')}}",
                data: {
                    _token: "{{ csrf_token() }}",
                    album: reference
                },
                success: function (response) {
                    switch (response.status) {
                        case 0:
                            $("#loader-cart").addClass('d-none');
                            $("#cart-result").html('<p class="text-success mb-0">Añadido al <a href="{{ route("cart") }}">carrito</a></p>');
                            break;
                        case 1:
                            $("#loader-cart").addClass('d-none');
                            $("#cart-result").html('<p class="text-success mb-0">Foto en el <a href="{{ route("cart") }}">carrito</a></p>');
                            break;
                        case 2:
                            $("#loader-cart").addClass('d-none');
                            $("#cart-result").html('<p class="text-danger mb-0">Foto no disponible</p>');
                            break;
                        default:
                            $("#loader-cart").addClass('d-none');
                            $("#cart-result").html('<p class="text-danger mb-0">Ha ocurrido un error, recargue la pagina y vuelva a intentar mas tarde.</p>');
                            break;
                    }
                }
            });
        }

        function showLoad (elementToHide, loaderId) {
            $(elementToHide).addClass('d-none');
            $("#"+loaderId).removeClass('d-none');
        }
        function showLoadModal (elementToHide) {
            $(elementToHide).addClass('d-none');
            $(elementToHide).siblings().addClass('d-none');
            $("#loader-cart").removeClass('d-none');
        }
    </script>
@endsection
