<?php $__env->startSection('fonsPantalla'); ?>
    <img src="<?php echo e(asset('image/200.gif')); ?>" width="100%" height="100%" alt="GIF de imagen" style="position:absolute">
<?php $__env->stopSection(); ?>


<?php $__env->startSection('PantallaDeInicio'); ?>
    <div class="full-index-1">
        <div class="container">
            <h2>SING&DRINK</h2>
            <div class="InicioDescripcion">
                <p>"Sing and Drink es un proyecto que ofrece una experiencia única en bares, donde músicos en vivo crean un ambiente animado mientras los asistentes disfrutan de una variedad de bebidas. Con una selección musical ecléctica, el evento promueve la interacción social y el disfrute de la música en un entorno relajado."</p>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sing_drink\resources\views/proves/index.blade.php ENDPATH**/ ?>