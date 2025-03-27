<template>
    <div id="register" class="">
        <div>
            <div class="container rounded-4 mt-3 bg-primary ">
                <h4 class="card-title text-center">Registre d'Usuari</h4>
                <form>
                    <div class="d-flex justify-content-center">
                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="nom" class="form-label">Nom</label>
                        <input type="text" class="form-control" v-model="usuari.nom" required>
                    </div>
                    <div class="mb-3">
                        <label for="nom" class="form-label">Cognom</label>
                        <input type="text" class="form-control" v-model="usuari.cognom" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" v-model="usuari.email" required>
                    </div>
                    <div class="mb-3">
                        <label for="contrasenya" class="form-label">Contrasenya</label>
                        <input type="password" class="form-control" id="contrasenya" name="contrasenya" v-model="usuari.contrasenya" required>
                    </div>
                    <div class="mb-3">
                        <label for="confirmContrasenya" class="form-label">Confirmar Contrasenya</label>
                        <input type="password" class="form-control" id="confirmContrasenya" name="confirmContrasenya" v-model="usuari.confirmarContrasenya" required>
                    </div>

                    <!-- Formulari de dades músic -->
                    <div class="mb-3">
                        <label for="">Estil musica</label>
                        <select class="form-select">
                            <option selected>Open this select menu</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>

                    <div>
                        <label for="">Multimedia</label>
                        <input class="form-control" type="file" name="" id="">
                    </div>

                    <!-- Formulari de dades Porpietari -->
                    <div class="mb-3">
                        <div class="mb-3">
                            <label for="" class="form-label">Nom local</label>
                            <input type="password" class="form-control" id="" name="" required>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Adreça del local</label>
                            <input type="text" class="form-control" id="" name="" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tipus local</label>
                            <select v-model="tipusLocal" class="form-control">
                                <option value="">Selecciona un tipus</option>
                                <option v-for="tipus in tipusLocals" :key="tipus.id_tipo_local" :value="tipus.id_tipo_local">
                                    {{ tipus.tipo_local }}
                                </option>
                            </select>
                        </div>
                    </div>
                    <button @click="afegirUsuari()" class="btn btn-secondary">Registrar-se</button>
                </form>
            </div>
        </div>
    </div>
</template>
<script>


export default {

    data(){

        return{

            usuari: [],
            tipusLocals: [],
            estilMusica: [],
            nom: '',
            email: '',
            contrasenya: '',
            confirmarContrasenya: '',
            estilMusica: '',
            tipusLocal: '',
            tipusMultimedia: '',
            multimedia: '',
            usuari: {},


        };
    },
    methods: {
        afegirUsuari(){

            this.validarDataform();
            
            const me = this;
            axios
            .post("usuaris", me.usuari )
            .then((response) => {

                
            })
            .catch((error) => {
            
            })
        },
        validarDataform(){

        },


        agafarTipuslocals(){
            const me = this;
            axios
            .get("TiposLocals")
            .then((response) => {
                console.log(response);
                me.tipusLocal = response.data
            })
            .catch((error) => {
            
            })     
        },
        agafarEstilMusic(){
            const me = this;
            axios
            .get("estilMusica")
            .then((response) => {
                console.log(response);
                me.estilMusica = response.data
            })
            .catch((error) => {
                
            })
        },
    },
    mounted(){
        this.agafarEstilMusic();
        this.agafarTipuslocals();
    }
};
</script>
<style>

</style>
