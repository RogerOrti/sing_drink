
@extends('proves.index')

@section('contingut')
<div id="app">
    <GsapAnimation/>
  </div>
<style>
    .artist {
    color: white;
    text-align: center;
    background-image: url('gportada.png');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    overflow: hidden;
    /* Para evitar que el contenido sobresalga */
}

.artist h1 {
    font-size: 19rem;
    transition: transform 0.3s ease;
}

/* Estilo para el contenedor de la imagen de fondo */
.artist-bg {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-image: url('gportada.png');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    z-index: -1;
}


.info-artist {
    opacity: 0; /* Para ocultar inicialmente */
    transform: translateY(50px); /* Empieza desplazado hacia abajo */
    transition: all 0.3s ease-out; /* Para la transición de movimiento suave */

}

.info-artist h1 {
    text-align: center;
    font-size: 3.5rem;
    line-height: 2.6;
    color: #fff;
    background-image: url('a.jpg');
}


.jukebox {

    height: 100vh;
    display: flex;
    align-items: center;
    overflow: hidden;
}

.jukebox-wrapper {
    display: flex;
    gap: 10px;
    padding: 20px;
    white-space: nowrap;
    will-change: transform;
}

.carta {
    align-items: center
    width: 200px;
    /* Aumentar el tamaño */
    height: 400px;
    /* Aumentar el tamaño */
    border-radius: 10px;
    padding: 10px;
    overflow: hidden;
    cursor: pointer;
    box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.5);
    /* Sombra inicial */
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.carta img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* Efecto al pasar el mouse */
.carta:hover {
    transform: scale(1.05);
    /* Aumenta el tamaño */
    box-shadow: 0px 10px 30px rgba(255, 255, 255, 0.3);
    /* Brillo más fuerte */
}


/* Estilos del reproductor */
.player {
    position: relative;
    width: 100%;
    background: #222;
    padding: 20px;
    text-align: center;
    color: white;
}

.playerBottom {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 10px;
}

.control-buttons {
    display: flex;
    gap: 15px;
    align-items: center;
}

.control-buttons button {
    background: none;
    border: none;
    cursor: pointer;
}

.volume_time {
    display: flex;
    justify-content: space-between;
    width: 100%;
    max-width: 400px;
}

.image-carta {
    width: 200px;
    height: 400px;
    border-radius: 10px;
    overflow: hidden;
    transform: translateX(100%); /* Comienza fuera de la pantalla */
    opacity: 0; /* Inicialmente invisible */
    transition: transform 0.3s ease, opacity 0.3s ease;
}

.image-carta img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    background-color: #111; /* Fondo para asegurarse de que la imagen no esté oculta */
}

</style>
<div class="bg-primary ">


<div class="titul-quisom text-center text-bg-primary"></div>
<div class="titul-integrants text-center text-bg-primary"></div>
<div class="card text-bg-dark">
    <img src="{{ url('img/programadorr.jpg') }}" class="card-img" alt="...">
    <div class="card-img-overlay d-flex flex-column align-self-center">
        <div>
            <h1 class="display-1 fw-bold text-center larger-title">QUI SOM</h1>

            <p class="display-5  text-center " >-</p>
            <p class="display-6 text-center"><strong>Sing&Drink</strong></p>

        </div>
    </div>
</div>
<br>
<p class="display-1 fw-bold text-center larger-title text-bg-primary">INTEGRANTES</p>
<section class="jukebox">

    <div class="jukebox-wrapper">
        <div class="carta"><img src="{{ url('img/programador.jpg') }}" alt="Album 1"></div>
        <div class="carta"><img  src="{{ url('img/programador.jpg') }}" alt="Album 2"></div>
        <div class="carta"><img  src="{{ url('img/programador.jpg') }}" alt="Album 3"></div>
        <div class="carta"><img  src="{{ url('img/programador.jpg') }}" alt="Album 4"></div>
        <div class="carta"><img  src="{{ url('img/programador.jpg') }}" alt="Album 5"></div>

    </div>
</section>
<hr class="featurette-divider text-light" style="margin-bottom: 40px; margin-top: 40px;">

