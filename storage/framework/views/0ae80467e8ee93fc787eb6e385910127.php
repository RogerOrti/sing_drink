<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sing&Drink</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link href="https://api.mapbox.com/mapbox-gl-js/v2.15.0/mapbox-gl.css" rel="stylesheet">
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/css/app.scss', 'resources/js/main.js', 'resources/js/app.js', 'resources/css/erfan.css', 'resources/css/pablo.css', 'resources/css/style.css']); ?>
</head>

<body>

    <div class="full-screen-bg-primary">
        <?php echo $__env->yieldContent('fonsPantalla'); ?>
        <nav class="navbar navbar-expand-lg fixed-top full-width custom-navbar">
            <div class="container-fluid">
                <a class="navbar-brand" href="<?php echo e(route('Home')); ?>">
                    <img src="<?php echo e(asset('image/Logo.png')); ?>" alt="Logo de la marca" width="90" height="100">
                </a>

                <div class="d-flex justify-content-end d-lg-none">
                    <button class="navbar-toggler btn btn-outline-light" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="<?php echo e(route('Home')); ?>">INICI</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(route('locals.locals')); ?>">LOCALS</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(route('musics.musics')); ?>">MUSICS</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">CALENDARI</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(route('quisom')); ?>">QUI SOM</a>
                        </li>

                        <li class="nav-item d-lg-none">
                            <a class="nav-link" href="<?php echo e(route('login')); ?>">INICIAR SESION</a>
                        </li>
                        <li class="nav-item d-lg-none">
                            <a class="nav-link" href="<?php echo e(route('register')); ?>">REGISTRAR-SE</a>
                        </li>
                    </ul>
                </div>

                <?php if(!Auth::check()): ?>
                    <div class="d-none d-lg-flex">
                        <a href="<?php echo e(route('login')); ?>" class="btn btn-secondary me-2">Iniciar sesión</a>
                    </div>
                    <div class="d-none d-lg-flex">
                        <a href="<?php echo e(route('register')); ?>" class="btn btn-primary me-2">Registrar-se</a>
                    </div>
                <?php else: ?>
                    <?php if(Auth::user()->id_rol == 2): ?>
                        <div id="app4">
                            <afegir-multimedia :user-id='<?php echo json_encode(Auth::user()->id_user, 15, 512) ?>'> </afegir-multimedia>
                    <?php endif; ?>
                    <?php if(Auth::user()->id_rol == 3): ?>
                        <contractar :user-id='<?php echo json_encode(Auth::user()->id_user, 15, 512) ?>'> </contractar>
            </div>
            <?php endif; ?>

            <div class="nav-item dropdown">
                <div class="dropdown">
                    <a class="hoverable dropdown-toggle" type="button" id="dropdownMenuButton1"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <?php echo e(Auth::user()->nom); ?>

                    </a>
                    <div class="dropdown-menu" id="logout">
                        <a href="<?php echo e(route('logout')); ?>" class="dropdown-item">
                            <i aria-hidden="true"></i> Logout
                        </a>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            



    </div>
    </nav>
    <?php echo $__env->yieldContent('PantallaDeInicio'); ?>
    </div>
    <?php echo $__env->yieldContent('Contenido_Adicional'); ?>
    <div id="Cubo"></div>

    <div id="Personalizado">
        <chat :usuario-id="<?php echo e(auth()->id()); ?>"></chat>
        <footer-eventos></footer-eventos>
    </div>

    <div class="container">
        <footer class="row row-cols-1 row-cols-sm-2 row-cols-md-5 py-5 my-5 ">
            <div class="col mb-3 ">
                <a class="navbar-brand" href="<?php echo e(route('Home')); ?>">
                    <img src="<?php echo e(asset('image/Logo.png')); ?>" alt="Logo de la marca" width="130" height="150">
                </a>
            </div>
            <div class="col mb-3">
                <ul class="nav flex-column ">
                    <li class="nav-item mb-2 "><a href="<?php echo e(route('Home')); ?>"
                            class="nav-link p-0 text-secondary">Inicio</a></li>
                    <li class="nav-item mb-2"><a href="cartelera" class="nav-link p-0 text-secondary">Locals</a></li>
                    <li class="nav-item mb-2"><a href="musics" class="nav-link p-0 text-secondary">Musics</a></li>
                    <li class="nav-item mb-2"><a href="" class="nav-link p-0 text-secondary">Calendari</a></li>
                    <li class="nav-item mb-2"><a href="quisom" class="nav-link p-0 text-secondary">Qui som</a>
                    </li>
                </ul>
            </div>
            <div class="footerpart1-1 ">
                <p>Uniendo músicos, bares y eventos desde 1934</p>
                <p>Descubre la magia de la música en vivo y apoya los talentos locales</p>
            </div>
            <div class="footerpart1-2">
                <p>2025 Sing & Drink. Todos los derechos reservados</p>
            </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const navbar = document.querySelector('.custom-navbar');

        function updateNavbarBackground() {
            const scrollY = window.scrollY;
            const isSmallScreen = window.innerWidth < 992;

            if (scrollY > 100 || isSmallScreen) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        }

        // Ejecutar al cargar y cuando cambia el tamaño o se hace scroll
        updateNavbarBackground();
        window.addEventListener('scroll', updateNavbarBackground);
        window.addEventListener('resize', updateNavbarBackground);
    });
</script>


</html>
<?php /**PATH C:\xampp\htdocs\sing_drink\resources\views/layouts.blade.php ENDPATH**/ ?>