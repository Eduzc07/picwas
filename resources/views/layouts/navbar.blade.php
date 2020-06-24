@php
    $items = 0;
    $items = Illuminate\Support\Facades\DB::table('cart')->where('user_id', Auth::user()->id)->first();
    if ($items != null) {
        $items = $items->items;
    } else {
        $items = 0;
    }
@endphp

<nav class="navbar navbar-expand-sm navbar-dark bg-transparent text-white bg-img-navbar" style="background-image: url(@yield("navbarImg", asset('img/photographer_header.jpg')));">
    <a class="navbar-brand pt-0 d-md-none" href="{{route('user', [Auth::user()->username])}}"><img src="@yield("navbarBrandImg", asset('img/logo_white_dark_shadow.png'))" alt="" class="img-fluid" style="max-height: 52px"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContentCollapseTopMenu" aria-controls="navbarContentCollapseTopMenu" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fa fa-bars text-white" style="font-size:28px;"></i>
    </button>
    <div class="collapse navbar-collapse" id="navbarContentCollapseTopMenu">
        <ul class="navbar-nav mt-2 mt-lg-0 ml-auto">
            <li class="nav-item my-auto">
                <form action="{{route('search')}}" method="POST" role="search">
                    @csrf
                    <div class="input-group inside-btn">
                        <input type="search" name="search" class="form-control rounded text-secondary" id="search-field" placeholder="Buscar" aria-describedby="search-field-button" style="padding-right: 52px;">
                        <div class="input-group-prepend">
                            <button type="submit" class="btn btn-sm border-left" id="search-field-button"><li class="fa fa-search text-black-50" style="font-size: 1.6rem"></li></button>
                        </div>
                    </div>
                </form>
            </li>
          
            <li class="nav-item">
                <a href="{{route('search.photographer')}}" class="btn p-0 m-0 w-100 text-left" title="Fotógrafos" alt="Fotógrafos">
                    <i class="icon-friends text-white p-2" style="font-size: 2rem"></i><h4 class="d-inline-block d-sm-none navbar-text">Fotógrafos</h4>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('user.edit', [Auth::user()->username])}}" class="btn p-0 m-0 w-100 text-left" title="Configuración" alt="Configuración">
                    <i class="icon-gear text-white p-2" style="font-size: 2rem"></i><h4 class="d-inline-block d-sm-none navbar-text">Configuración</h4>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('cart')}}" class="btn p-0 m-0 w-100 text-left" title="Carrito de compra" alt="Carrito de compra">
                    <i class="fa fa-shopping-cart text-white pl-2 py-2 pr-0" style="font-size: 2rem"></i>
                    <span class="badge badge-danger" style="font-size:9px; position:relative; top: -18px; left: -10px;">{{ $items }}</span>
                    <h4 class="d-inline-block d-sm-none navbar-text">Carrito de compra</h4>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('logout') }}" title="Cerrar sesión" alt="Cerrar sesión" class="btn p-0 m-0 w-100 text-left"
                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                    <i class="fa fa-sign-out text-white pr-2 py-2 pl-0" style="font-size: 2rem"></i><h4 class="d-inline-block d-sm-none navbar-text">Salir</h4>
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>

        </ul>
    </div>
</nav>

<div class="bg-red-opacity-50 w-100 h-100 rounded-circle d-none d-md-block" style="top: -32px; left: 32px; max-width: 168px; max-height: 168px; position: absolute;">
    <div class="row h-100 p-3">
        <a class="p-3 align-self-center" href="{{route('user', [Auth::user()->username])}}"><img class="img-fluid align-self-center" src="{{ asset('img/logo_white_dark_shadow.png') }}" alt=""></a>
    </div>
</div>
