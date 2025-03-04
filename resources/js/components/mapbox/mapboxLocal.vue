<template>
    <div id="map" class="map-container"></div>
  </template>

  <script>
  import mapboxgl from 'mapbox-gl';

  export default {
    mounted() {
      new mapboxgl.Map({
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
