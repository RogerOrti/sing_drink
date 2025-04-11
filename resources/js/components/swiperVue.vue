<template>
    <div class="carouselIndex">
      <h1 class="mt-5">REVIU ELS MILLORS MOMENTS</h1>
      <div class="swiper mySwiper">
        <div class="swiper-wrapper">
          <div class="swiper-slide" v-for="(music, index) in musics" :key="index">
            <img :src="music.multimedia.ruta" alt="Imagen">
          </div>
        </div>
        <div class="swiper-pagination"></div>
      </div>
    </div>
  </template>

  <script>
  export default {
    data() {
      return {
        musics: [],
      };
    },
    mounted() {
      this.initSwiper();
      this.GetMusic()
    },
    methods: {
      initSwiper() {
        // Inicializamos Swiper
        new Swiper(".mySwiper", {
          effect: "coverflow",
          grabCursor: true,
          centeredSlides: true,
          slidesPerView: "auto",
          spaceBetween: 150,
          initialSlide: 2,
          coverflowEffect: {
            rotate: 10,
            stretch: 0,
            depth: 300,
            modifier: 1,
            slideShadows: true
          },
          pagination: {
            el: ".swiper-pagination"
          },
          autoplay: {
            delay: 2500,
            disableOnInteraction: false
          }
        });
      },

      GetMusic() {
        axios.get("musics")
          .then((response) => {
            this.musics = response.data
          })
          .catch((error) => {
            console.error("Error al cargar los datos:", error);
          });
      },
    }
  };
  </script>

  <style scoped>
  .carouselIndex {
    flex-direction: column;
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    height: auto;
  }

  .swiper {
    width: 100%;
    padding-top: 50px;
    padding-bottom: 50px;
  }

  .swiper-slide {
    background-position: center;
    background-size: cover;
    width: 300px;
  }

  .swiper-slide img {
    display: block;
    width: 100%;
    height: 300px;
    -webkit-box-reflect: below 1px
      linear-gradient(transparent, transparent, #0002, #0004);
  }
  </style>
