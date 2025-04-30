<template>
    <div class="text-center my-4">
      <button class="btn btn-primary" @click="mostrarMenu()"> Contractar</button>
    </div>

    <div class="modal-custom" v-if="mostrarMenuMultimedia">
      <div class="formulario-custom p-4 rounded shadow">
        <div class="text-end">
          <button class="btn-close" @click="mostrarMenuMultimedia = false"></button>
        </div>

        <div v-if="musicos.length > 0" class="row">
          <div v-for="musico in musicos" :key="musico.id_user" class="col-md-4 col-6 mb-3 d-flex justify-content-center">
            <div class="musico-card">
              <img :src="musico.multimedia_music[0].ruta" alt="Foto del músico" class="musico-img">
              <span class="musico-name">{{ musico.user.nom }}</span>
            </div>
          </div>
        </div>

        <div v-else>
          <p>No hay músicos disponibles.</p>
        </div>
      </div>
    </div>
  </template>

  <script>
  export default {
    data() {
      return {
        mostrarMenuMultimedia: false,
        musicos: [], // Aquí guardaremos la lista de músicos no contratados
      };
    },
    methods: {
      mostrarMenu() {
        this.mostrarMenuMultimedia = true;
        this.obtenerMusicos();
      },
      obtenerMusicos() {
        axios.get('/musicos-no-contratados')
          .then((response) => {
            this.musicos = response.data; // Guardamos los músicos no contratados
          })
          .catch((error) => {
            console.error("Error al obtener los músicos", error);
          });
      }
    }
  };
  </script>

  <style scoped>
  span{
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
    width: 90%;
    max-width: 800px; /* Esto hace que el modal tenga un tamaño máximo */
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    overflow-y: auto;
  }

  .musico-card {
    display: flex;
    flex-direction: column;
    align-items: center;
  }

  .musico-img {
    width: 200px;
    height: 100px;
    object-fit: cover;
    margin-bottom: 10px;
  }

  .musico-name {
    font-weight: bold;
  }

  @media (max-width: 768px) {
    .musico-img {
      width: 60px;
      height: 60px;
    }
    .formulario-custom {
      width: 95%; /* Aumentar el tamaño en pantallas más pequeñas */
      padding: 10px;
    }
  }
  </style>
