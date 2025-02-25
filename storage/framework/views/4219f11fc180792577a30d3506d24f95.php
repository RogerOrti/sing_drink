<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/css/app.scss', 'resources/js/app.js']); ?>
</head>

<body>
    <div class="bg-primary">Hola</div>

    <?php echo $__env->yieldContent('contingut'); ?>


</body>

</html>
<?php /**PATH C:\xampp\htdocs\sing_drink\resources\views/index.blade.php ENDPATH**/ ?>