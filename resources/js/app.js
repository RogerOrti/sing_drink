import "./bootstrap";
import * as bootstrap from "bootstrap";
import FooterEventos from "./components/FooterEventos/FooterCubo.vue";
import { createApp } from "vue";
import PrimeVue from 'primevue/config';
import App from './App.vue';
// import Prova from "./components/Prova.vue";

// import { createApp } from "vue";
// import mapboxFooter from "./components/mapbox/mapboxFooter.vue";

// createApp(mapboxFooter).mount('#mapa');


createApp(FooterEventos).mount('#Cubo');

const app = createApp(App);
app.use(PrimeVue);
console.log("Se ha cargado")
app.mount('#app');


// app.component("prova", Prova);
// app.mount("#app");

