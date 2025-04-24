<template>
    <div id="map-Roger" class="map-container"></div>
</template>

  <script>
  import mapboxgl from 'mapbox-gl';

  export default {
    mounted() {
      new mapboxgl.Map({
        accessToken: 'pk.eyJ1Ijoicm9nZXJvcnRpIiwiYSI6ImNtN3V0Z2h0ZDAzZzEyanF4cGxrNDBidWEifQ.Awl5Z-ARVRlGj-7lGEErag',
        container: 'map-Roger',
        style: 'mapbox://styles/mapbox/streets-v11',
        center: [2.154007, 41.390205],
        zoom: 10
      });
    }
  };


  </script>

  <style scoped>
  .map-container {
    display: flex;
    width: 100%;
    height: 500px;
  }
  </style>
