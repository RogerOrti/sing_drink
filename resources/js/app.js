import "./bootstrap";
import * as bootstrap from "bootstrap";
 import FooterEventos from "./components/FooterEventos/FooterCubo.vue";
import { createApp } from "vue";
import PrimeVue from 'primevue/config';
import App from './App.vue';

import Prova from "./components/Prova.vue";

import mapboxFooter from "./components/mapbox/mapboxFooter.vue";
createApp(mapboxFooter).mount('#mapa');
createApp(FooterEventos).mount('#Cubo');



const app = createApp(App);
app.use(PrimeVue);
app.mount('#app');


app.component("prova", Prova);

//mi js para el programa no lo toqueis
window.addEventListener("scroll", function () {
    let navbar = document.querySelector(".navbar");
    if (window.scrollY > 10) { // Cambia 100 por la cantidad de píxeles que prefieras
        navbar.classList.add("scrolled");
    } else {
        navbar.classList.remove("scrolled");
    }
});
