<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/css/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div class="bg-primary">Hola</div>


    @yield('contingut')


</body>

</html>
