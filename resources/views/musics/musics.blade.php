@extends('layouts')

@section('fonsPantalla')
    <video autoplay loop muted playsinline style="position:absolute; width:100%; height:100%; object-fit: cover;z-index:-1">
        <source src="{{ url('image/erfan/indexMusics.mp4') }}" type="video/mp4">
    </video>
@endsection

@section('PantallaDeInicio')
    <div id="quisom">
        <h1 class="display-1 fw-bold text-center larger-title">MÚSICS</h1>
    </div>
@endsection

@section('Contenido_Adicional')
    <div class="locals">
        <div>
            <h1 class="titolLocals">ELS NOSTRES MÚSICS</h1>
        </div>
        <div id="app" class="personalizado">
            <carta-music></carta-music>
        </div>

    </div>
@endsection
