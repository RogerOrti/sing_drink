<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sticky Navbar with Full Screen Div</title>
    @vite(['resources/css/app.css', 'resources/css/app.scss', 'resources/js/app.js', 'resources/css/erfan.css', 'resources/css/pablo.css' ])
</head>

<body>
    <div class="full-screen-bg-primary">
        @yield('fonsPantalla')

        <nav class="navbar  navbar-expand-lg fixed-top full-width">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('Home') }}">
                    <img src="{{ asset('image/Logo.png') }}" alt="Logo de la marca" width="90" height="100">
                </a>

                <div class="d-flex justify-content-end d-lg-none">
                    <button class="navbar-toggler btn btn-outline-light" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ route('Home') }}">INICIO</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">LOCALES</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">MUSICOS</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">CALENDARIO</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('sobre-nosotros') }}">SOBRE NOSOTROS</a>
                        </li>

                        <li class="nav-item d-lg-none">
                            <a class="nav-link" href="{{ route('login') }}">INICIAR SESION</a>
                        </li>
                        <li class="nav-item d-lg-none">
                            <a class="nav-link" href="{{ route('register') }}">REGISTRAR-SE</a>
                        </li>
                    </ul>
                </div>

                <div class="d-none d-lg-flex">
                    <a href="{{ route('login') }}" class="btn btn-secondary me-2">Iniciar sesión</a>
                </div>
            </div>
        </nav>
        @yield('PantallaDeInicio')
    </div>
    @yield('Contenido_Adicional')
    <div id="Cubo"></div>

    <footer class="full-width-footer">
        <div class="footerPart1">
            <div class="footerpart1-1">
                <p>Uniendo músicos, bares y eventos desde 1934</p>
                <p>Descubre la magia de la música en vivo y apoya los talentos locales</p>
            </div>
            <div class="footerpart1-2">
                <p>2025 Sing & Drink. Todos los derechos reservados</p>
            </div>
        </div>
        <div class="footerPart2">
            <img src="{{ asset('image/Instgram.png') }}" alt="Logo Instagram" width="75" height="75">
            <img src="{{ asset('image/X.png') }}" alt="Logo X" width="75" height="75">
            <img src="{{ asset('image/Facebook.png') }}" alt="Logo Facebook" width="75" height="75">
        </div>
    </footer>
</body>

</html>
