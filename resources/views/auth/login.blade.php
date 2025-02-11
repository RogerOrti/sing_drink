@extends('index')

@section('contingut')
    <form action="{{ action([App\Http\Controllers\UsuariController::class, 'login'])}}">
        <div class="mb-3">
            <label for="" class="form-label"></label>
            <input type="text" class="form-control" id="">
        </div>
        <div class="mb-3">
            <label for="" class="form-label"></label>
            <input type="text" class="form-control" id="">
        </div>
        <div class="mb-3">
            <label for="" class="form-label"></label>
            <input type="text" class="form-control" id="">
        </div>
        <div class="mb-3">
            <label for="" class="form-label"></label>
            <input type="text" class="form-control" id="">
        </div>
        <div class="mb-3">
            <label for="" class="form-label"></label>
            <input type="text" class="form-control" id="">
        </div>
        <button type="submit" class="btn btn-primary">Iniciar sessió</button>
    </form>
@endsection
