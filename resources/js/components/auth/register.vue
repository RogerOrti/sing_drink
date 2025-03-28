<template>
    <div id="register" class="">
        <div>
            <div class="container rounded-4 mt-3 bg-primary ">
                <h4 class="card-title text-center">Registre d'Usuari</h4>
                <form>
                    <div class="mb-3">
    <label for="" class="form-label">Tipus usuari</label>
    <div class="switch-container" @click="toggleUserType">
        <div class="switch">
            <div class="circle" :class="{'switch-right': usuari.tipus_usuari === '3'}"></div>
        </div>
        <span class="label">
            {{ usuari.tipus_usuari === '2' ? 'Músic' : 'Propietari' }}
        </span>
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
                     <div v-if="usuari.tipus_usuari == 2">
                        <div class="mb-3">
                        <label for="">Estil musica</label>
                            <select class="form-select" v-model="estilMusica">
                                <option selected>Open this select menu</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>

                        <div>
                            <label for="">Multimedia</label>
                            <input class="form-control" type="file" name="multimedia" id="multimedia" @change="agafarMultimedia">
                        </div>
                    </div>


                    <!-- Formulari de dades Porpietari -->

                    <div v-else-if="usuari.tipus_usuari == 3">
                        <div class="mb-3">
                            <div class="mb-3">
                                <label for="" class="form-label">Nom local</label>
                                <input type="password" class="form-control" id="nom_local" name="nom_local" v-model="usuari.nom_local" required>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Adreça del local</label>
                                <input type="text" class="form-control" id="direccio" name="direccio" v-model="usuari.direccio" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tipus local</label>
                                <select v-model="tipusLocal" class="form-control">
                                    <option value="">Selecciona un tipus</option>
                                    <option v-for="tipus in tipusLocals" :key="tipus.id_tipo_local" :value="tipus.tipo_local">
                                        {{ tipus.tipo_local }}
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <button @click="afegirUsuari" class="btn btn-secondary">Registrar-se</button>
                </form>
            </div>
        </div>
    </div>
</template>
<script>


export default {

    data(){

        return{

            tipusLocals: [],
            estilMusica: [],
            // nom: '',
            // email: '',
            // contrasenya: '',
            // confirmarContrasenya: '',
            // estilMusica: '',
            // tipusLocal: '',
            // tipusMultimedia: '',
            // multimedia: '',
            usuari: {
                tipus_usuari: '2',
                multimedia: null
            },


        };
    },
    methods: {
        toggleUserType() {
        this.usuari.tipus_usuari = this.usuari.tipus_usuari === '2' ? '3' : '2';
    },
        afegirUsuari(){

            this.validarDataform();

            const me = this;
            axios
            .post("usuaris", me.usuari )
            .then((response) => {
                me.usuari = response.data;
                console.log(response);
                alert("Usuari creat correctament");

            })
            .catch((error) => {
                error.response.data.errors.forEach((error) => {
                    alert(error);
                });
            })
        },
        agafarMultimedia(event){
            const me = this;

            me.usuari.multimedia = event.target.files[0];

        },

        validarDataform(){
            // if (!this.image){
            //     alert("No has seleccionat cap imatge");
            //     return;
            // }

            // const formData = new FormData();
            // formData.append('image', this.image);

            // try{
            //     const me = this;
            // axios
            // .post("usuaris", me.usuari )

            // }catch(error){
            //     console.error("Error al validar el formulari: " + error);
            // }
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
                console.error("Error en agafar les dades de local" + error)
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
                console.error("Error en agafar les dades de estil" + error)
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
.switch-container {
  display: flex;
  align-items: center;
  cursor: pointer;
  user-select: none;
}

.switch {
  width: 50px;
  height: 25px;
  border: 2px solid #fff;
  border-radius: 25px;
  position: relative;
  display: flex;
  align-items: center;
  padding: 2px;
  background: #ddd;

}

.circle {
  width: 20px;
  height: 20px;
  background: white;
  border-radius: 50%;
  position: absolute;
  left: 2px;
  transition: left 0.3s;
}

.switch-right {
  left: 26px; /* Se mueve a la derecha cuando es 'Propietari' */
}

.label {
  margin-left: 10px;
  font-size: 16px;
  color: white;
}


</style>
