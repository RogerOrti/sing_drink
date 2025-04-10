<template>
    <button @click="mostrarMenu()">Afegir Multiemdia</button>
    <div class="modal" v-if="mostrarMenuMultimedia">
        <div class="formulario">
            <div class="mb-3">
                <label for="" class="form-label">Multimedia</label>
                <input class="form-control" type="file" name="multimedia" id="multimedia" @change="agafarMultimedia">
                <label for=""> Escull el tipus de multimedia</label>
                <select name="multimedia" id="multimedia" class="form-label" v-model="this.usuari.tipuMultimedia">
                    <option v-for="MultimediaUnico in TipusMultimedia" :key="MultimediaUnico.id_tipo_multimedia" :value="MultimediaUnico.id_tipo_multimedia" >
                        {{ MultimediaUnico.tipo_multimedia }}
                    </option>
                </select>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            usuari: {},
            mostrarMenuMultimedia: false,
            TipusMultimedia: [],
        }
    },

    mounted() {
        this.getMultimedia();
    },
    created() {
        this.getMultimedia();
    },
    methods: {
        mostrarMenu() {
            this.mostrarMenuMultimedia = true;
        },
        agafarMultimedia(event) {
            const me = this;
            me.usuari.multimedia = event.target.files[0];
        },
        subirMulmedia() {
            const formData = new FormData();
            formData.append("id_tipo_multimedia",this.usuari.tipuMultimedia)
            formData.append("ruta", this.usuari.multimedia);
            axios
                .post("multimedia", formData)
                .then((response) => {
                    console.log(response.data);
                    alert("Multimedia Subida");
                })
                .catch((error) => {
                    if (error.response && error.response.data.errors) {
                        error.response.data.errors.forEach((err) => {
                            alert(err);
                        });
                    } else {
                        alert("S'ha produït un error en el registre de l'usuari.");
                    }
                });
        },
        getMultimedia(){
            axios
                .get("tipusMultimedia")
                .then((response) => {
                    this.TipusMultimedia = response.data
                    console.log(this.TipusMultimedia)
                })
                .catch((error) => {
                    console.error("Error" , error)
                });
        }

    }
}
</script>

<style>
select, option{
    color: black;
}
.modal {
    display: flex;
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100vh;
    background-color: rgba(0, 0, 0, 0.568);
    justify-content: center;
    align-items: center;
}

.formulario {
    width: 500px;
    height: 500px;
    border: solid 1px red;
    background-color: white;
    align-items: center;
    color: black;
}
</style>
