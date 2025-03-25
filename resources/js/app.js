import "./bootstrap";
import * as bootstrap from "bootstrap";
 import FooterEventos from "./components/FooterEventos/FooterCubo.vue";
import { createApp } from "vue";
import PrimeVue from 'primevue/config';
import App from './App.vue';
import registerVue from "./components/auth/register.vue";
import loginVue from "./components/auth/login.vue";


import Prova from "./components/Prova.vue";
import mapboxFooter from "./components/mapbox/mapboxFooter.vue";
import CartaLocal from "./components/locals/cartaLocal.vue";


// createApp(mapboxFooter).mount('#mapa');
// createApp(FooterEventos).mount('#Cubo');

// createApp(registerVue).mount('#register');

// createApp(loginVue).mount('#login');

const app = createApp(CartaLocal);
// const app = createApp({});
// app.use(PrimeVue);


app.mount('#app');

app.component("carta-local", CartaLocal);

