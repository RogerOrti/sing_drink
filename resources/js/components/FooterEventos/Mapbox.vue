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
        const locations = [
    { lng: 2.18965, lat: 41.42249, title: "La Sagrera", img: "image/sagrera.jpg" },
    { lng: 2.16992, lat: 41.38792, title: "Plaça Catalunya", img: "image/cata.jpg" },
    { lng: 2.17663, lat: 41.48042, title: "El Fondo", img: "image/fondo.jpg" }
];

onMounted(() => {
    mapboxgl.accessToken =
        "pk.eyJ1IjoibG9zdHlybDciLCJhIjoiY204M2N5eGhhMHF5MTJqcmE1Y3Y1bm5keiJ9.2B5FzYtEPqL6ZIYbPLjQxg";

    const map = new mapboxgl.Map({
        container: "map-P",
        style: "mapbox://styles/mapbox/streets-v12",
        zoom: 12,
    });

    // Agregar controles de navegación
    map.addControl(new mapboxgl.NavigationControl());

    // Crear un objeto de tipo Bounds
    const bounds = new mapboxgl.LngLatBounds();

    // Iterar sobre las coordenadas y agregar un marcador para cada una
    locations.forEach(location => {
        new mapboxgl.Marker()
            .setLngLat([location.lng, location.lat])
            .setPopup(
                new mapboxgl.Popup({
                    offset: 25, // Ajuste del offset para el popup
                    maxWidth: '200px' // Limitar el tamaño máximo del popup
                })
                    .setHTML(`
                        <div style="color: black; font-size: 12px;">
                            <h4 style="margin: 0; font-size: 14px;">${location.title}</h4>
                            <img src="${location.img}" alt="${location.title}" style="width: 100%; height: auto; margin-top: 10px; border-radius: 8px;" />
                        </div>
                    `)
            ) // Popup con el texto y la imagen
            .addTo(map);

        // Extiende los límites del mapa para incluir cada marcador
        bounds.extend([location.lng, location.lat]);
    });

    // Ajustar el mapa para que se vean todos los puntos
    map.fitBounds(bounds, {
        padding: { top: 50, bottom: 50, left: 50, right: 50 }
    });

    // Agregar control de geolocalización
    map.addControl(new mapboxgl.GeolocateControl());
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
