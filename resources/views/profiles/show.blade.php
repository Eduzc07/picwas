@extends('layouts.master')

@section('title', $user->username)

@section('content')

@include("layouts.navbar")

<div class="container-fluid mt-3 px-md-5">
    <div class="row">
        <div class="col-12 col-md-12">
            <div class="mx-auto mx-md-4 mx-xl-5 profile-photo-border rounded-circle bg-white">
                <div class="mx-md-0 mx-auto border profile-photo-img rounded-circle" style="background-image: url({{ asset('/storage/avatars/'.$user->avatar) }});">
                    @can('is_photographer', $user)
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
                    <p><h2>{{ $user->first_name . " " . $user->last_name}}</h2></p>
                    <p><h5 class="text-break">{{ "@".$user->username }}</h5></p>
                    <p></span><h6><span class="flag-icon flag-icon-{{strtolower(App\Country::find($user->country_id)->alpha_2_code)}} rounded"></span> {{App\Country::find($user->country_id)->name}}</h6></p>
                    <hr>
                    <p>{{$user->description}}</p>
                </div>

                @can('edit', $user)
                    <div class="col-12 pl-lg-0">
                        <a href="{{route('user.edit', [Auth::user()->username])}}" class="btn button-style-2 text-white font-weight-bold px-3" style="font-size: 1.2rem;">Editar perfil</a>
                        <hr>

                        @can('is_photographer')
                            <a href="{{route('photos.best')}}" class="btn button-style-2 text-white font-weight-bold px-3" style="font-size: 1.2rem;">Mis mejores fotos</a>
                            <br>
                            <br>
                        @endcan

                        @can('is_photographer')
                            <a href="{{route('photos.purchased')}}" class="btn button-style-2 text-white font-weight-bold px-3" style="font-size: 1.2rem;">Mis fotos compradas</a>
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

                <div class="row mb-3">
                    <div class="col-12 col-md-6 text-center text-md-left">
                        <h4 class="pt-2">
                            @can('is_photographer', $user)
                                Álbumes
                            @else
                                Fotos guardadas
                            @endcan
                        </h4>
                    </div>
                    @can('edit', $user)
                        @can('is_photographer')
                            <div class="col-12 col-md-6 text-center text-md-right">
                                <a href="{{route('albums.create')}}" class="btn btn-sm button-style-2 text-white font-weight-bold px-3 py-1" style="font-size: 1.2rem;">Crear nuevo Álbum</a>
                            </div>
                        @endcan
                        @can('is_customer')
                            <div class="col-12 col-md-6 text-center text-md-right">
                                <form action="{{route('search')}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="search" value="">
                                    <button type="submit" class="btn btn-sm button-style-2 text-white font-weight-bold px-5 py-1" style="font-size: 1.2rem;">Buscar fotos</button>
                                </form>
                            </div>
                        @endcan
                    @endcan
                </div>

                <div class="row">
                    @can('is_photographer', $user)
                        @forelse($albums as $album)
                            <div class="col-12 col-sm-6 col-md-4 mb-3">
                                <div class="card h-100 border-0">
                                    <a href="{{ route('albums.show', [$album->id]) }}" title="Ver álbum">
                                        <img src="{{asset('/storage/albums/'.$album->cover_photo)}}" class="card-img-top card-header p-0" style="height: 200px; object-fit: cover">
                                    </a>
                                    <div class="card-body py-3 px-1">
                                        <h5 class="card-title"><a href="{{ route('albums.show', [$album->id]) }}" title="Ver álbum">{{$album->name}}</a></h5>
                                        @if (strlen($album->description) > 100)
                                            <p class="card-text text-muted">
                                                {{substr($album->description, 0, 100)}}<span class="collapse" id="viewFullDescription{{$album->id}}">{{substr($album->description, 100, strlen($album->description))}}</span>
                                                <a data-toggle="collapse" data-target="#viewFullDescription{{$album->id}}" href="#viewFullDescription{{$album->id}}"> Ver mas... &raquo;</a>
                                            </p>
                                        @else
                                            <p class="card-text text-muted">
                                                {{$album->description}}
                                            </p>
                                        @endif
                                    </div>
                                    @if($album->publication_time <= date('Y-m-d'))
                                        @can('album_owner', $album)
                                            <div class="card-footer">
                                                <p class="text-danger my-auto">No disponible desde {{date('d-m-Y', strtotime($album->publication_time))}}</p>
                                            </div>
                                        @endcan
                                    @endif
                                </div>
                            </div>
                            @empty
                                <div class="my-4 text-center mx-auto">
                                    <h4 class="text-warning">No existen álbumes.</h4>
                                </div>
                        @endforelse
                    @endcan
                </div>
                <div class="justify-content-center my-4">{{ $albums->onEachSide(3)->links() }}</div>
            </div>
        </div>
    </div>
</div>
@endsection
