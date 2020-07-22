@extends('layouts.master')

@section('title', 'Registrate como cliente')

@section('content')
<div class="div-full-screen-background-image" style="background-image: url({{ asset('img/background-image-customer-login.jpg') }});"></div>

<div class="position-fixed w-100 h-100 bg-green-opacity-50" style="z-index: -888; top: 0px;">
<!--
    class="position-fixed w-100 h-100" style="z-index: -888;" - full width and height div
-->
</div>

<div class="container-fluid bg-white" style="margin-top: 80px;">
    <div class="position-absolute d-none d-md-block" style="top: 3rem; right: 1rem; max-width: 160px; z-index: 2">
        <a href="{{route('/')}}"><img class="img-fluid" src="{{ asset('img/logo_color_white_dark_shadow.png') }}" alt="{{config('app.name')}}"></a>
    </div>

    <div class="row align-items-center" style="height: 100vh;">
        <div class="col-12 text-center bg-white">
            <!-- <div class="col-12">
                <h1 class="justify-content-center pr-5 pl-5 pt-1 pb-1 d-inline-flex w-100" style="max-width: 28rem;">&nbsp</h1>
            </div> -->
            <div id="background-register" class="row pt-4">
                <div class="col-6 mx-auto">
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
                </div>
                <div class="col-md-8 mx-auto">
                    <h3 class="color-1"><u>Términos y Condiciones de Uso</u></h3>

                    <h5 class="color-1"><u>INFORMACIÓN RELEVANTE</u></h5>

                    <p class="text-justify">
                      Es requisito necesario para la adquisición o venta de fotos en éste sitio, que lea y acepte los siguientes Términos y Condiciones que a continuación se redactan.
                      Todas las fotos que son ofrecidas por nuestro sitio web podrían ser creadas, cobradas, enviadas o presentadas por una página web tercera y en tal caso estarían sujetas a sus propios Términos y Condiciones.
                      En todos los casos, para adquirir una fotografía, será necesario el registro por parte del usuario, con ingreso de datos personales fidedignos y definición de una contraseña.
                      El usuario puede elegir y cambiar la clave para su acceso de administración de la cuenta en cualquier momento, en caso de que se haya registrado y que sea necesario para la compra o venta de fotos PicWas no asume la responsabilidad en caso de que entregue dicha clave a terceros.
                      Todas las compras y transacciones que se lleven a cabo por medio de este sitio web, están sujetas a un proceso de confirmación y verificación, el cual podría incluir la verificación del archivo, validación de la forma de pago, validación de la factura (en caso de existir) y el cumplimiento de las condiciones requeridas por el medio de pago seleccionado.
                      En algunos casos puede que se requiera una verificación por medio de correo electrónico.
                      Los precios de las fotos ofrecidas en esta Tienda Online son válidos solamente en las compras realizadas en este sitio web.
                    </p>

                    <h5 class="color-1"><u>LICENCIA</u></h5>

                    <p class="text-justify">
                      PicWas a través de su sitio web concede una licencia para que los usuarios visualicen y compren las fotos que son vendidas en este sitio web de acuerdo a los Términos y Condiciones que se describen en este documento.
                    </p>

                    <h5 class="color-1"><u>USO NO AUTORIZADO</u></h5>

                    <p class="text-justify">
                      En el caso de los <b>fotógrafos</b> está totalmente prohibido publicar fotos que atenten contra la integridad física y/o psicológica de una persona, desnudos, contenido sexual o de menores de edad sin autorización de los padres.
                      PicWas tiene la opción en todas sus fotos de ser reportadas para ser eliminadas, en caso se viole esta norma. El fotógrafo se hace totalmente responsable de la denuncia del usuario o persona que salga en dicha fotografía.
                    </p>

                    <h5 class="color-1"><u>PROPIEDAD</u></h5>

                    <p class="text-justify">
                      Usted no puede declarar propiedad intelectual o exclusiva a ninguna de las fotos expuestas en el sitio web.
                      Todas las fotos son propiedad de los fotógrafos, sin embargo una vez adquiridas el usuario puede hacer uso de ellas a su libre criterio.
                      El usuario que adquirió la fotografía se hace totalmente responsable del uso que haga de éste, en el caso de que haya sido mal utilizada, (atentar contra otra persona) éste asumirá las consecuencias que su mal uso traiga consigo.
                      Está totalmente prohibido el uso publicitario para fotografías con personas, excepto si el usuario que compre la foto haya contactado al fotógrafo y al modelo.
                      En este caso, PicWas se deslinda totalmente de este tipo de usos de las fotografías compradas.
                    </p>

                    <h5 class="color-1"><u>POLÍTICA DE REEMBOLSO Y GARANTÍA</u></h5>

                    <p class="text-justify">
                      En el caso de una compra de fotos, no realizamos reembolsos después de descargar la fotografía, usted tiene la responsabilidad de escoger correctamente la fotografía antes de comprarla.
                      Le pedimos que revise cuidadosamente antes de comprarlas.
                      Hacemos solamente excepciones con esta regla cuando la fotografía descargada presenta evidentemente desenfoque o baja nitidez de la imagen.
                    </p>

                    <h5 class="color-1"><u>COMPROBACIÓN ANTIFRAUDE</u></h5>

                    <p class="text-justify">
                      La compra del cliente puede ser aplazada para la comprobación antifraude.
                      También puede ser suspendida por más tiempo para una investigación rigurosa y así evitar transacciones fraudulentas.
                    </p>

                    <h5 class="color-1"><u>PRIVACIDAD</u></h5>

                    <p class="text-justify">
                      Usted garantiza que la información personal que envía cuenta con la seguridad necesaria.
                      Los datos ingresados por los usuarios no serán entregados a terceros, salvo que deba ser revelada en cumplimiento a una orden judicial o requerimientos legales.
                      La suscripción a boletines de correos electrónicos publicitarios es voluntaria y podría ser seleccionada al momento de crear su cuenta.
                      PicWas se reserva los derechos de cambiar o de modificar estos términos sin previo aviso.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('loadScripts')
    <script src="{{ asset('js/scripts.js') }}"></script>
@endsection
