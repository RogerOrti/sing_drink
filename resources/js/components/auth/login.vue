<template>
    <div id="login">
        <div class="container mt-3 bg-primary">
            <div class="col justify-content-center">
                <form action="{{ action([App\Http\Controllers\UsuariController::class, 'login']) }}" method="POST">
                    <div class="mb-3">
                        <label for="nom" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="nom" name="nom">
                    </div>
                    <div class="mb-3">
                        <label for="contra" class="form-label">Contrasenya</label>
                        <input type="password" class="form-control" id="contra" name="contrasenya">
                    </div>
                    <div class="mb-3">
                        <a href="{{ route('register') }}" class="text-secondary">No tens compte? Registra't ara!</a>
                    </div>
                    <button type="submit" class="btn btn-secondary">Iniciar sessió</button>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
export default {

}
</script>
<style>

</style>
