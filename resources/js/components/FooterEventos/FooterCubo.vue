<template>
    <div class="footerEventos">
      <div class="footerEventosPart1">
        <div v-for="(grupo, index) in grupos" :key="index" class="grupo">
          <Cubo
            v-for="(item, index2) in grupo"
            :key="index2"
            :image="item.multimedia.ruta"
            :text="item.user.nom"
          />
        </div>
      </div>
      <div class="footerEventosPart2">
        <Mapbox />
      </div>
    </div>
  </template>

  <script>
  import Cubo from './Cubo.vue';
  import Mapbox from './Mapbox.vue';

  export default {
    components: {
      Cubo,
      Mapbox,
    },
    data() {
      return {
        cubos: [],
      };
    },

    mounted() {
        const me = this;
      axios.get("musics")
        .then(response => {
          console.log("Datos recibidos:", response.data);
          me.cubos = response.data.slice(0, 8);
        })
        .catch(error => {
          console.error("Error al cargar los datos:", error);
        });
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
    flex-direction: row;
  }

  .footerEventosPart1,
  .footerEventosPart2 {
    display: flex;
    flex-direction: column;
    height: auto;
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
    .footerEventosPart1,
    .footerEventosPart2 {
      width: 100%;
    }
    .footerEventosPart2 {
      min-height: 200px;
    }
  }
  </style>
