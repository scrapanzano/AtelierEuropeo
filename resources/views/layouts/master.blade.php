<!DOCTYPE html>

<html>

<head>
    <title>@yield('title')</title>
    <link rel="icon" href="{{ asset('img/ae-icon.svg') }}" type="image/svg+xml">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ url('/') }}/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">


    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous">
    </script>

    <!-- Bootstrap Icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-dark" data-bs-theme="dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('img/ae-icon.svg') }}" alt="Atelier Europeo" height="40">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link @yield('active_home')" aria-current="page" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @yield('active_chi-siamo')" aria-current="page" href="{{ route('about') }}">Chi siamo</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @yield('active_progetti')" aria-current="page" href="{{ route('project.index') }}">Progetti disponibili</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle @yield('active_viaggiare')" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Viaggiare all'Estero
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Corpo Europeo di Solidarietà</a></li>
                            <li><a class="dropdown-item" href="#">Scambi Giovanili</a></li>
                            <li><a class="dropdown-item" href="#">Corsi di Formazione</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @yield('active_contatti')" aria-current="page" href="#">Contatti</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    @yield('body')
</body>

</html>
