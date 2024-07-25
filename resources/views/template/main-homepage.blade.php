<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ secure_asset('app/css/main.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('app/css/main.css') }}" type="text/css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    {{-- Datatable --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

    <title>Website PPDB Sekolah Kristen Yahya</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('app/assets/images/siay-logo.png') }}" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('visimisi*') ? 'active' : '' }}" aria-current="page"
                            href="#">Visi Misi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('program*') ? 'active' : '' }}" href="#">Program</a>
                    </li>
                    {{-- <li class="nav-item">
                        <a class="nav-link {{ request()->is('AcceptanceStudent*') ? 'active' : '' }}"
                            href="#AcceptedStudent">Tabel Penerimaan</a>
                    </li> --}}
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('keunggulan*') ? 'active' : '' }}"
                            href="#">Keunggulan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('fasilitas*') ? 'active' : '' }}"
                            href="#">Fasilitas</a>
                    </li>
                </ul>
                <div class="d-flex">
                    <a href="{{ route('login') }}" class="btn btn-master btn-success me-3">
                        Masuk
                    </a>
                    <a href="#" class="btn btn-master btn-login">
                        Daftar PPDB
                    </a>
                </div>
            </div>
        </div>
    </nav>

    @yield('content')


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

    <script src="{{ secure_asset('template/assets/script.js') }}"></script>
    <script src="{{ asset('template/assets/script.js') }}"></script>

</body>

</html>
