<template>
        <div class="coleccioMusics">
            <div class="cardsLocals" v-for="music in musics" :key="music.id_user">
                <div class="cardMusics">
                    <img :src="music.multimedia_music[0].ruta" class="cardMusics" alt="">3ex
                    <!-- <img src="{{ asset('image/erfan/Anthony_Kiedis.png') }}" class="cardMusics" alt=""> -->
                    <!-- <img class="cardMusics" :src="music.multimedia.ruta"/> -->
                    <div>
                        <!-- <a href="music" class=" btn btnMusics btn-primary">Saber más</a> -->
                        <a :href="'music/' + music.id_user " class="btn btnMusics btn-primary">Saber més</a>
                        <img class="play card-img-top" :src="('image/erfan/logoPlay2.webp')" alt="">
                    </div>
                </div>
            </div>
        </div>
        <div class="pagination d-flex justify-content-center align-items-center my-4">
        <button class="btn btn-secondary mx-2" :disabled="currentPage === 1" @click="cambiarPagina(currentPage - 1)">
          Anterior
        </button>
        <span>Página {{ currentPage }} de {{ lastPage }}</span>
        <button class="btn btn-secondary mx-2" :disabled="currentPage === lastPage" @click="cambiarPagina(currentPage + 1)">
          Siguiente
        </button>
      </div>
  </template>

  <script>
  export default {

    data() {
      return {
        musics: [],
        currentPage: 1,
        lastPage: 1
      }
    },

    mounted() {
        this.GetMusic();
    },

    methods: {
      GetMusic(page = 1) {
        axios.get("musics/paginado", { params: { page } })
          .then((response) => {
            this.musics = response.data.data;
            this.currentPage = response.data.meta.current_page;
            this.lastPage = response.data.meta.last_page;
          })
          .catch((error) => {
            console.error("Error al cargar los datos:", error);
          });
      },
      cambiarPagina(nuevaPagina) {
        if (nuevaPagina >= 1 && nuevaPagina <= this.lastPage) {
          this.GetMusic(nuevaPagina);
        }
      }
    }
  }
  </script>

  <style scoped>
  /* Aquí va el estilo personalizado */
  </style>
