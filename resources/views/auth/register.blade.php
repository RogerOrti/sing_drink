@extends('index')

@section('contingut')
    <div class="col justify-content-center">
        <form action="{{ action([App\Http\Controllers\UsuariController::class, 'register'])}}">
            <div class="mb-3">
                <label for="" class="form-label">Nom</label>
                <input type="text" class="form-control" id="">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Email</label>
                <input type="text" class="form-control" id="">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Contrasenya</label>
                <input type="text" class="form-control" id="">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Confirmar contrasenya</label>
                <input type="text" class="form-control" id="">
            </div>
            <div class="mb-3">
                <label for="" class="form-label"></label>
                <input type="text" class="form-control" id="">
            </div>
            <button type="submit" class="btn btn-primary">Registrar-se</button>
        </form>
    </div>
@endsection
