<template>
    <div>
        <EstadisticasMusics></EstadisticasMusics>
        <div class="CartelImagenes1">
            <h1 class="mt-5">DESCOBREIX ELS NOSTRES MÚSICS</h1>
            <div class="CartelImagenesCardCard">
                <article v-for="(music, index) in musicImages" :key="'music-' + index" class="CartelImagenesCard">
                    <img :src="music.multimedia_music[0].ruta" alt="Imagen">
                </article>
            </div>
            <button class="btn btn-secondary m-5">Músics</button>
        </div>
            <Estadisticaslocal></Estadisticaslocal>
        <div class="CartelImagenes2">
            <h1 class="mt-5">GAUDEIX DELS NOSTRES LOCALS</h1>
            <div class="RandomNombre">
                <article v-for="(local, index) in localImages" :key="'local-' + index" class="RandomNombreCard">
                    <img :src="local.multimedia_local.ruta" alt="Imagen">
                </article>
            </div>
            <button class="btn btn-secondary m-5">Locals</button>
        </div>
    </div>
</template>

<script>
import Estadisticaslocal from './estadisticas/estadisticaslocal.vue';
import EstadisticasMusics from './estadisticas/estadisticasMusics.vue';
export default {
    components: {
        Estadisticaslocal,
        EstadisticasMusics
  },
    data() {
        return {
            musicImages: [],
            localImages: []
        };
    },
    mounted() {
      this.GetMusic()
      this.GetLocal()
    },
    methods: {
      GetMusic() {
        axios.get("musics")
          .then((response) => {
            this.musicImages = response.data.slice(0, 4);
            console.log(this.musicImages);
          })
          .catch((error) => {
            console.error("Error al cargar los datos:", error);
          });
      },
      GetLocal(){
        axios.get("locals")
          .then((response) => {
            this.localImages = response.data.slice(0, 16);
            console.log(this.localImages); // Verifica la estructura de los datos
          })
          .catch((error) => {
            console.error("Error al cargar los datos:", error);
          });
      }
    }
};
</script>


<style scoped>
.CartelImagenes1,
.CartelImagenes2 {
    display: flex;
    width: 100%;
    height: auto;
    min-height: 700px;
    justify-content: center;
    align-items: center;
    flex-direction: column;
}

.CartelImagenes2 {
    background-color: #071424;
}

.CartelImagenes1 {
    background-color: #222E50;
}

.CartelImagenesCardCard {
    align-items: center;
    justify-content: center;
    display: flex;
    width: 90%;
    flex-direction: row;
    flex-wrap: wrap;
    margin: 20px;
}

.CartelImagenesCard {
    width: 300px;
    height: 400px;
    border: solid black 1px;
}

.CartelImagenesCard:nth-child(even) {
    margin-top: 100px;
    transform: rotate(10deg);
    background-size: cover;
}

.CartelImagenesCard:nth-child(odd) {
    transform: rotate(-10deg);
    background-size: cover;
}
.CartelImagenesCard img{
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}

.RandomNombre {
    margin-top: 10px;
    display: flex;
    width: 80%;
    height: auto;
    min-height: 300px;
    flex-wrap: wrap;
    justify-content: center;
}

.RandomNombreCard {
    position: relative;
    width: 200px;
    height: 150px;
    display: flex;
    margin: 10px;
    background-size: cover;
}
.RandomNombreCard img{
    position: absolute;
    width: 100%;
    height: 100%;
}
</style>
