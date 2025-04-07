<template>
    <div class="cardsLocals">
      <div class="card m-4" v-for="local in locals" :key="local.id" style="width: 18rem;">
        <div class="card-body">
            <img class="fotoCardLocals m-2" :src="local.multimedia.ruta"/>
            <h5 class="card-title m-1">{{ local.nom_local }}</h5>
            <h5 class="card-title m-1">{{ local.direccio }}</h5>
            <a :href="'local/' + local.id_local " class="btn btn-primary mt-2">Saber més</a>
        </div>
      </div>
    </div>
  </template>

  <script>
import axios from 'axios';

  export default {
    data() {
      return {
        locals: []
      }
    },
    mounted() {
        const me = this;
      axios.get("locals")
        .then(response => {
          console.log("Datos recibidos:", response.data); // Verifica la respuesta en consola
          me.locals = response.data; // Asigna los datos a locals
        })
        .catch(error => {
          console.error("Error al cargar los datos:", error);
        });

        // axios.get("locals/local.id")
        // .then(response => {
        //   console.log("Datos recibidos:", response.data); // Verifica la respuesta en consola
        //   me.locals = response.data; // Asigna los datos a locals
        //   href = local  ;
        // })
        // .catch(error => {
        //   console.error("Error al cargar los datos:", error);
        // });
    }
  }
  </script>
