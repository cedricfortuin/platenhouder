<!doctype html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="apple-touch-icon" href="{{ asset('favicon/favicon.ico') }}">

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('favicon/android-chrome-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="512x512" href="{{ asset('favicon/android-chrome-512x512.png.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('favicon/site.webmanifest') }}">

    <link rel="stylesheet" href="{{ asset('fonts/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fonts/css/brands.min.css') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script
        src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
        crossorigin="anonymous"></script>
    <script src="{{ asset('js/sorting.js') }}"></script>
    <title>Familie Fortuin</title>

    @include('popper::assets')
</head>
<body>
<section id="top"></section>
<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">De Familie Fortuin</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('index') }}">Home</a>
                    </li>
                    @auth
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('export_records') }}">Exporteren naar Excel</a>
                        </li>
                    @endauth
                    @auth
                        <li class="nav-item">
                            <a class="nav-link active">Ingelogd als: {{ auth()->user()->name }}</a>
                        </li>
                    @endauth
                    @auth
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('logout') }}">Uitloggen</a>
                        </li>
                    @endauth
                </ul>
                @auth
                    <form class="d-flex">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" onkeyup="searchForRecord()" id="recordSearch">
                    </form>
                @endauth
            </div>
        </div>
    </nav>
</div>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-10 mx-auto">
            @if(session('message'))
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    {{ session('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @yield('section_1')
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-10 mx-auto">
            @yield('section_2')
        </div>
    </div>
</div>

@auth
    <div class="container mb-5 text-center">
        <div class="row">
            <div class="col-md-10 mx-auto">
                <a class="btn btn-outline-primary" href="#top">Naar boven</a>
            </div>
        </div>
    </div>
    <footer class="text-center">
        <div>
            <p>© {{ date('Y') }} <a class="text-decoration-none" href="https://cedricfortuin.com" target="_blank" {{ Popper::pop('Hehe reclame') }}>Cedric Fortuin</a></p>
        </div>
    </footer>
@endauth
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
<script>
    function searchForRecord()
    {
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

    function pickRandomSong()
    {
        const number = Math.floor(Math.random() * ({{ $total }} + 1));

        // Declare variables
        let input, table, tr, td, i, txtValue;
        input = number;
        table = document.getElementById("recordTable");
        tr = table.getElementsByTagName("tr");

        // Loop through all table rows, and hide those who don't match the search query
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.indexOf(input) > -1) {
                    tr[i].style.display = "";
                    document.getElementById('randomNumber').innerText = 'Het gekozen nummer is: ' + number;
                } else {
                    tr[i].style.display = "none";
                    document.getElementById('randomNumber').innerText = 'Het gekozen nummer is: ' + number;
                }
            }
        }
    }

    function checkIfEmpty(inputId)
    {
        let input = document.getElementById(inputId);

        $('#' + inputId + 'Alert').html('');
        $('#' + inputId).removeClass('is-invalid');
        if (input.value === '') {
            $('#' + inputId + 'Alert').html('Dit veld mag niet leeg zijn.');
            $('#' + inputId).addClass('is-invalid');
        }
    }
</script>
<script src="{{ asset('js/sorting.js') }}"></script>
</body>
</html>
