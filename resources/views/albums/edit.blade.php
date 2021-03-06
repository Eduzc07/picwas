@extends('layouts.master')

@section('title', 'Editar álbum')

@section('content')

@include("layouts.navbar")

<div class="container-fluid mt-3 px-md-5">
    <div class="row">
        <div class="col-12 col-md-4 col-lg-3 text-center">
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
            <div class="row mx-auto mx-lg-0" style="max-width: 300px">
                <div class="col-12 pl-lg-0">
                    <p>
                      <h2>{{ Auth::user()->first_name}} <br>
                          {{ Auth::user()->last_name}}
                      </h2>
                    </p>
                    <p><h5 class="text-break">{{ "@".Auth::user()->username }}</h5></p>
                    <p><h6><span class="flag-icon flag-icon-{{strtolower(App\Country::find(Auth::user()->country_id)->alpha_2_code)}} rounded"></span> {{App\Country::find(Auth::user()->country_id)->name}}</h6></p>
                    <hr>
                    <p>{{Auth::user()->description}}</p>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-8 col-lg-9 py-3 px-1">
            <div class="container">
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
                        <h6>{{ session()->get('success') }}</h6>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <form id="formEditAlbum" method="POST" action="{{ route('albums.update', [$album->id]) }}" class="px-5" enctype="multipart/form-data" onsubmit="preventMultipleSubmitForm(this, '{{ asset('icons/blocks.svg')}}', 'left')">
                    @method('PUT')
                    @csrf

                    <div class="row mb-3">
                        <div class="col-12">
                            <h3 class="border-bottom border-color-1 border-width-2 pb-1">Editar álbum</h3>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="album_name" class="col-sm-4 col-form-label">Nombre de álbum</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control color-1 form-control-sm" id="album_name" name="album_name" value="@if ($errors->any() && old('album_name') !== null){{old('album_name')}}@else{{$album->name}}@endif">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-12 text-center">
                            <img id="output" src="{{ asset('/storage/albums/'.$album->cover_photo) }}" alt="" class="img-fluid my-3" style="max-width:180px; min-width: 100px;">
                        </div>
                        <label for="album_cover" class="col-sm-4 col-form-label">Portada de álbum</label>
                        <div class="col-sm-8">
                            <input type="file" id="album_cover" name="album_cover" class="filestyle color-1" data-text="Seleccionar portada" data-btnClass="btn-secondary text-white rounded-0" data-buttonBefore="true" data-size="sm" data-dragdrop="false" onchange="loadFunction(event)">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="topic" class="col-sm-4 col-form-label">Tema</label>
                        <div class="col-sm-8">
                            <select name="topic" id="topic" class="form-control form-control-sm color-1 bg-color-2">
                                <option value="Deporte" @if ($errors->any() && old('topic') !== null){{old('topic') == "Deporte"?'selected':''}}@else{{$album->category == 'Deporte' ? 'selected':''}}@endif>Deporte</option>
                                <option value="Danzas" @if ($errors->any() && old('topic') !== null){{old('topic') == "Danzas"?'selected':''}}@else{{$album->category == 'Danzas' ? 'selected':''}}@endif>Danzas</option>
                                <option value="Lugares Turísticos" @if ($errors->any() && old('topic') !== null){{old('topic') == "Lugares Turísticos"?'selected':''}}@else{{$album->category == 'Lugares Turísticos' ? 'selected':''}}@endif>Lugares Turísticos</option>
                                <option value="Otros" @if ($errors->any() && old('topic') !== null){{old('topic') == "Otros"?'selected':''}}@else{{$album->category == 'Otros' ? 'selected':''}}@endif>Otros</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="place" class="col-sm-4 col-form-label">Lugar</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control color-1 form-control-sm" id="place" name="place" value="@if ($errors->any() && old('place') !== null){{old('place')}}@else{{$album->place}}@endif">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="place" class="col-sm-4 col-form-label">Precio base por foto</label>
                        <div class="col-sm-8">
                            <label for="place" class="col-form-label color-1">S/. {{number_format((float)$album->price, 2, '.', '')}}</label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="description" class="col-12 col-form-label">Descripción</label>
                        <div class="col-12">
                            <textarea class="form-control color-1" rows="8" resizable="false" style="resize: none;" name="description">@if ($errors->any() && old('description') !== null){{old('description')}}@else{{$album->description}}@endif</textarea>
                        </div>
                    </div>

                    <div class="w-100"></div>
                    <div class="form-group row">
                        <div class="col-12">
                            <button type="submit" class="btn button-style-1 text-white">Guardar álbum</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('loadScripts')
    <script src="{{ asset('js/scripts.js') }}"></script>
    <script src="{{ asset('js/bootstrap-filestyle.min.js') }}"></script>
    <script>
        $(function () {
            var hash = window.location.hash;
            $(hash).click();
        });

        function loadFunction(event) {
          var out = document.getElementById("output");
          out.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>
@endsection
