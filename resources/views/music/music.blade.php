@extends('layouts')

@section('fonsPantalla')
   <img src="{{ asset($music->multimedia_music->first()->ruta) }}" class="fotoPortadaCantant" alt="">
@endsection

@section('PantallaDeInicio')
<div id="quisom">
    <h1 class="display-1 fw-bold text-center larger-title">{{ $music->user->nom}}</h1>
    <p class="lletraBlanca">Sing and Drink et convida a viure una experiència única als nostres locals
        Gaudeix de música en viu, una gran selecció de begudes i moments inoblidables amb els teus amics.</p>
</div>

@endsection

@section('Contenido_Adicional')
    <div class="fons d-flex justify-content-center">
        <div class="fotoPrincipal m-5">
            <img src="{{ asset('image/erfan/id4.webp') }}" class="card-img-top" alt="">
        </div>
    </div>
<div class="fons d-flex justify-content-center">
    <div class="fotosSecundaries d-flex flex-row justify-content-center" >
        <img src="{{ asset('image/erfan/id1.jpg') }}" class="card-img-top m-5" alt="">
        <img src="{{ asset('image/erfan/id2.jpg') }}" class="card-img-top m-5" alt="">
        <img src="{{ asset('image/erfan/id3.webp') }}" class="card-img-top m-5" alt="">
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
            <div class="card"><img src="{{ asset('image/erfan/iddisc1.jpg')}}" alt="Album 1"></div>
            <div class="card"><img src="{{ asset('image/erfan/iddisc2.jpg')}}" alt="Album 2"></div>
            <div class="card"><img src="{{ asset('image/erfan/iddisc3.jpg')}}" alt="Album 3"></div>
            <div class="card"><img src="{{ asset('image/erfan/iddisc4.jpg')}}" alt="Album 4"></div>
            <div class="card"><img src="{{ asset('image/erfan/iddisc5.jpg')}}" alt="Album 5"></div>
            <div class="card"><img src="{{ asset('image/erfan/disc6.webp')}}" alt="Album 6"></div>
    </section>
</div>
<div class="fons videos d-flex justify-content-center">
    <div class="videoPrincipal">
        <iframe width="800" height="550" src="https://www.youtube.com/embed/ktvTqknDobU?si=ii2aZJG8gaFWY4qQ"
        frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </div>
    <div class="videoSecundari">
        <iframe width="300" height="168" src="https://www.youtube.com/embed/7wtfhZwyrcc?si=RaTJp1MQUWqYUIzx"
        frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        <iframe width="300" height="168" src="https://www.youtube.com/embed/fKopy74weus?si=4S-VfUWRhqI2FGON"
        frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        <iframe width="300" height="168" src="https://www.youtube.com/embed/mWRsgZuwf_8?si=W_S4nmZDtVo6uNo6"
        frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </div>

</div>

@endsection
