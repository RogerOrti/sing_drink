@extends('layouts')

@section('fonsPantalla')
<img src="{{ url('https://i.postimg.cc/yNNZkdT7/Screenshot-2025-04-05-at-19-07-22-photo-1528907061761-f2aa74665321-Imagen-JPEG-2070-1380-p-xeles.png') }}"
     class="fosc" alt="GIF de imagen"
     style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;">

@endsection

@section('PantallaDeInicio')
    <div id="quisom">
        <h1 class="display-1 fw-bold text-center larger-title">SING&DRINK</h1>
        <p class="display-6 text-center"><strong>Sing&Drink: on cada nota sap millor.</strong></p>
    </div>
@endsection
@section('Contenido_Adicional')
    <div id="app2">
        <carousel></carousel>
    </div>
    <div id="app3">
        <cartel-imagen></cartel-imagen>
    </div>
@endsection

