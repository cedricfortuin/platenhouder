<!doctype html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script
        src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
        crossorigin="anonymous"></script>
    <script src="{{ asset('js/sorting.js') }}"></script>
    <title>Platenhouder</title>
</head>
<body>
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
</script>
<script src="{{ asset('js/sorting.js') }}"></script>
</body>
</html>
