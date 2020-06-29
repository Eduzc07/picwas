@extends('layouts.master')

@section('title', 'Configuración de la cuenta')

@section('content')

@include("layouts.navbar")

<div class="container">
    <div class="row mt-4">
        <div class="col-12 mx-auto">
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
        </div>
        <div class="col-3">
            <div class="nav flex-column nav-pills pt-4" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="icon-gear text-right bg-color-1-active ml-auto p-2 color-2 side-pills-tab-icon text-decoration-none active" id="general" data-toggle="pill" href="#v-pills-general" role="tab" aria-controls="v-pills-general" aria-selected="true" title="Configuración general"></a>

                <a class="icon-padlock text-right bg-color-1-active ml-auto p-2 color-2 side-pills-tab-icon text-decoration-none" id="securityAndPrivacy" data-toggle="pill" href="#v-pills-security-and-privacy" role="tab" aria-controls="v-pills-security-and-privacy" aria-selected="false" title="Seguridad y Privacidad"></a>

                <!-- <a class="icon-lens text-right bg-color-1-active ml-auto p-2 color-2 side-pills-tab-icon text-decoration-none" id="profile" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false" title="Perfil"></a> -->

                <a class="icon-cards text-right bg-color-1-active ml-auto p-2 color-2 side-pills-tab-icon text-decoration-none" id="finance" data-toggle="pill" href="#v-pills-finance" role="tab" aria-controls="v-pills-finance" aria-selected="false" title="Finanzas"></a>
            </div>
        </div>

        <div class="col-9">
            <div class="tab-content" id="v-pills-tabContent">
                <div class="tab-pane fade show active" id="v-pills-general" role="tabpanel" aria-labelledby="v-pills-general-tab">
                    <h5 class="border-bottom border-color-1 border-width-2 pb-1">Configuración general de la cuenta</h5>
                    <div class="bg-color-2 p-3 border">
                        <form id="formGeneralSettings" method="POST" action="{{ route('user.update.general') }}" enctype="multipart/form-data" onsubmit="preventMultipleSubmitForm(this, '{{ asset('icons/blocks.svg')}}', 'left')">
                        <!-- <form id="formProfileSettings" method="POST" action="{{ route('user.update.profile') }}" enctype="multipart/form-data" onsubmit="preventMultipleSubmitForm(this, '{{ asset('icons/blocks.svg')}}', 'left')"> -->
                            @method('PUT')
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <small class="form-text text-muted"><i>Click en cualquier campo para editar y luego pulsa en guardar</i></small>
                                </div>
                            </div>
                            <div class="row">
                              <div class="col-7 justify-content-center align-self-center">
                                <div class="form-group row">
                                    <label for="firstname" class="col-sm-3 col-form-label">Nombre:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control color-1 bg-color-2 border-0" id="firstname" name="firstname" value="@if ($errors->any() && old('firstname') !== null){{old('firstname')}}@else{{Auth::user()->first_name}}@endif">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="lastname" class="col-sm-3 col-form-label">Apellido:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control color-1 bg-color-2 border-0" id="lastname" name="lastname" value="@if ($errors->any() && old('lastname') !== null){{old('lastname')}}@else{{Auth::user()->last_name}}@endif">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="username" class="col-sm-3 col-form-label">Usuario:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control color-1 bg-color-2 border-0" id="username" name="username" value="@if ($errors->any() && old('username') !== null){{old('username')}}@else{{Auth::user()->username}}@endif">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email" class="col-sm-3 col-form-label">E-mail:</label>
                                    <div class="col-sm-9">
                                        <input type="email" class="form-control color-1 bg-color-2 border-0" id="email" name="email" value="@if ($errors->any() && old('email') !== null){{old('email')}}@else{{Auth::user()->email}}@endif">
                                    </div>
                                </div>
                              </div>
                              <div class="col-5">
                                <div class="float">
                                    <div class="d-flex justify-content-center" style="overflow:hidden;">
                                        <img id="output" src="{{ asset('/storage/avatars/'.Auth::user()->avatar) }}" alt="" class="my-3 border" height="220px">
                                    </div>
                                    <div class="col">
                                        <input type="file" id="profile_photo" name="profile_photo" class="filestyle color-1 d-none " data-text="Cambiar Foto" data-btnClass="btn-secondary text-white rounded-0" data-buttonBefore="true" data-size="sm" data-dragdrop="false" onchange="loadFunction(event)">
                                    </div>
                                </div>
                              </div>
                            </div>

                            <div class="form-group row">
                                <label for="description" class="col-sm-8 col-form-label">Descripción:</label>
                                <div class="col-12">
                                    <textarea class="form-control color-1" id="description" name="description" rows="8" resizable="false" style="resize: none;" >@if ($errors->any() && old('description') !== null){{old('description')}}@else{{Auth::user()->description}}@endif</textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-12">
                                    <button type="submit" class="btn button-style-1 text-white">Guardar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="tab-pane fade" id="v-pills-security-and-privacy" role="tabpanel" aria-labelledby="v-pills-security-and-privacy-tab">
                    <h5 class="border-bottom border-color-1 border-width-2 pb-1">Seguridad y Privacidad</h5>
                    <div class="bg-color-2 p-3 border">
                        <form id="formSecurityAndPrivacy" method="POST" action="{{ route('user.update.security') }}" onsubmit="preventMultipleSubmitForm(this, '{{ asset('icons/blocks.svg')}}', 'left')">
                            @method('PUT')
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <small class="form-text text-muted"><i>Click en cualquier campo para editar y luego pulsa en guardar</i></small>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-sm-8 col-form-label">Nueva contraseña (opcional):</label>
                                <div class="col-sm-4">
                                    <input type="password" class="form-control color-1 bg-color-2 border-0" id="password" name="password" value="" placeholder="***************">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-sm-8 col-form-label">Confirma la nueva contraseña (opcional):</label>
                                <div class="col-sm-4">
                                    <input type="password" class="form-control color-1 bg-color-2 border-0" id="password_confirmation" name="password_confirmation" value="" placeholder="***************">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="sign_in_alert" class="col-sm-8 col-form-label">Recibir alerta sobre inicio de sesion sospechosa:</label>
                                <div class="col-sm-4">
                                    <select class="form-control color-1 bg-color-2 border-0" name="sign_in_alert" id="sign_in_alert">
                                        <option value="1" @if(Auth::user()->sign_in_alert) selected @endif>activado</option>
                                        <option value="0" @if(!Auth::user()->sign_in_alert) selected @endif>desactivado</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-12">
                                    <button type="submit" class="btn button-style-1 text-white">Guardar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                    <h5 class="border-bottom border-color-1 border-width-2 pb-1">Mi perfil</h5>
                    <div class="bg-color-2 p-3 border">
                        <form id="formProfileSettings" method="POST" action="{{ route('user.update.profile') }}" enctype="multipart/form-data" onsubmit="preventMultipleSubmitForm(this, '{{ asset('icons/blocks.svg')}}', 'left')">
                            @method('PUT')
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <small class="form-text text-muted"><i>Click en cualquier campo para editar y luego pulsa en guardar</i></small>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-12 col-md-3">
                                    <img src="{{ asset('/storage/avatars/'.Auth::user()->avatar) }}" alt="" class="w-100 my-3 border" style="max-width:180px; min-width: 100px;">
                                </div>
                                <div class="col-12 col-md-9 pt-3">
                                    <label for="profile_photo" class="">Foto de perfil</label>
                                    <input type="file" id="profile_photo" name="profile_photo" class="filestyle color-1 d-none" data-text="Seleccionar foto de perfil" data-btnClass="btn-secondary text-white rounded-0" data-buttonBefore="true" data-size="sm" data-dragdrop="false">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="description" class="col-sm-8 col-form-label">Descripción:</label>
                                <div class="col-12">
                                    <textarea class="form-control color-1" rows="8" resizable="false" style="resize: none;" name="description" id="description">@if ($errors->any() && old('description') !== null){{old('description')}}@else{{Auth::user()->description}}@endif</textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-12">
                                    <button type="submit" class="btn button-style-1 text-white">Guardaaar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div> -->

                <div class="tab-pane fade" id="v-pills-finance" role="tabpanel" aria-labelledby="v-pills-finance-tab">
                    <h5 class="border-bottom border-color-1 border-width-2 pb-1">Datos financieros</h5>
                    <div class="bg-color-2 p-3 border">
                        <form id="formFinanceSettings" method="POST" action="{{ route('user.update.finance') }}" onsubmit="preventMultipleSubmitForm(this, '{{ asset('icons/blocks.svg')}}', 'left')">
                            @method('PUT')
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <small class="form-text text-muted"><i>Click en cualquier campo para editar y luego pulsa en guardar.<br/> Estos datos serán usados a la hora de realizar la facturación en los medios de pagos que utilizamos.<br/> Recuerda establecer tu cuenta de retiro para que te podamos enviar los pagos a principio de mes.</i></small>
                                </div>
                            </div>

                            @can('is_photographer')
                                <div class="row mt-3">
                                    <div class="col-sm-3">
                                        <p for="firstname">Balance actual:</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="color-1 bg-color-2 mx-2">{{Auth::user()->balance . " " . config('app.currency')}}</p>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="withdrawal_account" class="col-sm-3 col-form-label">Cuenta de retiro:</label>
                                    <div class="col-sm-9">
                                        <select name="withdrawal_method" id="withdrawal_method" class="form-control form-control-sm color-1 bg-color-2 border-0" onchange="$('#withdrawal_account').val('')">
                                            <option value="Mercadopago" @if ($errors->any() && old('withdrawal_method') === "Mercadopago"){{ 'selected' }}@else{{ (Auth::user()->withdrawal_method == "Mercadopago") ? 'selected' : '' }} @endif>Mercadopago</option>
                                            <option value="Banco de Crédito del Peru" @if ($errors->any() && old('withdrawal_method') === "Banco de Crédito del Peru"){{ 'selected' }}@else{{ (Auth::user()->withdrawal_method == "Banco de Crédito del Peru") ? 'selected' : '' }} @endif>Banco de Crédito del Peru</option>
                                            <option value="Banco Interbank" @if ($errors->any() && old('withdrawal_method') === "Banco Interbank"){{ 'selected' }}@else{{ (Auth::user()->withdrawal_method == "Banco Interbank") ? 'selected' : '' }} @endif>Banco Interbank</option>
                                            <option value="Banco Scotiabank" @if ($errors->any() && old('withdrawal_method') === "Banco Scotiabank"){{ 'selected' }}@else{{ (Auth::user()->withdrawal_method == "Banco Scotiabank") ? 'selected' : '' }} @endif>Banco Scotiabank</option>
                                            <option value="Banco BBVA Continental" @if ($errors->any() && old('withdrawal_method') === "Banco BBVA Continental"){{ 'selected' }}@else{{ (Auth::user()->withdrawal_method == "Banco BBVA Continental") ? 'selected' : '' }} @endif>Banco BBVA Continental</option>
                                        </select>
                                        <input type="text" class="form-control color-1 bg-color-2 border-0" id="withdrawal_account" name="withdrawal_account" value="@if ($errors->any() && old('withdrawal_account') !== null){{old('withdrawal_account')}}@else{{Auth::user()->withdrawal_account}}@endif" placeholder="Cuenta">
                                    </div>
                                </div>
                            @endcan

                            <div class="form-group row">
                                <label for="identification_number" class="col-sm-3 col-form-label">Documento de identidad:</label>
                                <div class="col-sm-9">
                                    <select name="identification_type" id="identification_type" class="form-control form-control-sm color-1 bg-color-2 border-0" onchange="$('#identification_number').val('')">
                                        <option value="DNI" @if(Auth::user()->identification_type == "DNI") selected @endif>DNI</option>
                                        <option value="C.E" @if(Auth::user()->identification_type == "C.E") selected @endif>C.E</option>
                                        <option value="RUC" @if(Auth::user()->identification_type == "RUC") selected @endif>RUC</option>
                                        <option value="Otro" @if(Auth::user()->identification_type == "Otro") selected @endif>Otro</option>
                                    </select>
                                    <input type="text" class="form-control color-1 bg-color-2 border-0" id="identification_number" name="identification_number" value="@if ($errors->any() && old('identification_number') !== null){{old('identification_number')}}@else{{Auth::user()->identification_number}}@endif" placeholder="Número de documento">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="phone_number" class="col-sm-3 col-form-label">Teléfono:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control color-1 bg-color-2 border-0" id="phone_number" name="phone_number" value="@if ($errors->any() && old('phone_number') !== null){{old('phone_number')}}@else{{Auth::user()->phone_number}}@endif" placeholder="Número de teléfono">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="zip_code" class="col-sm-3 col-form-label">Código postal:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control color-1 bg-color-2 border-0" id="zip_code" name="zip_code" value="@if ($errors->any() && old('zip_code') !== null){{old('zip_code')}}@else{{Auth::user()->zip_code}}@endif" placeholder="Código postal">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="street_name" class="col-sm-3 col-form-label">Nombre de la calle:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control color-1 bg-color-2 border-0" id="street_name" name="street_name" value="@if ($errors->any() && old('street_name') !== null){{old('street_name')}}@else{{Auth::user()->street_name}}@endif" placeholder="Nombre de la calle">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="street_number" class="col-sm-3 col-form-label">Número de la calle:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control color-1 bg-color-2 border-0" id="street_number" name="street_number" value="@if ($errors->any() && old('street_number') !== null){{old('street_number')}}@else{{Auth::user()->street_number}}@endif" placeholder="Número de la calle">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <button type="submit" class="btn button-style-1 text-white">Guardar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
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
