<template>
    <div v-for="music in musics" :key="music.id">
      <div id="quisom">
        <h1 class="display-1 fw-bold text-center larger-title">{{ music.nom_music }}</h1>
      </div>
    </div>
  </template>

  <script>
  export default {
    data() {
      return {
        musics: [],
        id: null // Declare a variable to store the ID
      }
    },

    mounted() {
      // Get the ID from the HTML element
      this.id = document.getElementById('app').getAttribute('data-id');

      // Make the axios request with the ID
      axios.get(`/musics/${this.id}`)
        .then(response => {
          console.log("Datos recibidos:", response.data); // Verifica la resposta en consola
          this.musics = response.data; // Assigns data to locals
        })
        .catch(error => {
          console.error("Error al cargar los datos:", error);
        });
    }
  }
  </script>

  <style>
  /* Aquí pots afegir els teus estils */
  </style>
