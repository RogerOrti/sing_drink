<template>
        <div class="coleccioMusics">
            <div class="cardsLocals" v-for="music in musics" :key="music.id_user">
                <div class="cardMusics">
                    <img :src="music.multimedia.ruta" class="cardMusics" alt="">
                    <!-- <img src="{{ asset('image/erfan/Anthony_Kiedis.png') }}" class="cardMusics" alt=""> -->
                    <!-- <img class="cardMusics" :src="music.multimedia.ruta"/> -->
                    <div>
                        <!-- <a href="music" class=" btn btnMusics btn-primary">Saber más</a> -->
                        <a :href="'musics/' + music.id_user " class="btn btnMusics btn-primary">Saber més</a>
                        <img class="play card-img-top" :src="('image/erfan/logoPlay.png')" alt="">
                    </div>
                </div>
            </div>
        </div>
  </template>

  <script>
  export default {
    data() {
      return {
        musics: []
      }
    },

    mounted() {
        const me = this;
      axios.get("musics")
        .then(response => {
          console.log("Datos recibidos:", response.data);
          me.musics = response.data;
        })
        .catch(error => {
          console.error("Error al cargar los datos:", error);
        });
    }
  }
  </script>

  <style scoped>
  /* Aquí va el estilo personalizado */
  </style>
