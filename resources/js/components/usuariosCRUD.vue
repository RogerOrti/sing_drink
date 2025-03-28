<template>
    <div><button @click="showForm()" class="anadirBoton"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-square" viewBox="0 0 16 16">
  <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/>
  <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
</svg><strong> AÑADIR USUARIO</strong></button></div>
         <div  class="tabla-usuarios">
            <table class="table">
                <thead >
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
                        <td>{{ usuari.roluser.tipo_rol}}</td>

                        <th> <button @click="editUsuario(usuari)" class="editarBoton"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-pencil-square" >
                                    <path
                                        d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                    <path fill-rule="evenodd"
                                        d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                </svg></button></th>
                                <th>
                                    <button  @click="$event => eliminarUsuario(usuari)" style="border: none; background: none; cursor: pointer; color:rgb(255, 0, 0)">
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
    <div class="modal" tabindex="-1"  id="deleteModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Borrar usuari</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">

            </button>
        </div>
        <div class="modal-body">
            <p>¿ Seguro que quieres borrar a <strong>{{ usuari.nom }}</strong> ?</p>

            <p v-if="isError" class="alert alert-danger">{{ messageError }}</p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" @click="$event => deleteUsuario(usuari.id_user) ">Borrar</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        </div>
        </div>
    </div>
</div>

   <!-- modal insert/update -->
   <div class="modal" tabindex="-1"  id="usuarioModal">
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
                                <input type="text" name="nom" class="form-control" id="formNombre" required
                                    placeholder="Introducir nombre" v-model="usuari.nom">
                            </div>
                            <div data-mdb-input-init class="form-outline mb-4">
                                <label for="formInputFecha" class="form-label">Apellido</label>
                                <input type="text" name="cognom" class="form-control" id="formInputFecha"
                                    required v-model="usuari.cognom">
                            </div>
                            <div data-mdb-input-init class="form-outline mb-4">
                                <label for="formInputFecha" class="form-label">Correo</label>
                                <input type="email" name="mail" class="form-control" id="formInputFecha"
                                    required v-model="usuari.mail">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Contraseña</label>
                                <input type="password" name="contrasenya" class="form-control" id="exampleInputPassword1"
                                    required placeholder="Introducir contraseña" v-model="usuari.contrasenya">
                            </div>
                                  <select v-model="usuari.id_rol" class="form-select">
                            <option v-for="rol in roles" :key="rol.id_rol" :value="rol.id_rol">
                                {{ rol.tipo_rol }}
                            </option>
                                    </select>
                            </form>
                    <p v-if="isError" class="alert alert-danger">{{ messageError }}</p>
        </div>
        <div class="modal-footer">
            <button v-if="insert" type="button" class="btn btn-secondary" @click="insertUsuarios()">Crear</button>
            <button v-else type="button" class="btn btn-secondary" @click="updateUsuarios()">Editar</button>
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>
        </div>
        </div>
    </div>
</div>
</template>
<script>
import * as bootstrap from 'bootstrap';

export default {
    data() {
        return{
            usuarios: [],
            roles: [],
            myModal : {},
            usuario: {},
            messageError : "",
            isError : false,
            insert : false
        }
    },

    created() {
       this.selectUsuario();
       this.getRoles();

    },
        methods: {
            showForm(){
                this.insert = true;
                this.isError = false
                this.myModal = new bootstrap.Modal('#usuarioModal')
                this.myModal.show();
                this.usuario = {};
            },
            getRoles(){
                const me = this;
                axios.get('rol')
                .then(response =>{
                    me.roles = response.data;
                })
                .catch(error => {
                    console.log(error);
                });
            },
            updateUsuarios(){
                const me = this;
                axios.put('usuario'+ me.usuario.id, me.usuario)
                .then(response => {
                    me.selectUsuario();
                    me.myModal.hide();
                })
                .catch(error => {
                    this.isError = true;
                    me.messageError = error.response.data.message;
                });
            },
            insertUsuarios(){
                const me = this;
                axios.post('usuario', me.usuario)
                .then(response => {
                    me.selectUsuario();
                    me.myModal.hide();
                })
                .catch(error => {
                    this.isError = true;
                    me.messageError = error.response.data.message;
                });
            },selectUsuario(){
                const me = this;
                axios.get('usuario')
                .then(response => {
                    me.usuarios = response.data;
                })
                .catch(error => {
                    console.log(error);
                });
            },
            editUsuario(usuario){
                this.insert = false;
                this.usuario = usuario;
                this.myModal = new bootstrap.Modal('#usuarioModal')
                this.myModal.show();
            },
        eliminarUsuario(usuario) {
            this.isError = false;
            this.usuario = usuario;
           this.myModal = new bootstrap.Modal('#deleteModal')
              this.myModal.show();
        },
        deleteUsuario(id){
            const me = this;
            axios.delete("usuario/" + id)
            .then(response => {
                me.selectUsuario()
                me.myModal.hide()
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
.tabla-usuarios{
    margin-top: 20px;
    margin-bottom: 20px;
    background-color: #bead60;
    border-radius: 20px;
    padding: 10px;
    display: flex;
    color: #ffffff;
    width: 100rem;
    margin-left: 10rem;
}
.editarBoton{
    border: none;
    background: none;
    cursor: pointer;
    color: #2EBFA5;
}
    .anadirBoton{
        margin-left: 10rem;
        border: none;
        background: none;
        cursor: pointer;
        color: #2EBFA5;
    }
</style>
