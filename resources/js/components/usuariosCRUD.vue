<template>
    <div>
        <H1>AFEGIR USUARI</H1>
      <button @click="showForm()" class="anadirBoton">
        <strong> Afegir Usuari</strong>
      </button>
    </div>
  
    <div class="tabla-usuarios">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Nom</th>
            <th scope="col">Cognom</th>
            <th scope="col">Mail</th>
            <th scope="col">Contraseña</th>
            <th scope="col">Rol</th>
            <th scope="col">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="usuari in usuaris" :key="usuari.id_user">
            <th scope="row">{{ usuari.id_user }}</th>
            <td>{{ usuari.nom }}</td>
            <td>{{ usuari.cognom }}</td>
            <td>{{ usuari.mail }}</td>
            <td>{{ usuari.contrasenya }}</td>
            <td>{{ usuari.roluser ? usuari.roluser.tipo_rol : 'No rol asignado' }}</td>
            <th>
              <button @click="editUsuario(usuari)" class="editarBoton">
                Editar
              </button>
            </th>
            <th>
              <button @click="eliminarUsuario(usuari)" class="btn btn-danger">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                            <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                                        </svg>
              </button>
            </th>
          </tr>
        </tbody>
      </table>
    </div>
  
    <!-- Modal para borrar-->
    <div class="modal" tabindex="-1" id="deleteModal">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Borrar usuari {{ usuari.nom }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p >¿Seguro que quieres borrar a {{ usuari.nom }}?</p>
            <p v-if="isError" class="alert alert-danger">{{ messageError }}</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" @click="$event => deleteUsuario(usuari.id_user)">Borrar</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          </div>
        </div>
      </div>
    </div>
  
    <!-- Modal para Insertar/Actualizar -->
    <div class="modal" tabindex="-1" id="usuarioModal">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 v-if="insert" class="modal-title">Crear usuari</h5>
            <h5 v-else class="modal-title">Modificar usuari</h5>
          </div>
          <div class="modal-body">
            <form>
              <div data-mdb-input-init class="form-outline mb-4">
                <label for="formNombre" class="form-label">Nombre de usuari</label>
                <input type="text" name="nom" class="form-control" id="formNombre" required placeholder="Introducir nombre" v-model="usuari.nom">
              </div>
              <div data-mdb-input-init class="form-outline mb-4">
                <label for="formInputFecha" class="form-label">Apellido</label>
                <input type="text" name="cognom" class="form-control" id="formInputFecha" required v-model="usuari.cognom">
              </div>
              <div data-mdb-input-init class="form-outline mb-4">
                <label for="formMail" class="form-label">Correo Electrónico</label>
                <input type="email" name="mail" class="form-control" id="formMail" required v-model="usuari.mail">
              </div>
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Contraseña</label>
                <input type="password" name="contrasenya" class="form-control" id="exampleInputPassword1" required placeholder="Introdueix la contrasenya" v-model="usuari.contrasenya">
              </div>
              <div class="form-outline mb-4">
                <label for="formRol" class="form-label">Rol</label>
                <select v-model="usuari.id_rol" class="form-select" id="formRol" required>
                  <option value="" disabled>Selecciona un rol</option>
                  <option v-for="rol in roles" :key="rol.id_rol" :value="rol.id_rol">
                    {{ rol.tipo_rol }}
                  </option>
                </select>
              </div>
            </form>
            <p v-if="isError" class="alert alert-danger">{{ messageError }}</p>
          </div>
          <div class="modal-footer">
            <button v-if="insert" type="button" class="btn btn-secondary" @click="insertUsuarios()">Crear</button>
            <button v-else type="button" class="btn btn-secondary" @click="updateUsuarios()">Editar</button>
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
          return{
              usuaris: [],
              roles: [],
              myModal: {},
              usuari: {},
              messageError: "",
              isError: false,
              insert: false
          }
      },
  
      created() {
         this.selectUsuario();
         this.getRoles();
         this.getRoles();
      },
  
      methods: {
          showForm() {
              this.insert = true;
              this.isError = false;
              this.myModal = new bootstrap.Modal('#usuarioModal');
              this.myModal.show();
              this.usuari = {};
          },
  
          getRoles() {
              const me = this;
              axios.get('rol')
                  .then(response => {
                      me.roles = response.data;
                  })
                  .catch(error => {
                      console.log(error);
                  });
          },
  
          updateUsuarios() {
              const me = this;
              axios.put('usuaris/' + me.usuari.id_user, me.usuari)
                  .then(response => {
                      me.selectUsuario();
                      me.myModal.hide();
                  })
                  .catch(error => {
                      this.isError = true;
                      me.messageError = error.response.data.message;
                  });
          },
  
          insertUsuarios() {
              const me = this;
              const formData = new FormData();
              formData.append('nom', me.usuari.nom);
              formData.append('cognom', me.usuari.cognom);
              formData.append('mail', me.usuari.mail);
              formData.append('contrasenya', me.usuari.contrasenya);
              formData.append('id_rol', me.usuari.id_rol);  
  
              axios.post('usuaris', formData, {
                  headers: {
                      'Content-Type': 'multipart/form-data'
                  }
              })
              .then(response => {
                  me.selectUsuario();
                  me.myModal.hide();
              })
              .catch(error => {
                  this.isError = true;
                  me.messageError = error.response.data.message;
              });
          },
  
          selectUsuario() {
              const me = this;
              axios.get('usuaris')
                  .then(response => {
                      me.usuaris = response.data;
                  })
                  .catch(error => {
                      console.log(error);
                  });
          },
  
          editUsuario(usuari) {
              this.insert = false;
              this.usuari = usuari;
              this.myModal = new bootstrap.Modal('#usuarioModal');
              this.myModal.show();
          },
  
          eliminarUsuario(usuari) {
              this.isError = false;
              this.usuari = usuari;
              this.myModal = new bootstrap.Modal('#deleteModal');
              this.myModal.show();
          },
  
          deleteUsuario(id) {
              const me = this;
              axios.delete("usuaris/" + id)
                  .then(response => {
                      me.selectUsuario();
                      me.myModal.hide();
                  })
                  .catch(error => {
                      this.isError = true;
                      me.messageError = error.response.data.message;
                  });
          }
      },
  
      mounted() {}
  }
  </script>
  
<style>
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
