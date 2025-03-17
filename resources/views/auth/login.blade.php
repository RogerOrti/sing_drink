<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sticky Navbar with Full Screen Div</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <link href="https://api.mapbox.com/mapbox-gl-js/v2.15.0/mapbox-gl.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/css/app.scss', 'resources/js/app.js', 'resources/css/erfan.css', 'resources/css/pablo.css', 'resources/css/style.css' ])
</head>
<body>
    <div class="container d-flex">
        <div class="col justify-content-center">
            <form action="{{ action([App\Http\Controllers\UsuariController::class, 'login']) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" class="form-control" id="nom" name="nom">
                </div>
                <div class="mb-3">
                    <label for="contra" class="form-label">Contrasenya</label>
                    <input type="password" class="form-control" id="contra" name="contrasenya">
                </div>
                <div class="mb-3">
                    <a href="{{ route('register') }}">No tens compte? Registra't ara!</a>
                </div>
                <button type="submit" class="btn btn-secondary">Iniciar sessió</button>
            </form>
        </div>
    </div>
</body>
