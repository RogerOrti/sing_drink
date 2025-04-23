<template>
    <div class="map-wrapper">
      <div id="map-P" class="map-container"></div>
    </div>
  </template>

  <script>
  import { onMounted, onBeforeUnmount } from "vue";
  import mapboxgl from "mapbox-gl";
  import axios from "axios"; // Asegúrate de tener axios importado

  export default {
    setup() {
      let map;
      const locations = [];

      const geocodeAddress = (address) => {
        return new Promise((resolve, reject) => {
          const geocodeUrl = `https://api.mapbox.com/geocoding/v5/mapbox.places/${encodeURIComponent(address)}.json?access_token=${mapboxgl.accessToken}`;
          axios
            .get(geocodeUrl)
            .then((response) => {
              if (response.data.features.length > 0) {
                const { center } = response.data.features[0]; // [lng, lat]
                resolve(center);
              } else {
                reject("No se encontró la dirección");
              }
            })
            .catch((error) => reject(error));
        });
      };

      onMounted(() => {
        mapboxgl.accessToken =
          "pk.eyJ1IjoibG9zdHlybDciLCJhIjoiY204M2N5eGhhMHF5MTJqcmE1Y3Y1bm5keiJ9.2B5FzYtEPqL6ZIYbPLjQxg";

        map = new mapboxgl.Map({
          container: "map-P",
          style: "mapbox://styles/mapbox/streets-v12",
          zoom: 12,
        });

        // Agregar controles de navegación
        map.addControl(new mapboxgl.NavigationControl());

        // Crear un objeto de tipo Bounds
        const bounds = new mapboxgl.LngLatBounds();
        axios
          .get("locals") // Asegúrate de que la URL sea correcta
          .then(async (response) => {
            const data = response.data;

            // Procesar cada local
            for (const location of data) {
              try {
                const coords = await geocodeAddress(location.direccio); // Obtener lat y lng
                locations.push({
                  lat: coords[1],
                  lng: coords[0],
                  title: location.nom_local,
                  img: location.multimedia_local.ruta,
                });

                new mapboxgl.Marker()
                  .setLngLat([coords[0], coords[1]])
                  .setPopup(
                    new mapboxgl.Popup({
                      offset: 25,
                    }).setHTML(`
                      <div style="color: black; font-size: 12px;">
                        <h4 style="margin: 0; font-size: 14px;">${location.nom_local}</h4>
                        <img src="${location.multimedia_local.ruta}" alt="${location.nom_local}" style="width: 100%; height: auto; margin-top: 10px; border-radius: 8px;" />
                      </div>
                    `)
                  ) // Popup con el texto y la imagen
                  .addTo(map);

                // Extiende los límites del mapa para incluir cada marcador
                bounds.extend([coords[0], coords[1]]);
              } catch (error) {
                console.error("Error al geocodificar la dirección:", error);
              }
            }

            // Ajustar el mapa para que se vean todos los puntos
            map.fitBounds(bounds, {
              padding: { top: 50, bottom: 50, left: 50, right: 50 },
            });
          })
          .catch((error) => {
            console.error("Error al cargar los datos:", error);
          });

        // Agregar control de geolocalización
        map.addControl(new mapboxgl.GeolocateControl());
      });

      onBeforeUnmount(() => {
        if (map) map.remove();
      });

      window.addEventListener("resize", () => {
        if (map) map.resize(); // Este método hace que el mapa se ajuste cuando el tamaño de la ventana cambie
      });

      return {};
    },
  };
  </script>


<style>
.map-wrapper {
    width: 100%;
    height: 100%;
    position: relative;
    overflow: hidden;
}

.map-container {
    width: 100%;
    height: 500px;
}

.mapboxgl-ctrl-bottom-right,
.mapboxgl-ctrl-top-right,
.mapboxgl-ctrl-top-left,
.mapboxgl-ctrl-bottom-left {
    display: none !important;
}

.mapboxgl-ctrl-bottom-right,
.mapboxgl-ctrl-top-right,
.mapboxgl-ctrl-top-left,
.mapboxgl-ctrl-bottom-left {
    margin: 0 !important;
    padding: 0 !important;
}

.mapboxgl-ctrl {
    background: rgba(255, 255, 255, 0.7);
}
</style>



pk.eyJ1IjoibG9zdHlybDciLCJhIjoiY204M2N5eGhhMHF5MTJqcmE1Y3Y1bm5keiJ9.2B5FzYtEPqL6ZIYbPLjQxg
