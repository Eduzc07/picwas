@extends('layouts.master')

@section('title', '!Gracias por registrarte¡')

@section('content')

@include("layouts.navbar")

<div class="container-fluid mt-3 px-md-5">
    <div class="row">
        <div class="col-12 col-md-12">
            <div class="mx-auto mx-md-4 mx-xl-5 profile-photo-border rounded-circle bg-white">
                <div class="mx-md-0 mx-auto border profile-photo-img rounded-circle" style="background-image: url({{ asset('test/girl_profile_photo.jpg') }});">
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
                    <p><h2>Sofía Ramos</h2></p>
                    <p></span><h6><span class="flag-icon flag-icon-pe rounded"></span> Lima, Perú</h6></p>
                    <hr>
                    <p>“Creo que la fotografía nunca cambia, aún si la persona lo hace</p>
                </div>

                <div class="col-12 pl-lg-0">
                    <button type="submit" class="btn button-style-2 text-white font-weight-bold px-3" style="font-size: 1.2rem;">Editar mejores fotos</button>
                    <hr>
                </div>
            </div>
        </div>
        
        <div class="col-12 col-md-8 col-lg-9 py-3 px-1">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-md-6 text-center text-md-left">
                        <h4 class="pt-2">Álbumes</h4>
                    </div>
                    <div class="col-12 col-md-6 text-center text-md-right">
                        <button type="submit" class="btn btn-sm button-style-2 text-white font-weight-bold px-3 py-1" style="font-size: 1.2rem;">Crear nuevo Álbum</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 my-3 text-center">
                        <a class="thumbnail text-decoration-none text-dark" href="#" data-image-id="" data-toggle="modal" data-title="" data-image="https://loremflickr.com/800/600/girl" data-target="#image-gallery">
                            <img class="w-100 h-100 rounded" src="https://loremflickr.com/800/600/girl" alt="Another alt text" style="object-fit: cover;">
                            <h5>Titulo Album #1</h5>
                        </a>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 my-3 text-center">
                        <a class="thumbnail text-decoration-none text-dark" href="#" data-image-id="" data-toggle="modal" data-title="" data-image="https://loremflickr.com/1200/700/girl" data-target="#image-gallery">
                            <img class="w-100 h-100 rounded" src="https://loremflickr.com/1200/700/girl" alt="Another alt text" style="object-fit: cover;">
                            <h5>Titulo Album #2</h5>
                        </a>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 my-3 text-center">
                        <a class="thumbnail text-decoration-none text-dark" href="#" data-image-id="" data-toggle="modal" data-title="" data-image="https://loremflickr.com/1200/900/girl" data-target="#image-gallery">
                            <img class="w-100 h-100 rounded" src="https://loremflickr.com/1200/900/girl" alt="Another alt text" style="object-fit: cover;">
                            <h5>Titulo Album #3</h5>
                        </a>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 my-3 text-center">
                        <a class="thumbnail text-decoration-none text-dark" href="#" data-image-id="" data-toggle="modal" data-title="Test1" data-image="https://loremflickr.com/800/700/girl" data-target="#image-gallery">
                            <img class="w-100 h-100 rounded" src="https://loremflickr.com/800/700/girl" alt="Another alt text" style="object-fit: cover;">
                            <h5>Titulo Album #4</h5>
                        </a>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 my-3 text-center">
                        <a class="thumbnail text-decoration-none text-dark" href="#" data-image-id="" data-toggle="modal" data-title="Im so nice" data-image="https://loremflickr.com/900/700/girl" data-target="#image-gallery">
                            <img class="w-100 h-100 rounded" src="https://loremflickr.com/900/700/girl" alt="Another alt text" style="object-fit: cover;">
                            <h5>Titulo Album #5</h5>
                        </a>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 my-3 text-center">
                        <a class="thumbnail text-decoration-none text-dark" href="#" data-image-id="" data-toggle="modal" data-title="Im so nice" data-image="https://loremflickr.com/1300/900/girl" data-target="#image-gallery">
                            <img class="w-100 h-100 rounded" src="https://loremflickr.com/1300/900/girl" alt="Another alt text" style="object-fit: cover;">
                            <h5>Titulo Album #6</h5>
                        </a>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 my-3 text-center">
                        <a class="thumbnail text-decoration-none text-dark" href="#" data-image-id="" data-toggle="modal" data-title="Im so nice" data-image="https://loremflickr.com/800/800/girl" data-target="#image-gallery">
                            <img class="w-100 h-100 rounded" src="https://loremflickr.com/800/800/girl" alt="Another alt text" style="object-fit: cover;">
                            <h5>Titulo Album #7</h5>
                        </a>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 my-3 text-center">
                        <a class="thumbnail text-decoration-none text-dark" href="#" data-image-id="" data-toggle="modal" data-title="Im so nice" data-image="https://loremflickr.com/900/900/girl" data-target="#image-gallery">
                            <img class="w-100 h-100 rounded" src="https://loremflickr.com/900/900/girl" alt="Another alt text" style="object-fit: cover;">
                            <h5>Titulo Album #8</h5>
                        </a>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 my-3 text-center">
                        <a class="thumbnail text-decoration-none text-dark" href="#" data-image-id="" data-toggle="modal" data-title="Im so nice" data-image="https://loremflickr.com/1200/1000/girl" data-target="#image-gallery">
                            <img class="w-100 h-100 rounded" src="https://loremflickr.com/1200/1000/girl" alt="Another alt text" style="object-fit: cover;">
                            <h5>Titulo Album #9</h5>
                        </a>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 my-3 text-center">
                        <a class="thumbnail text-decoration-none text-dark" href="#" data-image-id="" data-toggle="modal" data-title="Im so nice" data-image="https://loremflickr.com/1400/600/girl" data-target="#image-gallery">
                            <img class="w-100 h-100 rounded" src="https://loremflickr.com/1400/600/girl" alt="Another alt text" style="object-fit: cover;">
                            <h5>Titulo Album #10</h5>
                        </a>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 my-3 text-center">
                        <a class="thumbnail text-decoration-none text-dark" href="#" data-image-id="" data-toggle="modal" data-title="Im so nice" data-image="https://loremflickr.com/1100/700/girl" data-target="#image-gallery">
                            <img class="w-100 h-100 rounded" src="https://loremflickr.com/1100/700/girl" alt="Another alt text" style="object-fit: cover;">
                            <h5>Titulo Album #11</h5>
                        </a>
                    </div>
                </div>
        
        
                <div class="modal fade" id="image-gallery" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="image-gallery-title"></h4>
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <img id="image-gallery-image" class="img-responsive col-md-12" src="">
                            </div>
                            <div class="modal-footer d-block">
                                <button type="button" class="btn btn-secondary float-left" id="show-previous-image"><i class="fa fa-arrow-left"></i>
                                </button>
        
                                <button type="button" id="show-next-image" class="btn btn-secondary float-right"><i class="fa fa-arrow-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('loadScripts')
<script src="{{ asset('js/gallery.js')}}"></script>
@endsection
