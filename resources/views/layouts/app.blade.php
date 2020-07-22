<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="stylesheet" href="{{ asset('css/picwas.css') }}">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

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
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light shadow-sm p-0" style="background-image: url({{ asset('img/background-image-customer-login.jpg') }});">
            <div class="container-fluid py-3 pl-3" style="background-color: rgba(40, 167, 69, .50);">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{asset('img/logo_color_white_dark_shadow.png')}}" alt="{{ config('app.name', 'Laravel') }}" width="120" loading="lazy">
                </a>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
