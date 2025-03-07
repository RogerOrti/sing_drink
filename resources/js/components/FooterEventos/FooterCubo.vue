<template>
    <div class="footerEventos">
      <div class="footerEventosPart1">
        <div v-for="(grupo, index) in grupos" :key="index" class="grupo">
          <Cubo
            v-for="(item, index2) in grupo"
            :key="index2"
            :image="item.image"
            :text="item.text"
          />
        </div>
      </div>
      <div class="footerEventosPart2"></div>
    </div>
  </template>

  <script>
  import Cubo from './Cubo.vue';

  export default {
    components: { Cubo },
    data() {
      return {

        cubos: [
          { image: 'img/prog1.jpg', text: 'Texto 1' },
          { image: 'img/prog1.jpg', text: 'Texto 2' },
          { image: 'img/prog1.jpg', text: 'Texto 3' },
          { image: 'img/prog1.jpg', text: 'Texto 4' },
          { image: 'img/prog1.jpg', text: 'Texto 5' },
          { image: 'img/prog1.jpg', text: 'Texto 6' },
          { image: 'img/prog1.jpg', text: 'Texto 7' },
          { image: 'img/prog1.jpg', text: 'Texto 10' },

        ],
      };
    },
    computed: {
      grupos() {
        const grupos = [];
        let cubosRestantes = [...this.cubos];
        while (cubosRestantes.length > 0) {
          if (grupos.length % 2 === 0 && cubosRestantes.length >= 3) {
            grupos.push(cubosRestantes.splice(0, 3));
          } else {
            grupos.push(cubosRestantes.splice(0, 2));
          }
        }

        return grupos;
      },
    },
  };
  </script>

  <style scoped>
  .footerEventos {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    height: auto;
    flex-direction: row;
  }

  .footerEventosPart1, .footerEventosPart2 {
    display: flex;
    flex-direction: column;
  }

  .grupo {
    display: flex;
    justify-content: center;
    gap: 10px;
  }

  @media (max-width: 768px) {
    .footerEventos {
    flex-direction: column;
  }
  .footerEventosPart1, .footerEventosPart2 {
    width: 100%;
  }
  .footerEventosPart2{
    min-height: 200px;
  }


  }
  </style>
}
