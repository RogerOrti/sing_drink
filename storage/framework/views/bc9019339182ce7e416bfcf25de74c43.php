<?php $__env->startSection('PantallaDeInicio'); ?>

    <div class="container mt-3 bg-primary">
        <div class="col justify-content-center">
            <form action="<?php echo e(action([App\Http\Controllers\UsuariController::class, 'login'])); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="mb-3">
                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" class="form-control" id="nom" name="nom">
                </div>
                <div class="mb-3">
                    <label for="contra" class="form-label">Contrasenya</label>
                    <input type="password" class="form-control" id="contra" name="contrasenya">
                </div>
                <div class="mb-3">
                    <a href="<?php echo e(route('register')); ?>" class="text-secondary">No tens compte? Registra't ara!</a>
                </div>
                <button type="submit" class="btn btn-secondary">Iniciar sessió</button>
            </form>
        </div>
    </div>
    <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sing_drink\resources\views/auth/login.blade.php ENDPATH**/ ?>