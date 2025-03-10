@extends('layouts')

@section('fonsPantalla')
<img src="{{ asset('image/erfan/anthony-kiedis-red-hot.jpg') }}" width="100%" class="fosc" height="100%" alt="GIF de imagen" style="position:absolute">
@endsection

@section('PantallaDeInicio')
<div id="quisom">
    <h1 class="display-1 fw-bold text-center larger-title">ANTHONY KIEDIS</h1>
</div>

@endsection

@section('Contenido_Adicional')
<div class="fons d-flex justify-content-center">
    <div class="fotoPrincipal m-5">
        <img src="{{ asset('image/erfan/PortadaKiedis.jpg') }}" class="card-img-top" alt="">
    </div>
</div>
<div class="fons d-flex justify-content-center">
    <div class="fotosSecundaries d-flex flex-row justify-content-center" >
        <img src="{{ asset('image/erfan/PortadaKiedis.jpg') }}" class="card-img-top m-5 col-4" alt="">
        <img src="{{ asset('image/erfan/PortadaKiedis.jpg') }}" class="card-img-top m-5" alt="">
        <img src="{{ asset('image/erfan/PortadaKiedis.jpg') }}" class="card-img-top m-5" alt="">
    </div>
</div>
<div class="fons d-flex">
    <div>
        <h1>Sobre mi</h1>
    </div>
    <div>
        <h1>La meva música</h1>
    </div>
</div>

@endsection
