@extends('layouts')

@section('fonsPantalla')
    <img src="{{ asset('image/200.gif') }}" width="100%" class="fosc" height="100%" alt="GIF de imagen"
        style="position:absolute">
@endsection

@section('PantallaDeInicio')
    <div id="quisom">
        <h1 class="display-1 fw-bold text-center larger-title">QUI SOM</h1>
        <p class="display-5  text-center ">-</p>
        <p class="display-6 text-center"><strong>Sing&Drink</strong></p>
    </div>
@endsection
@section('Contenido_Adicional')
    <div class="carouselIndex">
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
    <div class="CartelImagenes">
        <h1>Carteles Cabrpn</h1>
        <div class="CartelImagenesCardCard">
            <article class="CartelImagenesCard" style="background-image: url('{{ asset('img/prog1.jpg') }}');"></article>
            <article class="CartelImagenesCard" style="background-image: url('{{ asset('img/prog2.jpg') }}');"></article>
            <article class="CartelImagenesCard" style="background-image: url('{{ asset('img/prog3.jpg') }}');"></article>
            <article class="CartelImagenesCard" style="background-image: url('{{ asset('img/prog4.jpg') }}');"></article>
        </div>

    </div>
    <div class="CartelImagenes">
        <h1>Carteles Cabrpn</h1>
        <div class="ImagenMusicDeCadaUno"></div>

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
