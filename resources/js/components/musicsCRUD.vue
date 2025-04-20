<template>
    <div class="container mt-5">
      <div class="d-flex justify-content-between mb-3">
        <h2>Gestión de Música</h2>
        <button class="btn btn-primary" @click="showForm">+ Añadir música</button>
      </div>
  
      <div class="table-responsive">
        <table class="table table-bordered table-hover">
          <thead class="table-dark">
            <tr>
              <th>ID</th>
              <th>Usuario</th>
              <th>Estilo</th>
              <th>Multimedia</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="m in musics" :key="m.id">
              <td>{{ m.id }}</td>
              <td>{{ m.user?.nom }}</td>
              <td>{{ m.estil?.nom }}</td>
              <td>{{ m.multimedia?.ruta }}</td>
              <td>
                <button class="btn btn-warning btn-sm me-2" @click="editMusica(m)">Editar</button>
                <button class="btn btn-danger btn-sm" @click="eliminarMusica(m)">Eliminar</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
  
      <!-- Modal Formulario -->
      <div class="modal fade" id="usuarioModal" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">{{ insert ? 'Añadir música' : 'Editar música' }}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
              <div v-if="isError" class="alert alert-danger">{{ messageError }}</div>
  
              <div class="mb-3">
                <label for="id_user" class="form-label">Usuario</label>
                <select class="form-select" v-model="music.id_user">
                  <option disabled value="">Seleccione un usuario</option>
                  <option v-for="u in usuaris" :key="u.id_user" :value="u.id_user">
                    {{ u.nom }}
                  </option>
                </select>
              </div>
  
              <div class="mb-3">
                <label for="id_estil" class="form-label">Estilo musical</label>
                <select class="form-select" v-model="music.id_estil">
                  <option disabled value="">Seleccione un estilo</option>
                  <option v-for="e in estilMusica" :key="e.id_estil" :value="e.id_estil">
                    {{ e.nom }}
                  </option>
                </select>
              </div>
  
              <div class="mb-3">
                <label for="id_multimedia" class="form-label">Multimedia</label>
                <select class="form-select" v-model="music.id_multimedia">
                  <option disabled value="">Seleccione un archivo</option>
                  <option v-for="m in multimedia" :key="m.id_multimedia" :value="m.id_multimedia">
                    {{ m.ruta }}
                  </option>
                </select>
              </div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
              <button class="btn btn-primary" @click="insert ? insertMusica() : updateMusica()">
                {{ insert ? 'Guardar' : 'Actualizar' }}
              </button>
            </div>
          </div>
        </div>
      </div>
  
      <!-- Modal Confirmación Eliminar -->
      <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Confirmar eliminación</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
              ¿Estás seguro que quieres eliminar esta música?
              <div class="mt-2 text-danger" v-if="isError">{{ messageError }}</div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
              <button class="btn btn-danger" @click="deleteMusica(music.id)">Eliminar</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>
  
<script>
import * as bootstrap from 'bootstrap';
import axios from 'axios';

export default {
  data() {
    return {
      musics: [],
      estilMusica: [],
      multimedia: [],
      usuaris: [],
      myModal: {},
      music: {},
      messageError: "",
      isError: false,
      insert: false
    };
  },

  created() {
    this.selectMusics();
    this.getUsuaris();
    this.getEstils();
    this.getMultimedias();
  },

  methods: {
    showForm() {
      this.insert = true;
      this.isError = false;
      this.myModal = new bootstrap.Modal('#usuarioModal');
      this.myModal.show();
      this.music = {};
    },

    getUsuaris() {
      axios.get('usuaris')
        .then(res => this.usuaris = res.data)
        .catch(err => console.log(err));
    },

    getEstils() {
      axios.get('estils')
        .then(res => this.estilMusica = res.data)
        .catch(err => console.log(err));
    },

    getMultimedias() {
      axios.get('multimedias')
        .then(res => this.multimedia = res.data)
        .catch(err => console.log(err));
    },

    insertMusica() {
      const me = this;
      axios.post('musics', me.music)
        .then(response => {
          me.selectMusics();
          me.myModal.hide();
        })
        .catch(error => {
          this.isError = true;
          me.messageError = error.response.data.message;
        });
    },

    updateMusica() {
      const me = this;
      axios.put('musics/' + me.music.id, me.music)
        .then(response => {
          me.selectMusics();
          me.myModal.hide();
        })
        .catch(error => {
          this.isError = true;
          me.messageError = error.response.data.message;
        });
    },

    selectMusics() {
      axios.get('musics')
        .then(res => this.musics = res.data)
        .catch(err => console.log(err));
    },

    editMusica(music) {
      this.insert = false;
      this.music = { ...music };
      this.myModal = new bootstrap.Modal('#usuarioModal');
      this.myModal.show();
    },

    eliminarMusica(music) {
      this.isError = false;
      this.music = music;
      this.myModal = new bootstrap.Modal('#deleteModal');
      this.myModal.show();
    },

    deleteMusica(id) {
      axios.delete("musics/" + id)
        .then(() => {
          this.selectMusics();
          this.myModal.hide();
        })
        .catch(error => {
          this.isError = true;
          this.messageError = error.response.data.message;
        });
    }
  }
}
</script>

<style scoped>
.editarBoton {
    background-color: #4CAF50;
    border: none;
    color: white;
    padding: 10px 20px;
    cursor: pointer;
    border-radius: 5px;
}

.editarBoton:hover {
    background-color: #45a049;
}

.btn-danger {
    background-color: #f44336;
    border: none;
    color: white;
    padding: 10px 20px;
    cursor: pointer;
    border-radius: 5px;
}

.btn-danger:hover {
    background-color: #e53935;
}

.anadirBoton {
    margin-right: 80rem;
        border: none;
        background: none;
        cursor: pointer;
        color: #000000 ;
}

.modal .modal-body,
.modal .modal-header,
.modal .modal-footer,
.modal .form-label,
.modal .form-control, p {
    color: #000000;
}

.tabla-usuarios{
    margin-top: 20px;
    margin-bottom: 20px;
    background-color: #ffffff;
    border-radius: 20px;
    padding: 10px;
    display: flex;
    color: #000000;
    width: 100rem;
    margin-left: 10rem;
}
.editarBoton{
    border: none;
    background: none;
    cursor: pointer;
    color: #2EBFA5;
}

</style>
