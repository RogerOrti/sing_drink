import "./bootstrap";

import * as bootstrap from "bootstrap";

import { createApp } from "vue";
import Prova from "./components/Prova.vue";

const app = createApp({});

app.component("prova", Prova);

app.mount("#app");

