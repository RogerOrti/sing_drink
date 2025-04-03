@extends('layouts')

@section('fonsPantalla')
<img src="{{ asset('image/erfan/anthony-kiedis-red-hot.jpg') }}" width="100%" class="fosc" height="100%" alt="GIF de imagen" style="position:absolute">
@endsection

@section('PantallaDeInicio')
<div id="quisom" data-id="{{ $id }}">
    <pagina-music></pagina-music>
    {{-- <h1 class="display-1 fw-bold text-center larger-title">ANTHONY KIEDIS</h1> --}}
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
        <img src="{{ asset('image/erfan/PortadaKiedis.jpg') }}" class="card-img-top m-5" alt="">
        <img src="{{ asset('image/erfan/PortadaKiedis.jpg') }}" class="card-img-top m-5" alt="">
        <img src="{{ asset('image/erfan/PortadaKiedis.jpg') }}" class="card-img-top m-5" alt="">
    </div>
</div>
<div class="fons d-flex justify-content-center">
    <div  class="textBlanc m-5 text-center w-50 " >
        <h1 class="m-4">Sobre mi</h1>
        <p class="m-4">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since
            the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,
            but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset
            sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
    </div>
</div>
<div class="fons">
    <section class="jukebox">
        <div class="jukebox-wrapper">
            <div class="card"><img src="{{ asset('image/erfan/disc1.webp')}}" alt="Album 1"></div>
            <div class="card"><img src="{{ asset('image/erfan/disc2.webp')}}" alt="Album 2"></div>
            <div class="card"><img src="{{ asset('image/erfan/disc3.webp')}}" alt="Album 3"></div>
            <div class="card"><img src="{{ asset('image/erfan/disc4.webp')}}" alt="Album 4"></div>
            <div class="card"><img src="{{ asset('image/erfan/disc5.webp')}}" alt="Album 5"></div>
            <div class="card"><img src="{{ asset('image/erfan/disc6.webp')}}" alt="Album 6"></div>
    </section>
</div>
<div class="fons videos d-flex justify-content-center">
    <div class="videoPrincipal">
        <iframe width="800" height="550" src="https://www.youtube.com/embed/OS8taasZl8k?si=lNHBmsB3UznsXSqy"
        frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </div>
    <div class="videoSecundari">
        <iframe width="300" height="168" src="https://www.youtube.com/embed/OS8taasZl8k?si=lNHBmsB3UznsXSqy"
        frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        <iframe width="300" height="168" src="https://www.youtube.com/embed/OS8taasZl8k?si=lNHBmsB3UznsXSqy"
        frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        <iframe width="300" height="168" src="https://www.youtube.com/embed/OS8taasZl8k?si=lNHBmsB3UznsXSqy"
        frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </div>

</div>

@endsection
