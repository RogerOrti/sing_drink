<template>
    <div id="register" class="">
        <div>
            <div class="container rounded-4 mt-3 bg-primary ">
                <h4 class="card-title text-center">Registre d'Usuari</h4>
                <form action="{{ action([App\Http\Controllers\UsuariController::class, 'register']) }}" method="POST">
                    <div class="d-flex justify-content-center">
                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="nom" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="nom" name="nom" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="contrasenya" class="form-label">Contrasenya</label>
                        <input type="password" class="form-control" id="contrasenya" name="contrasenya" required>
                    </div>
                    <div class="mb-3">
                        <label for="confirmContrasenya" class="form-label">Confirmar Contrasenya</label>
                        <input type="password" class="form-control" id="confirmContrasenya" name="confirmContrasenya" required>
                    </div>

                    <div class="mb-3">
                        <label for="">Estil musica</label>
                        <select class="form-select">
                            <option selected>Open this select menu</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>

                    <div v-if="form">
                        <div class="mb-3">
                            <label for="" class="form-label">Nom local</label>
                            <input type="password" class="form-control" id="" name="" required>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Adreça del local</label>
                            <input type="text" class="form-control" id="" name="" required>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Tipus local</label>
                            <input type="password" class="form-control" id="" name="" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-secondary">Registrar-se</button>
                </form>
            </div>
        </div>
    </div>
</template>
<script>


export default {

    data(){

        return{
            nom: '',
            email: '',
            contrasenya: '',
            confirmarContrasenya: '',

        };
    },
    methods: {
        agafarTipuslocals(){
            
            
        },
        agafarEstilMusic(){



        },
    },
};
</script>
<style>

</style>
