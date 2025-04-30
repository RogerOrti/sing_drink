<template>
    <div class="text-center my-4">
      <button class="btn btn-primary" @click="mostrarMenu()">Afegir Multimedia</button>
    </div>

    <div class="modal-custom" v-if="mostrarMenuMultimedia">
      <div class="formulario-custom p-4 rounded shadow">
        <div class="text-end">
          <button class="btn-close" @click="mostrarMenuMultimedia = false"></button>
        </div>
        <div class="mb-3">
          <label class="form-label">Multimedia</label>
          <input class="form-control" type="file" @change="agafarMultimedia">
        </div>
        <div class="mb-3">
          <label class="form-label">Escull el tipus de multimedia</label>
          <select class="form-select" v-model="usuari.tipuMultimedia">
            <option v-for="MultimediaUnico in TipusMultimedia" :key="MultimediaUnico.id_tipo_multimedia" :value="MultimediaUnico.id_tipo_multimedia">
              {{ MultimediaUnico.tipo_multimedia }}
            </option>
          </select>
        </div>
        <div class="text-center">
          <button class="btn btn-success mt-3" @click="subirMulmedia">Pujar Multimedia</button>
        </div>
      </div>
    </div>
  </template>


<script>
export default {
    props: {
        userId: {
            type: Number,
            required: true
        }
    },
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
            formData.append("file", this.usuari.multimedia);
            formData.append("id_user",this.userId)
            for (const pair of formData.entries()) {
            console.log(`${pair[0]}:`, pair[1]);
}
            axios
                .post("multimediaMusic", formData)
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
                        alert("error al subir el multimedia.");
                        console.log(this.usuari.tipuMultimedia)
                        console.log(this.usuari.multimedia)
                        console.log(this.userId)
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
.modal-custom {
  position: fixed;
  top: 0;
  left: 0;
  z-index: 9999;
  width: 100vw;
  height: 100vh;
  background-color: rgba(0, 0, 0, 0.6);
  display: flex;
  justify-content: center;
  align-items: center;
}

.formulario-custom {
  background-color: white;
  width: 400px;
}


</style>
