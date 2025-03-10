<template>
    <div class="map-wrapper">
      <div id="map" class="map-container"></div>
    </div>
  </template>

  <script>
  import { onMounted, onBeforeUnmount } from "vue";
  import mapboxgl from "mapbox-gl";

  export default {
    setup() {
      let map;

      onMounted(() => {
        mapboxgl.accessToken = "pk.eyJ1IjoibG9zdHlybDciLCJhIjoiY204M2N5eGhhMHF5MTJqcmE1Y3Y1bm5keiJ9.2B5FzYtEPqL6ZIYbPLjQxg";

        map = new mapboxgl.Map({
          container: "map",
          style: "mapbox://styles/mapbox/streets-v11",
          center: [-3.70379, 40.41678], // Coordenadas de Madrid (España)
          zoom: 5, // Nivel de zoom para ver toda España
        });

        // Agregar controles de navegación
        map.addControl(new mapboxgl.NavigationControl());

        // Agregar un marcador en Madrid
        new mapboxgl.Marker().setLngLat([-3.70379, 40.41678]).addTo(map);

        // Agregar control de geolocalización (flecha)
        const geolocate = new mapboxgl.GeolocateControl({
          positionOptions: {
            enableHighAccuracy: true,
          },
          trackUserLocation: true, // Activa el seguimiento de la ubicación
        });

        map.addControl(geolocate);
        geolocate.trigger(); // Triggers the location update on load
      });

      onBeforeUnmount(() => {
        if (map) map.remove();
      });

      return {};
    },
  };
  </script>

  <style>
  .map-wrapper {
    width: 100%;
    height: 600px;
    position: relative;
    overflow: hidden;
  }

  .map-container {
    width: 100%;
    height: 100%;
  }

  .mapboxgl-ctrl-bottom-right,
  .mapboxgl-ctrl-top-right,
  .mapboxgl-ctrl-top-left,
  .mapboxgl-ctrl-bottom-left {
    position: absolute;
    z-index: 1;
  }

  .mapboxgl-ctrl {
    background: rgba(255, 255, 255, 0.7);
  }
  </style>
