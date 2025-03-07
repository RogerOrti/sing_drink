@extends('index')

@section('contingut')
<div class="card mt-3">
    <div class="card-body">
        <h4 class="card-title text-center">Registre d'Usuari</h4>
        <form action="{{ action([App\Http\Controllers\UsuariController::class, 'register']) }}" method="POST">
            @csrf
            <div class="form-check form-switch mb-3">
                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                <label class="form-check-label" for="flexSwitchCheckDefault">Music/propietari local</label>
            </div>
            <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" required>
            </div>
            <div class="mb-3">
                <label for="nom" class="form-label">Cognom</label>
                <input type="text" class="form-control" id="nom" name="cognom" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="contrasenya" class="form-label">Contrasenya</label>
                <input type="password" class="form-control" id="contrasenya" name="contrasenya" required>
            </div>
            <div class="mb-3">
                <label for="confirmContrasenya" class="form-label">Confirmar Contrasenya</label>
                <input type="password" class="form-control" id="confirmContrasenya" name="confirmContrasenya" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Registrar-se</button>
        </form>
    </div>
</div>

@endsection
