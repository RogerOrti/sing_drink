@extends('layouts')

@section('fonsPantalla')
<video autoplay loop muted playsinline style="position:absolute; width:100%; height:100%; object-fit: cover;z-index:-1">
    <source src="{{ url('image/erfan/indexMusics.mp4') }}" type="video/mp4">
    Tu navegador no soporta videos en HTML5.
</video>
@endsection

@section('PantallaDeInicio')
<div>
    <h1>
        MÚSIC
    </h1>
</div>

@endsection

@section('Contenido_Adicional')

@endsection


