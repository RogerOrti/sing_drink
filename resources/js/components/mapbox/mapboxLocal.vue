<template>
    <div id="map" class="map-container"></div>
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
      const me = this;
      axios
      .get("/locals/${this.id}")
      .then((response =>{
        me.locals = response.data; // Asigna los datos a locals
        console.log(rutaLocal);
      }))
      }




    },


    mounted() {
      new mapboxgl.Map({
        accessToken: 'pk.eyJ1Ijoicm9nZXJvcnRpIiwiYSI6ImNtN3V0Z2h0ZDAzZzEyanF4cGxrNDBidWEifQ.Awl5Z-ARVRlGj-7lGEErag',
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v11',
        center: [2.154007, 41.390205], // Barcelona
        zoom: 12
      });


    }
  };
  </script>

  <style>
  .map-container {
    width: 100%;
    height: 500px;
  }
  </style>
