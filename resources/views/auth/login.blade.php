@extends('index')

@section('contingut')
    <div class="col justify-content-center">
        <form action="{{ action([App\Http\Controllers\UsuariController::class, 'login']) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="" class="form-label">Nom</label>
                <input type="text" class="form-control" id="" name="nom">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Contrasenya</label>
                <input type="text" class="form-control" id="" name="contrasenya">
            </div>
            <button type="submit" class="btn btn-primary">Iniciar sessió</button>
        </form>
    </div>
@endsection
