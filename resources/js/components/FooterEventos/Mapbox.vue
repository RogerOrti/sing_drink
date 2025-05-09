<template>
    <div class="map-wrapper">
        <div id="map-P" class="map-container"></div>
    </div>
</template>

<script>
import { onMounted, onBeforeUnmount } from "vue";
import mapboxgl from "mapbox-gl";
import axios from "axios";

export default {
    setup() {
        let map;
        const locations = [];

        const geocodeAddress = (address) => {
            return new Promise((resolve, reject) => {
                const geocodeUrl = `https://api.mapbox.com/geocoding/v5/mapbox.places/${encodeURIComponent(
                    address
                )}.json?access_token=${mapboxgl.accessToken}`;
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

            map.addControl(new mapboxgl.NavigationControl());
            const bounds = new mapboxgl.LngLatBounds();

            axios
                .get("locals")
                .then((response) => {
                    const data = response.data;
                    let count = 0;

                    data.forEach((location) => {
                        geocodeAddress(location.direccio)
                            .then((coords) => {
                                locations.push({
                                    lat: coords[1],
                                    lng: coords[0],
                                    title: location.nom_local,
                                    img: location.multimedia_local.ruta,
                                });

                                new mapboxgl.Marker()
                                    .setLngLat([coords[0], coords[1]])
                                    .setPopup(
                                        new mapboxgl.Popup({ offset: 25 })
                                            .setHTML(`
                                            <div class="popup-content">
                                            <h4>${location.nom_local}</h4>
                                            <img src="${location.multimedia_local.ruta}" alt="${location.nom_local}" />
                                            <p>${location.direccio}</p>
                                            </div>
                                        `)
                                    )
                                    .addTo(map);

                                bounds.extend([coords[0], coords[1]]);
                            })
                            .catch((error) => {
                                console.error("Error al geocodificar:", error);
                            })
                            .finally(() => {
                                count++;
                                if (count === data.length) {
                                    map.fitBounds(bounds, {
                                        padding: {
                                            top: 50,
                                            bottom: 50,
                                            left: 50,
                                            right: 50,
                                        },
                                    });
                                }
                            });
                    });
                })
                .catch((error) => {
                    console.error("Error al cargar los datos:", error);
                });

            map.addControl(new mapboxgl.GeolocateControl());
        });

        onBeforeUnmount(() => {
            if (map) map.remove();
        });

        window.addEventListener("resize", () => {
            if (map) map.resize();
        });

        return {};
    },
};
</script>

<style>
.popup-content {
    color: black;
    font-size: 12px;
}

.popup-content h4 {
    margin: 0;
    font-size: 14px;
}

.popup-content img {
    width: 100%;
    height: auto;
    margin-top: 10px;
    border-radius: 8px;
}

.popup-content p {
    color: black;
    margin-top: 5px;
    font-size: 14px;
}
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
    background: rgba(255, 255, 255, 0.121);
}
.mapboxgl-popup-close-button {
    font-size: 18px !important; /* Hazlo más grande */
    font-weight: bold;
    background: rgba(0, 0, 0, 0.8); /* Fondo blanco semitransparente */
    border-radius: 50%;
    width: 24px;
    height: 24px;
    top: 8px;
    right: 8px;
    color: blue !important;
}
</style>

pk.eyJ1IjoibG9zdHlybDciLCJhIjoiY204M2N5eGhhMHF5MTJqcmE1Y3Y1bm5keiJ9.2B5FzYtEPqL6ZIYbPLjQxg
