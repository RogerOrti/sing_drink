<template>
    <div class="map-wrapper">
        <div id="map-P" class="map-container"></div>
    </div>
</template>

<script>
import { onMounted, onBeforeUnmount } from "vue";
import mapboxgl from "mapbox-gl";

export default {
    setup() {
        let map;

        onMounted(() => {
            mapboxgl.accessToken =
                "pk.eyJ1IjoibG9zdHlybDciLCJhIjoiY204M2N5eGhhMHF5MTJqcmE1Y3Y1bm5keiJ9.2B5FzYtEPqL6ZIYbPLjQxg";

            map = new mapboxgl.Map({
                container: "map-P", // Aquí debes cambiarlo
                style: "mapbox://styles/mapbox/streets-v11",
                center: [-3.70379, 40.41678],
                zoom: 5,
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
        });

        onBeforeUnmount(() => {
            if (map) map.remove();
        });
        window.addEventListener("resize", () => {
            map.resize(); // Este método hace que el mapa se ajuste cuando el tamaño de la ventana cambie
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
