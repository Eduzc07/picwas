@extends('layouts.master')

@section('title', 'Carrito de compra')

@section('content')

@include("layouts.navbar")

<div class="container-fluid mt-3 px-md-5">
    <div class="row">
        <div class="col-12 py-3">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <h1 class="color-1">Carrito de Compras</h1>

                        <hr class="bg-color-1" style="height: 1px">

                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show text-left my-3" role="alert">
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
                            <div class="alert alert-success alert-dismissible fade show text-left my-3" role="alert">
                                <h6>{{ session()->get('success') }}</h6>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        @if($cart)
                            <div class="clearfix">
                                <div class="float-md-left text-left">
                                    <p><b class="color-1">Artículos: </b>{{$cart->items}}</p>
                                    <!-- <p><b class="color-1">Total: </b>{{$cart->items * config('app.price_per_photo')}}.00 {{config('app.currency')}}</p> -->
                                    <p><b class="color-1">Total: </b>S/. {{number_format((float)$cart->total, 2, '.', '')}}</p>
                                    <p><a href="{{ route('cart.empty.cart', [$cart->id]) }}" class="btn btn-link" data-toggle="confirm" data-title="Vaciar el carrito" data-message="¿Estas seguro?" data-type="danger">Vaciar carrito</a></p>
                                </div>

                                <hr class="d-md-none">

                                <div class="float-md-right text-center">
                                    <p class="text-center">
                                        <img src="https://www.mercadopago.com/org-img/Manual/ManualMP/imgs/isologoVertical.png" alt="Mercadopago" class="img-fluid" style="max-width: 90px" />
                                    </p>

                                    <a href="{{$initPoint}}" class="btn btn-success text-white font-weight-bold">
                                        Pagar<br/>
                                        <!-- <span class="badge badge-light">{{$cart->items * config('app.price_per_photo')}}.00 {{config('app.currency')}}</span> -->
                                        <span class="badge badge-light">{{number_format((float)$cart->total, 2, '.', '')}} {{config('app.currency')}}</span>
                                    </a>

                                    <p class="text-center m-1">
                                        <img src="https://www.mercadopago.com/org-img/MP3/API/logos/visa.gif" alt="VISA" title="VISA" class="img-fluid" />
                                        <img src="https://www.mercadopago.com/org-img/MP3/API/logos/1060.gif" alt="Mercadopago" title="Mercadopago" class="img-fluid" />
                                        <img src="https://www.mercadopago.com/org-img/MP3/API/logos/amex.gif" alt="American Express" title="American Express" class="img-fluid" />
                                        <img src="https://www.mercadopago.com/org-img/MP3/API/logos/master.gif" alt="Mastercard" title="Mastercard" class="img-fluid" />
                                    </p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                @if($cartDetail)
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">Foto</th>
                                            <th scope="col" class="text-center">Monto</th>
                                            <th scope="col" class="text-right">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($cartDetail as $detail)
                                            <tr>
                                                <td class="align-middle">
                                                    <a href="{{ route('albums.show', [$detail->album_id]) }}" title="Ver álbum">
                                                        <img class="img-fluid rounded" src="{{asset('storage/albums_photos/'.App\Photo::findOrFail($detail->photo_id)->modified_image)}}" style="object-fit: cover; width: 160px; height: 160px">
                                                    </a>
                                                </td>
                                                <!-- <td class="text-center align-middle">{{config('app.price_per_photo')}} {{config('app.currency')}}</td> -->
                                                <td class="text-center align-middle" style="font-size: 1.6rem;">S/. {{number_format((float)(App\Photo::findOrFail($detail->photo_id)->price), 2, '.', '')}}</td>
                                                <td class="text-right align-middle">
                                                    <a href="{{ route('albums.show', [$detail->album_id]) }}" title="Ver álbum" class="btn btn-link">Ver álbum</a><br>
                                                    <a href="{{ route('cart.remove.photo', [$detail->id]) }}" class="btn btn-link" data-toggle="confirm" data-title="Eliminar del carrito" data-message="¿Estas seguro?" data-type="danger">Eliminar</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="justify-content-center mt-3">{{$cartDetail->onEachSide(3)->links()}}</div>

                @else
                    <div class="my-4 text-center mx-auto">
                        <h4 class="text-warning">El carrito esta vacio.</h4>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('loadScripts')
    <script src="{{ asset('js/bootstrap.confirm.js') }}"></script>
@endsection
