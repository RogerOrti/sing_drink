import "./bootstrap";
import * as bootstrap from "bootstrap";
import { createApp } from "vue";
import PrimeVue from 'primevue/config';
import Chat from './Chat.vue';
import registerVue from "./components/auth/register.vue";
import loginVue from "./components/auth/login.vue";
import Prova from "./components/Prova.vue";
import mapboxFooter from "./components/mapbox/mapboxFooter.vue";
import CartaLocal from "./components/locals/cartaLocal.vue";
import CartaMusic from "./components/musics/cartaMusic.vue";
import PaginaLocal from "./components/paginaLocal/paginaLocal.vue";
import PaginaMusic from "./components/paginaMusic/paginaMusic.vue";
import UsuariosCRUD from "./components/usuariosCRUD.vue";
import mapaLocal from "./components/mapbox/mapboxLocal.vue";
import FooterEventos from "./components/FooterEventos/FooterCubo.vue";
import SubirMultimedia from "./components/afegirMultimedia/afegirMultimedia.vue";
import swiperVue  from "./components/swiperVue.vue";
import ImagenesCartel from "./components/CartelImages.vue"
import estadisticaslocal from "./components/estadisticas/estadisticaslocal.vue";
// import Paginate from 'vuejs-paginate-next';

// createApp(mapboxFooter).mount('#mapa');
// createApp(FooterEventos).mount('#Cubo');

// createApp(registerVue).mount('#register');

// createApp(loginVue).mount('#login');

const app = createApp({});
const app2 = createApp({});
const app3 = createApp({});
app.use(PrimeVue);  // Uso de PrimeVue globalmente

app.component("chat", Chat);
app.component("register", registerVue);
app.component("login", loginVue);
app.component("prova", Prova);
app.component("mapbox-footer", mapboxFooter);
app.component("footer-eventos", FooterEventos);
app.component("carta-local", CartaLocal);
app.component("carta-music", CartaMusic);
app.component("pagina-local", PaginaLocal);
app.component("pagina-music", PaginaMusic);
app.component("usuarios-crud", UsuariosCRUD);
app.component("mapalocal", mapaLocal);
app.component("estadisticaslocal", estadisticaslocal);
app.component("afegir-multimedia", SubirMultimedia);
app2.component("carousel", swiperVue);
app3.component("cartel-imagen",ImagenesCartel);


app.mount('#app');
app2.mount('#app2');
app3.mount('#app3');


