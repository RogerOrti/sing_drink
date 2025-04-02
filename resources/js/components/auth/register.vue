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
                        <input type="text" class="form-control" v-model="usuari.nom" name="nom" required>
                    </div>
                    <div class="mb-3">
                        <label for="nom" class="form-label">Cognom</label>
                        <input type="text" class="form-control" v-model="usuari.cognom" name="cognom" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" v-model="usuari.email" name="email" required>
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
                            <select class="form-select" v-model="usuari.estilMusica">
                                <option v-for="estil in estilsMusica" :key="estil.id_estil" :value="estil.id_estil">
                                    {{ estil.estil_musica }}
                                </option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Multimedia</label>
                            <input class="form-control" type="file" name="multimedia" id="multimedia" @change="agafarMultimedia">
                        </div>
                    </div>


                    <!-- Formulari de dades Porpietari -->

                    <div v-else-if="usuari.tipus_usuari == 3">
                        <div class="mb-3">
                            <div class="mb-3">
                                <label for="" class="form-label">Nom local</label>
                                <input type="text" class="form-control" id="nom_local" name="nom_local" v-model="usuari.nom_local" required>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Adreça del local</label>
                                <input type="text" class="form-control" id="direccio" name="direccio" v-model="usuari.direccio" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tipus local</label>
                                <select v-model="usuari.tipusLocal" class="form-control" name="tipusLocal">
                                    <option v-for="tipus in tipusLocals" :key="tipus.id_tipo_local" :value="tipus.id_tipo_local">
                                        {{ tipus.tipo_local }}
                                    </option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="">Multimedia</label>
                                <input class="form-control" type="file" name="multimedia" id="multimedia" @change="agafarMultimedia">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <button @click="afegirUsuari" class="btn btn-secondary">Registrar-se</button>
                    </div>
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
            estilsMusica: [],
            usuari: {
                tipus_usuari: 2,
                multimedia: null
            },
            usuariErrors: {
                nom: false,
                cognom: false,
                email: false,
                contrasenya: false,
                estilMusica: false,
                nom_local: false,
                direccio: false,
                tipusLocal: false
            },
            errors:{},


        };
    },
    methods: {
        toggleUserType() {
        this.usuari.tipus_usuari = this.usuari.tipus_usuari === '2' ? '3' : '2';
    },
        afegirUsuari(){

            this.validarDataform();

            formData = new FormData();
            formData.append("nom", this.usuari.nom);

            if(!this.usuari.multimedia){
                formData.append("file", this.usuari.multimedia);
            }
            

            axios
            .post("usuaris", formData )
            .then((response) => {
                
                // formData = response.data;

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
            
            if(!this.usuari.nom){
                console.log("No s'ha escrit el nom");
                this.usuariErrors.nom = true;
            }
            if(!this.usuari.cognom){
                console.log("No s'ha escrit el cognom");
                this.usuariErrors.cognom = true;
            }
            if(!this.usuari.email){
                console.log("No s'ha escrit el email");
                this.usuariErrors.email = true;
            }
            if(!this.usuari.contrasenya){
                console.log("No s'ha escrit la contrasenya");
                this.usuariErrors.contrasenya = true;
            }

            
            switch (this.usuari.tipus_usuari) {
                case 2: //Music
                    if(!this.usuari.estilMusica){
                        console.log("No s'ha indicat l'estil de musica");
                        this.usuariErrors.estilMusica = true;
                    }
                    break;
            
                case 3: //
                    if(!this.usuari.nom_local){
                        console.log("No s'ha escrit el nom_local");
                        this.usuariErrors.nom_local = true;
                        }
                    if(!this.usuari.tipusLocal){
                        console.log("No s'ha indicat el tipus de local");
                        this.usuariErrors.tipusLocal = true;
                    }
                    break;    
                default:
                    break;
            }
        },

        agafarTipuslocals(){
            const me = this;
            axios
            .get("tipusLocal")
            .then((response) => {
                console.log(response);
                me.tipusLocals = response.data
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
                me.estilsMusica = response.data
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
