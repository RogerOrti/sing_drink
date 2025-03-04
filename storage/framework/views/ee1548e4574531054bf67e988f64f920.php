<?php $__env->startSection('fonsPantalla'); ?>
    <div id="quisom" style="background-image: url('<?php echo e(url('img/fondo.jpg')); ?>');">
        <h1 class="display-1 fw-bold text-center larger-title">QUI SOM</h1>
        <p class="display-5  text-center ">-</p>
        <p class="display-6 text-center"><strong>Sing&Drink</strong></p>

    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('Contenido_Adicional'); ?>
    <div class="bg-primary ">
        <br>
        <p class="display-1 fw-bold text-center larger-title text-bg-primary " id="integrantes">INTEGRANTS</p>
        <section class="jukebox">

            <div class="jukebox-wrapper">
                <div class="carta"><img src="<?php echo e(url('img/prog1.jpg')); ?>" alt="Album 1"></div>
                <div class="carta"><img src="<?php echo e(url('img/prog2.jpg')); ?>" alt="Album 2"></div>
                <div class="carta"><img src="<?php echo e(url('img/prog3.jpg')); ?>" alt="Album 3"></div>
                <div class="carta"><img src="<?php echo e(url('img/prog4.jpg')); ?>" alt="Album 4"></div>
                <div class="carta"><img src="<?php echo e(url('img/prog5.jpg')); ?>" alt="Album 5"></div>
            </div>
        </section>

        <div class="container marketing text-center" id="integrantes-explicacion">
            <div>
                <p class="display-5 text-white"><strong>EQUIP DE PROGRAMACIÓ</strong></p>
                <p class="fs-5 text-white">
                    Som un equip apassionat per la tecnologia i la música, dedicats a crear experiències úniques.
                </p>
                <p class="fs-5 text-white">
                    El nostre projecte és una plataforma que connecta músics carrerers amb restaurants en cerca de
                    talent en viu, oferint oportunitats i promovent la cultura musical a la ciutat.
                </p>

            </div>
        </div>
        <hr class="featurette-divider text-light" style="margin-bottom: 40px; margin-top: 40px;">


        <div class="container marketing">

            <div class="row featurette text-bg-primary">
                <div class="col-md-7 order-md-2">
                    <h2 class="featurette-heading fw-normal lh-1">MISIÓ<span class="text-body-secondary "></span></h2>
                    <br>
                    <p class="lead ">La nostra missió és connectar músics i propietaris de locals a través d'una plataforma
                        inclusiva i accessible,
                        que facilita la col·laboració, fomenta el creixement artístic i promou experiències úniques per al
                        públic.</p>
                    <p class="lead ">Volem ser el pont que transforma la passió
                        per la música en oportunitats reals, creant un ecosistema on tots es beneficien i creixen junts.</p>
                </div>
                <div class="col-md-5 order-md-1">
                    <img src="<?php echo e(url('img/mision.png')); ?>" alt="Mision"
                        class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="400"
                        height="400">
                </div>

            </div>
            <hr class="featurette-divider text-light" style="margin-bottom: 40px; margin-top: 40px;">

            <div class="row featurette text-bg-primary">
                <div class="col-md-7">
                    <h2 class="featurette-heading fw-normal lh-1">VISIÓ<span class="text-body-secondary"></span></h2>
                    <BR></BR>
                    <p class="lead">Aspirem a crear una aplicació amb una visió inclusiva perqué sigui accessible per
                        totes les persones.
                        També crear una aplicació fàcil d’utilitzar i fàcil de moure
                    </p>

                    <p class="lead">Aspirem a ser la plataforma de referència per a músics i locals, revolucionant la
                        manera com es gestionen les actuacions en viu</p>
                </div>
                <div class="col-md-5">
                    <img src="<?php echo e(url('img/visio.png')); ?>" alt="Misión, Visión y Valores"
                        class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="400"
                        height="400">
                </div>
            </div>
            <hr class="featurette-divider text-light" style="margin-bottom: 40px; margin-top: 40px;">

            <div class="row featurette text-bg-primary">
                <div class="col-md-7 order-md-2">
                    <h2 class="featurette-heading fw-normal lh-1">VALORS</h2>
                    <br>
                    <p class="lead text-bg-primary">Accessibilitat: Fomentem una plataforma fàcil d'usar, que elimini
                        barreres i permeti a tots els usuaris trobar oportunitats.

                    </p>
                    <p class="lead">Col·laboració: Valorem el treball conjunt entre músics i propietaris de locals, creant
                        relacions beneficioses i de suport mutu. </p>
                    <p class="lead">Transpariència: Volem que els músic i propietaris es sentin segurs en utilitzar la
                        nostre apliació web </p>
                </div>
                <div class="col-md-5 order-md-1">
                    <img src="<?php echo e(url('img/valors.png')); ?>" alt="Misión, Visión y Valores"
                        class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="400"
                        height="400">
                </div>

            </div>
        </div>
    </div>

    <script src="<?php echo e(mix('js/app.js')); ?>"></script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            gsap.registerPlugin(ScrollTrigger);

            const wrapper = document.querySelector(".jukebox-wrapper");
            const player = document.querySelector(".player");

            // Animación para la tipografía
            gsap.fromTo(".artist h1", {
                x: -500,
                opacity: 0,
            }, {
                x: 0,
                opacity: 1,
                scrollTrigger: {
                    trigger: ".artist",
                    start: "top 60%",
                    end: "bottom 40%",
                    scrub: 1,
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
                x: "100%",
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\jader\OneDrive\Desktop\xampp\xampp\htdocs\sing_drink\resources\views/quiSom/quisom.blade.php ENDPATH**/ ?>