<div class="container marketing">

<div class="row featurette text-bg-primary">
    <div class="col-md-7 order-md-2">
      <h2 class="featurette-heading fw-normal lh-1">MISIO<span class="text-body-secondary "></span></h2>
      <p class="lead ">La nostra missió és connectar músics i propietaris de locals a través d'una plataforma inclusiva i accessible,
        que facilita la col·laboració, fomenta el creixement artístic i promou experiències úniques per al públic.</p>
        <p class="lead ">Volem ser el pont que transforma la passió
            per la música en oportunitats reals, creant un ecosistema on tots es beneficien i creixen junts.</p>
    </div>
    <div class="col-md-5 order-md-1">
        <img src="{{ url('img/mision.png') }}" alt="Mision" class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="400" height="400">

    </div>

  </div>
  <hr class="featurette-divider text-light" style="margin-bottom: 40px; margin-top: 40px;">

<div class="row featurette text-bg-primary">
    <div class="col-md-7">
      <h2 class="featurette-heading fw-normal lh-1">VISIO<span class="text-body-secondary"></span></h2>
      <p class="lead">Aspirem a crear una aplicació amb una visió inclusiva perqué sigui accessible per totes les persones.
        També crear una aplicació fàcil d’utilitzar i fàcil de moure
      </p>

      <p class="lead">Aspirem a ser la plataforma de referència per a músics i locals, revolucionant la manera com es gestionen les actuacions en viu</p>
    </div>
    <div class="col-md-5">
        <img src="{{ url('img/visio.png') }}"
        alt="Misión, Visión y Valores"
        class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto"
        width="400"
        height="400"></div>
  </div>
  <hr class="featurette-divider text-light" style="margin-bottom: 40px; margin-top: 40px;">

<div class="row featurette text-bg-primary">
    <div class="col-md-7 order-md-2">
      <h2 class="featurette-heading fw-normal lh-1">VALORS</h2>
      <p class="lead text-bg-primary">Accessibilitat: Fomentem una plataforma fàcil d'usar, que elimini barreres i permeti a tots els usuaris trobar oportunitats.

</p>
<p class="lead">Col·laboració: Valorem el treball conjunt entre músics i propietaris de locals, creant relacions beneficioses i de suport mutu. </p>
<p class="lead">Transpariència: Volem que els músic i propietaris es sentin segurs en utilitzar la nostre apliació web </p>
    </div>
    <div class="col-md-5 order-md-1">
        <img src="{{ url('img/valors.png') }}"
             alt="Misión, Visión y Valores"
             class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto"
             width="400"
             height="400">
    </div>

  </div>
</div>
</div>

<script src="{{ mix('js/app.js') }}"></script>
<script>
    document.addEventListener("DOMContentLoaded", () => {
    gsap.registerPlugin(ScrollTrigger);

    const wrapper = document.querySelector(".jukebox-wrapper");
    const player = document.querySelector(".player");





    // Animación para la tipografía
    gsap.fromTo(".artist h1", {
        x: -500,  // Empieza fuera de la pantalla
        opacity: 0,
    }, {
        x: 0,  // Se mueve a su posición normal
        opacity: 1,
        scrollTrigger: {
            trigger: ".artist",
            start: "top 60%",
            end: "bottom 40%",
            scrub: 1,  // Hace que la animación siga el scroll
        }
    });

    // Configuración de Lenis
    const lenis = new Lenis({
        duration: 1.5,
        easing: (t) => 1 - Math.pow(1 - t, 3),
        smooth: true,
        smoothTouch: 0.1,
        direction: "vertical"
    });

    lenis.on("scroll", ScrollTrigger.update);

    function raf(time) {
        lenis.raf(time);
        requestAnimationFrame(raf);
    }

    requestAnimationFrame(raf);

    gsap.from(".image-carta", {
        opacity: 0,
        x: "100%", // Empieza fuera de la pantalla
        stagger: 0.2,
        ease: "power2.out",
        scrollTrigger: {
            trigger: ".image-gallery",
            start: "top 80%",
            end: "top 30%",
            scrub: 1,
        }
    });
});

</script>
@endsection

