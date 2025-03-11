<?php $__env->startSection('PantallaDeInicio'); ?>
<div id="quisom" style="background-image: url('<?php echo e(url('image/200.gif')); ?>');">
    <h1 class="display-1 fw-bold text-center larger-title">QUI SOM</h1>
    <p class="display-5  text-center ">-</p>
    <p class="display-6 text-center"><strong>Sing&Drink</strong></p>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('Contenido_Adicional'); ?>
<div class="carouselIndex">
    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <img src="<?php echo e(asset('img/fondo.jpg')); ?>" alt="Imagen 1">
            </div>
            <div class="swiper-slide">
                <img src="<?php echo e(asset('img/fondo.jpg')); ?>" alt="Imagen 2">
            </div>
            <div class="swiper-slide">
                <img src="<?php echo e(asset('img/fondo.jpg')); ?>" alt="Imagen 3">
            </div>
            <div class="swiper-slide">
                <img src="<?php echo e(asset('img/fondo.jpg')); ?>" alt="Imagen 4">
            </div>

        </div>
        <div class="swiper-pagination"></div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        var swiper = new Swiper(".mySwiper", {
            effect: "coverflow",
            grabCursor: true,
            centeredSlides: true,
            slidesPerView: "auto",
            spaceBetween: 50,
            initialSlide: 2,
            coverflowEffect: {
                rotate: 10,
                stretch: 0,
                depth: 500,
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



<?php echo $__env->make('layouts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sing_drink\resources\views/proves/index.blade.php ENDPATH**/ ?>