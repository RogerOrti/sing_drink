import "./bootstrap";

import * as bootstrap from "bootstrap";

import { createApp } from "vue";

import GsapAnimation from "./components/Prova.vue";

createApp(prova).mount("#prova");

const app = createApp({});
app.component("GsapAnimation", GsapAnimation);
app.mount("#app");
