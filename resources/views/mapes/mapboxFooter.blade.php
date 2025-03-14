@extends('layouts')


@section('fonsPantalla')
<img src="{{ asset('img/prog1.jpg') }}" width="100%" class="fosc" height="100%" alt="GIF de imagen" style="position:absolute">
@endsection

@section('PantallaDeInicio')
<div id="quisom">
    <h1 class="display-1 fw-bold text-center larger-title">Roger tu Contenido</h1>
    <p class="display-5  text-center ">-</p>
    <p class="display-6 text-center"><strong>Sing&Drink</strong></p>
</div>
@endsection


@section('Contenido_Adicional')

<div id="mapa"></div>

@endsection
