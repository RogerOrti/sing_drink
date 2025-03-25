<template>
    <div class="cardsLocals">
      <div class="card" v-for="local in locals" :key="local.id" style="width: 18rem;">
        <div class="card-body">
          <h5 class="card-title">{{ local.nom_local }}</h5>
          <h5 class="card-title">{{ local.direccio }}</h5>
          <a href="#" class="btn btn-primary">Saber més</a>
        </div>
      </div>
    </div>
  </template>

  <script>


  export default {
    data() {
      return {
        locals: []
      }
    },

    mounted() {
        const me = this;
      axios.get("http://localhost/sing_drink/public/api/locals")
        .then(response => {
          console.log("Datos recibidos:", response.data); // Verifica la respuesta en consola
          me.locals = response.data.data; // Asigna los datos a locals
        })
        .catch(error => {
          console.error("Error al cargar los datos:", error);
        });
    }
  }
  </script>

  <style scoped>
  /* Aquí va el estilo personalizado */
  </style>
