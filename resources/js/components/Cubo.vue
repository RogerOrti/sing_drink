<template>
    <div class="cubo" :style="{ backgroundImage: `url(${imagen})` }">
      <p class="texto">{{ texto }}</p>
    </div>
  </template>

  <script>
  export default {
    props: {
      imagen: String, // URL de la imagen
      texto: String,  // Texto dentro del cubo
    },
  };
  </script>

  <style scoped>
  .cubo {
      width: 100px; /* Ajusta el tamaño */
      height: 100px;
      background-size: cover;
      background-position: center;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-weight: bold;
      text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.7);
      border: 1px solid #000;
  }

  .texto {
      font-size: 14px;
      text-align: center;
  }
  </style>
