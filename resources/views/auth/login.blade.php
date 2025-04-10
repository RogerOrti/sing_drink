@extends('layouts')

@section('PantallaDeInicio')
{{-- <div id="app">
    <login></login>
</div> --}}
<div class="container min-vh-100 d-flex justify-content-center align-items-center">
    <div class="bg-primary p-4 rounded w-100" style="max-width: 400px;">
        <form action="{{ action([App\Http\Controllers\UsuariController::class, 'login']) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="nom" class="form-label text-white">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom">
            </div>
            <div class="mb-3">
                <label for="contra" class="form-label text-white">Contrasenya</label>
                <input type="password" class="form-control" id="contra" name="contrasenya">
            </div>
            <div class="mb-3">
                <a href="{{ route('register') }}" class="text-light">No tens compte? Registra't ara!</a>
            </div>
            <button type="submit" class="btn btn-secondary w-100">Iniciar sessió</button>
        </form>
    </div>
</div>

@endsection
