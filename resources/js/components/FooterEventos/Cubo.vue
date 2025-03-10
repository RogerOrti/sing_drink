<template>
    <div class="cubo">
      <img :src="image" alt="Imagen del cubo" class="cubo-img" />
      <div class="cubo-content" @click="handleClick">
        {{ text }}
      </div>
    </div>
  </template>
  <script>
  export default {
    props: {
      image: String,
      text: String,
    },
    methods: {
      handleClick(event) {
        event.stopPropagation();
        console.log(this.text);
      }
    },
    data(){
        return{
            url: import.meta.env.VITE_APP_URL,
        }
    }
  };
  </script>

  <style scoped>
  .cubo {
    width: calc(100% / 2 - 10px);
    height: 200px;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    border-radius: 8px;
    overflow: hidden;
    cursor: pointer;
    border: solid black 1px;
  }

  .cubo-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    position: absolute;
    top: 0;
    left: 0;
    z-index: -1;
  }

  .cubo-content {
    background: rgba(0, 0, 0, 0.5);
    color: white;
    font-weight: bold;
    text-align: center;
    padding: 10px 20px; /* Ajuste de padding para mejorar la legibilidad */
    border-radius: 4px;
    z-index: 1;
    transition: background 0.3s ease, transform 0.3s ease;
    cursor: pointer;
  }

  .cubo-content:hover {
    background: rgba(0, 0, 0, 0.8);
    transform: scale(1.1);
  }
  </style>
