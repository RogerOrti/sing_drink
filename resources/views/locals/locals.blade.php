@extends('layouts')

@section('fonsPantalla')
    <video autoplay loop muted playsinline style="position:absolute; width:100%; height:100%; object-fit: cover;z-index:-1">
        <source src="{{ url('image/erfan/indexLocals.mp4') }}" type="video/mp4">
    </video>
@endsection

@section('PantallaDeInicio')
    <div id="quisom">
        <h1 class="display-1 fw-bold text-center larger-title">LOCALS</h1>
        <p>Sing and Drink et convida a viure una experiència única als nostres locals
            Gaudeix de música en viu, una gran selecció de begudes i moments inoblidables amb els teus amics.</p>
    </div>
@endsection

@section('Contenido_Adicional')
    <div class="locals">
        <div class="">
            <h1 class="titolLocals">ELS LOCALS DISPONIBLES</h1>
        </div>
        <div class="cardsLocals">
            <div class="card" style="width: 18rem;">
                <img src="{{ asset('image/erfan/provaFoto.jpg') }}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <a href="music" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
            <div class="card" style="width: 18rem;">
                <img src="..." class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <a href="music" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
            <div class="card" style="width: 18rem;">
                <img src="..." class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <a href="music" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
            <div class="card" style="width: 18rem;">
                <img src="..." class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <a href="music" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        </div>



    </div>
@endsection
