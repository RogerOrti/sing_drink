import './bootstrap';

import * as bootstrap from 'bootstrap';

import { createApp } from 'vue';
import prova from './components/Prova.vue'

createApp(prova).mount('#prova');

window.onscroll = function () {
    var navbar = document.querySelector('.navbar');
    if (window.scrollY > 100) { // Cuando el scroll supera los 100px
        navbar.classList.add('scrolled');
    } else {
        navbar.classList.remove('scrolled');
    }
};

