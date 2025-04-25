<template>
  <div class="d-flex container">
    <div id="map-R" class="map-container"></div>
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

      rutaCoordenades(){
        





      },



      crearMapa(){
       const map = new mapboxgl.Map({
        accessToken: 'pk.eyJ1Ijoicm9nZXJvcnRpIiwiYSI6ImNtN3V0Z2h0ZDAzZzEyanF4cGxrNDBidWEifQ.Awl5Z-ARVRlGj-7lGEErag',
        container: 'map-R',
        style: 'mapbox://styles/mapbox/streets-v12',
        center: [2.154007, 41.390205], // Barcelona
        zoom: 13
      })
      new mapboxgl.Marker({
          color: "#222E50",
          draggable: true
          }).setLngLat([2.154007, 41.390205])
        .addTo(map);;
      },

      crearMarcador(){
        
      }
    },

    mounted() {

      this.obtenirRuta();
      this.crearMapa();

    }
  };
  </script>

  <style scoped>
  .map-container{
    width: 100%;
    height: 30rem;
    margin: 20px;
    border-radius: 20px;
  }
  </style>
