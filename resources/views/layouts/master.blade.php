<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- add card image link Whatsapp -->
    <meta name="description" content="Encuentra tus fotos en PicWas!">
    <meta property="og:title" content="PicWas" />
    <meta property="og:url" content="https://picwas.com/" />
    <meta property="og:description" content="Busca tus Fotos aqui!">
    <!-- imagen 300 x 200  -->
    <meta property="og:image" content="https://picwas.com/img/icon_300x200.png">
    <meta property="og:type" content="article" />
    <meta property="og:locale" content="es_ES" />
    <meta property="og:locale:alternate" content="en_US" />

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/picwas.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
    <title>{{config('app.name')}} - @yield('title')</title>

    <style>
        @font-face {
            font-family: "CenturyGothic";
            src: url("{{ asset('fonts/GOTHIC.eot') }}"); /* IE9 Compat Modes */
            src: url("{{ asset('fonts/GOTHIC.eot?#iefix') }}") format("embedded-opentype"), /* IE6-IE8 */
                url("{{ asset('fonts/GOTHIC.svg') }}") format("svg"), /* Legacy iOS */
                url("{{ asset('fonts/GOTHIC.ttf') }}") format("truetype"), /* Safari, Android, iOS */
                url("{{ asset('fonts/GOTHIC.woff') }}") format("woff"), /* Modern Browsers */
                url("{{ asset('fonts/GOTHIC.woff2') }}") format("woff2"); /* Modern Browsers */
            font-weight: normal;
            font-style: normal;
        }

        * {
            font-family: 'CenturyGothic';
        }
    </style>
</head>
<body>
    @yield('content')

    <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>

    @yield('loadScripts')
</body>
</html>
