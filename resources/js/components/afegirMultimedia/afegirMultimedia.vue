<template>
    <button @click="mostrarMenu()">Afegir Multiemdia</button>
    <div class="modal" v-if="mostrarMenuMultimedia"></div>
</template>

  <script>
  export default {
    data() {
        return{
            mostrarMenuMultimedia : false,
        }
    },

    mounted() {

    },
    methods: {
        mostrarMenu(){
            this.mostrarMenuMultimedia = true;
        }
    }
  }
  </script>

  <style>
    .modal{
        display: flex;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100vh;
        background-color: rgba(0, 0, 0, 0.568);
    }
  </style>

