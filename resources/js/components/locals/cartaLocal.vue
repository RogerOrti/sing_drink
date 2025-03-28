<template>
    <div class="cardsLocals">
      <div class="card" v-for="local in locals" :key="local.id" style="width: 18rem;">
        <div class="card-body">
            <img class="fotoCardLocals" :src="local.multimedia.ruta"/>
            <h5 class="card-title">{{ local.nom_local }}</h5>
            <h5 class="card-title">{{ local.direccio }}</h5>
            <a :href="'locals/' + local.id_local " class="btn btn-primary">Saber més</a>
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
