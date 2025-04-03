import "./bootstrap";
import * as bootstrap from "bootstrap";
import FooterEventos from "./components/FooterEventos/FooterCubo.vue";
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
// import Paginate from 'vuejs-paginate-next';

// createApp(mapboxFooter).mount('#mapa');
// createApp(FooterEventos).mount('#Cubo');

// createApp(registerVue).mount('#register');

// createApp(loginVue).mount('#login');

const app = createApp({});

// app.use(PrimeVue);

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

app.mount('#app');


