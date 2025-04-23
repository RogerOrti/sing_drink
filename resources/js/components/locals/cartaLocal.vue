<template>
    <div>
      <div class="cardsLocals">
        <div class="card m-4" v-for="local in locals" :key="local.id" style="width: 18rem;">
          <div class="card-body">
            <img class="fotoCardLocals m-2" :src="local.multimedia_local.ruta" />
            <h5 class="card-title m-1">{{ local.nom_local }}</h5>
            <h5 class="card-title m-1">{{ local.direccio }}</h5>
            <a :href="'local/' + local.id_local" class="btn btn-primary mt-2">Saber més</a>
          </div>

        </div>
      </div>

      <!-- Paginación -->
      <div class="pagination text-center my-4">
        <button class="btn btn-secondary mx-2" :disabled="currentPage === 1" @click="cambiarPagina(currentPage - 1)">
          Anterior
        </button>
        <span>Página {{ currentPage }} de {{ lastPage }}</span>
        <button class="btn btn-secondary mx-2" :disabled="currentPage === lastPage" @click="cambiarPagina(currentPage + 1)">
          Siguiente
        </button>
      </div>
    </div>
  </template>

  <script>
  import axios from "axios";

  export default {
    data() {
      return {
        locals: [],
        currentPage: 1,
        lastPage: 1
      };
    },
    mounted() {
      this.getLocals();
    },
    methods: {
      getLocals(page = 1) {
        axios.get("locals/paginado", { params: { page } })
          .then((response) => {
            this.locals = response.data.data;
            this.currentPage = response.data.meta.current_page;
            this.lastPage = response.data.meta.last_page;
          })
          .catch((error) => {
            console.error("Error al cargar los datos:", error);
          });
      },
      cambiarPagina(nuevaPagina) {
        if (nuevaPagina >= 1 && nuevaPagina <= this.lastPage) {
          this.getLocals(nuevaPagina);
        }
      }
    }
  };
  </script>
