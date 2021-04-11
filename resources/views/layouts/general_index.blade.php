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

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>{{ config('app.name') }}</title>

    @include('sweetalert::alert')
    @include('popper::assets')
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">{{ config('app.name') }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('index') }}">Home</a>
                </li>
                @auth
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('record.export') }}">Exporteren naar Excel</a>
                    </li>
                @endauth
            </ul>
            @auth

                <span class="navbar-text">
                    <a class="nav-link active" href="{{ route('logout') }}">Uitloggen</a>
                </span>
            @endauth
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

<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 mx-auto">
            @yield('section_2')
        </div>
    </div>
</div>

@auth
    <footer class="text-center">
        <div>
            <p>© {{ date('Y') }} <a class="text-decoration-none" href="https://cedricfortuin.com"
                                    target="_blank" {{ Popper::pop('Hehe reclame') }}>Cedric Fortuin</a></p>
        </div>
    </footer>
@endauth
<script src="{{ asset('js/app.js') }}"></script>
<script>
    function searchForRecord() {
        let filter = event.target.value.toUpperCase();
        let rows = document.querySelector("#recordTable tbody").rows;

        for (let i = 0; i < rows.length; i++) {
            let firstCol = rows[i].cells[1].textContent.toUpperCase();
            let secondCol = rows[i].cells[2].textContent.toUpperCase();
            let thirdCol = rows[i].cells[3].textContent.toUpperCase();
            if (firstCol.indexOf(filter) > -1 || secondCol.indexOf(filter) > -1 || thirdCol.indexOf(filter) > -1) {
                rows[i].style.display = "";
            } else {
                rows[i].style.display = "none";
            }
        }
    }

    function checkIfEmpty(inputId) {
        let input = document.getElementById(inputId);

        $('#' + inputId + 'Alert').html('');
        $('#' + inputId).removeClass('is-invalid');
        if (input.value === '') {
            $('#' + inputId + 'Alert').html('Dit veld mag niet leeg zijn.');
            $('#' + inputId).addClass('is-invalid');
        }
    }
</script>
@yield('section_js')
</body>
</html>
