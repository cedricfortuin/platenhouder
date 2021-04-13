<!doctype html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="apple-touch-icon" href="{{ asset('favicon/favicon.ico') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon/apple-touch-icon.png') }}">

    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon/favicon-16x16.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('favicon/android-chrome-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="512x512" href="{{ asset('favicon/android-chrome-512x512.png.png') }}">
    <link rel="manifest" href="{{ asset('favicon/site.webmanifest') }}">

    <link rel="stylesheet" href="{{ asset('fonts/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fonts/css/brands.min.css') }}">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <title>{{ config('app.name') }}</title>

    @include('popper::assets')
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light" id="navbar">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">{{ config('app.name') }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->Is('/') ? 'active' : '' }}" aria-current="page" href="{{ route('index') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->Is('agenda') ? 'active' : '' }}" aria-current="page" href="">Agenda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->Is('muziek') ? 'active' : '' }}" aria-current="page" href="{{ route('music') }}">Muziek</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->Is('waterstanden') ? 'active' : '' }}" aria-current="page" href="">Waterstanden</a>
                </li>
            </ul>
            <span class="navbar-text">
                <a class="nav-link active" href="{{ route('logout') }}">Uitloggen</a>
            </span>
        </div>
    </div>
</nav>
<div class="container-fluid mt-5">
    <div class="row">
        <div class="col-md-10 mx-auto">
            @yield('section_1')
        </div>
    </div>
</div>
<footer class="text-center">
    <div>
        <p>© {{ date('Y') }} <a class="text-decoration-none" href="https://cedricfortuin.com"
                                target="_blank" {{ Popper::pop('Hehe reclame') }}>Cedric Fortuin</a></p>
    </div>
</footer>
<script src="{{ mix('js/app.js') }}" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.0.2/chart.min.js" integrity="sha512-dnUg2JxjlVoXHVdSMWDYm2Y5xcIrJg1N+juOuRi0yLVkku/g26rwHwysJDAMwahaDfRpr1AxFz43ktuMPr/l1A==" crossorigin="anonymous"></script>
@yield('section_js')
@include('sweetalert::alert')
</body>
</html>
