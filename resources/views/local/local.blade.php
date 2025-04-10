@extends('layouts')

@section('fonsPantalla')
<img src="{{ asset('image/erfan/fotoLocal.jpg') }}" width="100%" class="fosc" height="100%" alt="GIF de imagen" style="position:absolute">
@endsection

@section('PantallaDeInicio')
<div id="app" data-id="{{ $id }}">
    <pagina-local></pagina-local>
    {{-- <div id="quisom">
        <h1 class="display-1 fw-bold text-center larger-title">BAR PEPE</h1>
    </div> --}}
</div>

@endsection

@section('Contenido_Adicional')
<div>
    <h1>MAPA ROGER</h1>
</div>
<div class="fons d-flex justify-content-center ">
    <div class="m-5">
        <h1 class="titolHoraris">OPINIONS</h1>
        <p class="review"> Joselito - Muy buen ambiente</p>
        <p class="review"> Joselito - Me gusta su fruta</p>
        <p class="review"> Joselito - Vaya guapada de sitio</p>

    </div>
    <hr class="hrLocal">
    <div class="m-5">
        <h1 class="titolHoraris">HORARIS</h1>
        <ul class="horaris">
            <li>Dilluns: 10:00 - 23:00</li>
            <li>Dimarts: 10:00 - 23:00</li>
            <li>Dimecres: 10:00 - 23:00</li>
            <li>Dijous: 10:00 - 23:00</li>
            <li>Divendres: 10:00 - 23:00</li>
            <li>Dissabte: 10:00 - 23:00</li>
            <li>Tancat</li>
        </ul>
    </div>
</div>

@endsection

