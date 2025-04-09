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
    <div class="carouselIndex">
        <h1 class="mt-5">REVIU ELS MILLORS MOMENTS</h1>
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img src="{{ asset('image/ajr.jpg') }}" alt="Imagen 1">
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('image/ajr.jpg') }}" alt="Imagen 2">
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('image/ajr.jpg') }}" alt="Imagen 3">
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('image/ajr.jpg') }}" alt="Imagen 4">
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('image/ajr.jpg') }}" alt="Imagen 3">
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('image/ajr.jpg') }}" alt="Imagen 4">
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('image/ajr.jpg') }}" alt="Imagen 3">
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('image/ajr.jpg') }}" alt="Imagen 4">
                </div>

            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
    <div class="CartelImagenes1">
        <h1 class="mt-5">DESCOBREIX ELS NOSTRES MÚSICS</h1>
        <div class="CartelImagenesCardCard">
            <article class="CartelImagenesCard" style="background-image: url('{{ asset('image/ajr.jpg') }}');"></article>
            <article class="CartelImagenesCard" style="background-image: url('{{ asset('image/erfan/Anthony_Kiedis.png') }}');"></article>
            <article class="CartelImagenesCard" style="background-image: url('{{ asset('image/images.jpeg') }}');"></article>
            <article class="CartelImagenesCard" style="background-image: url('{{ asset('image/enrique.jpg') }}');"></article>
        </div>
        <button class="btn btn-secondary m-5">Músics</button>
    </div>
    <div class="CartelImagenes2">
        <h1 class="mt-5">GAUDEIX DELS NOSTRES LOCALS</h1>
        <div class="RandomNombre">
            <article class="RandomNombreCard" style="background-image: url('{{ asset('image/12.jpg') }}');"></article>
            <article class="RandomNombreCard" style="background-image: url('{{ asset('image/13.jpeg') }}');"></article>
            <article class="RandomNombreCard" style="background-image: url('{{ asset('image/14.jpg') }}');"></article>
            <article class="RandomNombreCard" style="background-image: url('{{ asset('image/15.jpg') }}');"></article>
        </div>
        <button class="btn btn-secondary m-5">Locals</button>
    </div>
@endsection

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var swiper = new Swiper(".mySwiper", {
            effect: "coverflow",
            grabCursor: true,
            centeredSlides: true,
            slidesPerView: "auto",
            spaceBetween: 150,
            initialSlide: 2,
            coverflowEffect: {
                rotate: 10,
                stretch: 0,
                depth: 300,
                modifier: 1,
                slideShadows: true,
            },
            pagination: {
                el: ".swiper-pagination",
            },
            autoplay: {
                delay: 2500,
                disableOnInteraction: false,
            },
        });
    });
</script>
