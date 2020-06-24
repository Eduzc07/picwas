<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <title>Nuevo inicio de sesión</title>
</head>
<body>
    <div class="container-fluid bg-white" style="margin-top: 80px;">
        <div class="row align-items-center" style="height: 100vh;">
            <div class="col-12 text-center bg-white">
                <div class="row justify-content-center">
                    <div class="col-8 col-sm-4">
                        <a href="{{config('app.url')}}"><img src="{{ asset('img/logo_color.png') }}" alt="{{config('app.name')}}" class="img-fluid" style="max-width: 150px;"></a>
                    </div>
                    <div class="w-100"></div>
                    <div class="col-12">
                        <h1 class="mt-5 mb-4">Nuevo inicio de sesión en su cuenta de <a href="{{config('app.url')}}">{{config('app.name')}}</a></h1>
                        <p>Se ha iniciado sesión desde la dirección ip: {{$ip}}.</p>
                        <p>Si has sido tu, ignora este correo electrónico, si no has sido tu te recomendamos cambiar tu contraseña.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>