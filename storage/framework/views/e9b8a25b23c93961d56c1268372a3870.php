<?php $__env->startSection('fonsPantalla'); ?>
<video autoplay loop muted playsinline style="position:absolute; width:100%; height:100%; object-fit: cover;z-index:-1">
    <source src="<?php echo e(url('image/erfan/indexMusics.mp4')); ?>" type="video/mp4">
</video>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('PantallaDeInicio'); ?>
<div id="quisom">
    <h1 class="display-1 fw-bold text-center larger-title">MÚSICS</h1>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('Contenido_Adicional'); ?>
<div class="locals">
    <div>
        <h1 class="titolLocals">ELS NOSTRES MÚSICS</h1>
    </div>
<div class="coleccioMusics">
    <div class="cardsLocals">
        <div class="cardMusics">
            <img src="<?php echo e(asset('image/erfan/Anthony_Kiedis.png')); ?>" class="cardMusics" alt="...">
            <div>
              <a href="#" class=" btn btnMusics btn-primary">Saber más</a>
              <img class="play" src="<?php echo e(asset('image/erfan/logoPlay.png')); ?>" class="card-img-top" alt="...">
            </div>
        </div>
    </div>
    <div class="cardsLocals">
        <div class="cardMusics">
            <img src="<?php echo e(asset('image/erfan/Anthony_Kiedis.png')); ?>" class="cardMusics" alt="...">
            <div>
              <a href="#" class="btn btnMusics btn-primary">Saber más</a>
              <img class="play" src="<?php echo e(asset('image/erfan/logoPlay.png')); ?>" class="card-img-top" alt="...">
            </div>
        </div>
    </div>
</div>
</div>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sing_drink\resources\views/musics/musics.blade.php ENDPATH**/ ?>