<template>
  <div class="d-flex container">
    <div id="map" class="map-container"></div>
  </div>
</template>

  <script>
  import axios from 'axios';
  import mapboxgl from 'mapbox-gl';

  export default {

    data(){
      return{
        locals: []
      }
    },

    methods: {

      obtenirRuta(){

        this.id = document.getElementById('app').getAttribute('data-id');

        // Make the axios request with the ID
        axios.get(`/locals/${this.id}`)
          .then(response => {
            console.log("Datos recibidos:", response.data); // Verifica la resposta en consola
            this.locals = response.data; // Assigns data to locals
          })
          .catch(error => {
            console.error("Error al cargar los datos:", error);
          });
      },

      rutaCoordenades(){},

      crearMarcador(){},

      crearMapa(){
        new mapboxgl.Map({
        accessToken: 'pk.eyJ1Ijoicm9nZXJvcnRpIiwiYSI6ImNtN3V0Z2h0ZDAzZzEyanF4cGxrNDBidWEifQ.Awl5Z-ARVRlGj-7lGEErag',
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v12',
        center: [2.154007, 41.390205], // Barcelona
        zoom: 13
      });
      }
    },

    mounted() {

      this.obtenirRuta();
      this.crearMapa();
      
    }
  };
  </script>

  <style>
  .map-container{
    max-width: 80rem;
    height: auto;
    margin: 5rem;
    border-radius: 1rem;
  }
  </style>
