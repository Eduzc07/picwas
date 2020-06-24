@extends('layouts.master')

@section('title', 'Mis álbumes')

@section('content')

@include("layouts.navbar")

<div class="container-fluid mt-3 px-md-5">
    <div class="row">
        <div class="col-12 col-md-12">
            <div class="mx-auto mx-md-4 mx-xl-5 profile-photo-border rounded-circle bg-white">
                <div class="mx-md-0 mx-auto border profile-photo-img rounded-circle" style="background-image: url({{ asset('/storage/avatars/'.Auth::user()->avatar) }});">
                    <div class="rounded-circle profile-photo-inside-container">
                        <img src="{{ asset('icons/icon_escudo_fotografos_2.png') }}" alt="" class="rounded-circle p-0 border-0 img-thumbnail">
                    </div>
                </div>
            </div>
        </div>
        <div class="w-100"></div>

        <div class="col-12 col-md-4 col-lg-3 text-center">
            <div class="row mx-auto mx-lg-0" style="max-width: 300px">
                <div class="col-12 pl-lg-0">
                    <p><h2>{{ Auth::user()->first_name . " " . Auth::user()->last_name}}</h2></p>
                    <p><h5 class="text-break">{{ "@".Auth::user()->username }}</h5></p>
                    <p><h6><span class="flag-icon flag-icon-{{strtolower(App\Country::find(Auth::user()->country_id)->alpha_2_code)}} rounded"></span> {{App\Country::find(Auth::user()->country_id)->name}}</h6></p>
                    <hr>
                    <p>{{Auth::user()->description}}</p>
                </div>

                <div class="col-12 pl-lg-0">
                    <button type="submit" class="btn button-style-2 text-white font-weight-bold px-3" style="font-size: 1.2rem;">Mis mejores fotos</button>
                    <hr>
                </div>
            </div>
        </div>
        
        <div class="col-12 col-md-8 col-lg-9 py-3 px-1">
            <div class="container">
                <div class="row mb-3">
                    <div class="col-12">
                        <h3 class="border-bottom border-color-1 border-width-2 pb-1">Mis álbumes</h3>
                    </div>
                </div>

                <div class="row">
                    @foreach($albums as $album)
                        <div class="col-12 col-sm-6 col-md-4 mb-3">
                            <div class="card h-100">
                                <a href="{{ route('albums.show', [$album->id]) }}" title="Ver álbum">
                                    <img src="{{asset('/storage/albums/'.$album->cover_photo)}}" class="card-img-top card-header p-0" style="height: 200px; object-fit: scale-down">
                                </a>
                                <div class="card-body p-3">
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
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
