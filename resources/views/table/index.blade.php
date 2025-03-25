@extends('layouts')

@section('fonsPantalla')
    <video autoplay loop muted playsinline style="position:absolute; width:100%; height:100%; object-fit: cover;z-index:-1">
        <source src="{{ url('image/erfan/indexMusics.mp4') }}" type="video/mp4">
    </video>
@endsection

@section('PantallaDeInicio')
    <div id="quisom">
        <h1 class="display-1 fw-bold text-center larger-title">TABLAS</h1>
    </div>
@endsection

@section('Contenido_Adicional')
    <div id="app">
        <usuarios-crud></usuarios-crud>
    </div>
@endsection
