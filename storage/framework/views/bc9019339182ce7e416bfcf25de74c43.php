<?php $__env->startSection('contingut'); ?>
    <div class="col justify-content-center">
        <form action="<?php echo e(action([App\Http\Controllers\UsuariController::class, 'login'])); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="mb-3">
                <label for="" class="form-label">Nom</label>
                <input type="text" class="form-control" id="" name="nom">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Contrasenya</label>
                <input type="text" class="form-control" id="" name="contrasenya">
            </div>
            <button type="submit" class="btn btn-primary">Iniciar sessió</button>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sing_drink\resources\views/auth/login.blade.php ENDPATH**/ ?>