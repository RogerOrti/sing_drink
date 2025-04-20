<template>
    <div>
      <h1>AFEGIR LOCAL</h1>
      <button @click="showForm()" class="anadirBoton">
        <strong>Afegir Local</strong>
      </button>
    </div>
  
    <div class="tabla-usuarios">
      <table class="table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Direcció</th>
            <th>Tipus de local</th>
            <th>Accions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="local in locals" :key="local.id_local">
            <td>{{ local.id_local }}</td>
            <td>{{ local.nom_local }}</td>
            <td>{{ local.direccio }}</td>
            <td>{{ local.tipo_local?.tipo_local || 'Sense tipus' }}</td>
            <td>
              <button @click="editLocal(local)" class="editarBoton">Editar</button>
              <button @click="eliminarLocal(local)" class="btn btn-danger">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                  viewBox="0 0 16 16">
                  <path
                    d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 
                    .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                  <path
                    d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 
                    1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 
                    1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 
                    4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 
                    1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                </svg>
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  
    <!-- Modal para eliminar -->
    <div class="modal" tabindex="-1" id="deleteModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Eliminar Local</h5>
          </div>
          <div class="modal-body">
            <p>Estàs segur que vols eliminar "{{ local.nom_local }}"?</p>
            <p v-if="isError" class="alert alert-danger">{{ messageError }}</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" @click="deleteLocal(local.id_local)">Eliminar</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel·lar</button>
          </div>
        </div>
      </div>
    </div>
  
    <!-- Modal Insertar / Editar -->
    <div class="modal" tabindex="-1" id="usuarioModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 v-if="insert" class="modal-title">Afegir Local</h5>
            <h5 v-else class="modal-title">Editar Local</h5>
          </div>
          <div class="modal-body">
            <form>
              <div class="form-outline mb-4">
                <label for="nomLocal">Nom del Local</label>
                <input type="text" class="form-control" id="nomLocal" v-model="local.nom_local" required>
              </div>
              <div class="form-outline mb-4">
                <label for="direccio">Direcció</label>
                <input type="text" class="form-control" id="direccio" v-model="local.direccio" required>
              </div>
              <div class="form-outline mb-4">
                <label for="tipoLocal">Tipus de Local</label>
                <select class="form-select" id="tipoLocal" v-model="local.id_tipo_local" required>
                  <option value="" disabled>Selecciona un tipus</option>
                  <option v-for="tipo in tiposLocal" :key="tipo.id_tipo_local" :value="tipo.id_tipo_local">
                    {{ tipo.tipo_local }}
                  </option>
                </select>
              </div>
            </form>
            <p v-if="isError" class="alert alert-danger">{{ messageError }}</p>
          </div>
          <div class="modal-footer">
            <button v-if="insert" type="button" class="btn btn-secondary" @click="insertLocal()">Crear</button>
            <button v-else type="button" class="btn btn-secondary" @click="updateLocal()">Guardar</button>
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Tancar</button>
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
      locals: [],
      tiposLocal: [],
      myModal: {},
      local: {},
      messageError: "",
      isError: false,
      insert: false
    };
  },

  created() {
    this.getLocals();
    this.getTiposLocal();
  },

  methods: {
    showForm() {
      this.insert = true;
      this.isError = false;
      this.myModal = new bootstrap.Modal('#usuarioModal');
      this.myModal.show();
      this.local = {};
    },

    getLocals() {
        const me = this;
      axios.get('locals')
        .then(response => {
            me.locals = response.data.data || response.data; // si usas API Resource
        })
        .catch(error => {
          console.log(error);
        });
    },

    getTiposLocal() {
        const me = this;
      axios.get('tipos-local')
        .then(response => {
            me.tiposLocal = response.data;
        })
        .catch(error => {
          console.log(error);
        });
    },

    insertLocal() {
        const me = this;
      const formData = new FormData();
      formData.append('nom_local', this.local.nom_local);
      formData.append('direccio', this.local.direccio);
      formData.append('id_tipo_local', this.local.id_tipo_local);

      axios.post('locals', formData)
        .then(() => {
            me.getLocals();
            me.myModal.hide();
        })
        .catch(error => {
          this.isError = true;
          this.messageError = error.response.data.message;
        });
    },

    updateLocal() {
        const me = this;
      axios.put(`locals/${this.local.id_local}`, this.local)
        .then(() => {
            me.getLocals();
            me.myModal.hide();
        })
        .catch(error => {
          this.isError = true;
          this.messageError = error.response.data.message;
        });
    },

    editLocal(local) {
      this.insert = false;
      this.local = { ...local };
      this.myModal = new bootstrap.Modal('#usuarioModal');
      this.myModal.show();
    },

    eliminarLocal(local) {
      this.local = local;
      this.myModal = new bootstrap.Modal('#deleteModal');
      this.myModal.show();
    },

    deleteLocal(id) {
        const me = this;
      axios.delete(`locals/${id}`)
        .then(() => {
            me.getLocals();
            me.myModal.hide();
        })
        .catch(error => {
          this.isError = true;
          me.messageError = error.response.data.message;
        });
    }
  }
};
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
