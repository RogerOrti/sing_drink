<template>
<div v-for="local in locals" :key="local.id">
    <div id="quisom">
        <h1 class="display-1 fw-bold text-center larger-title">{{ local.nom_local }}</h1>
    </div>
</div>
</template>
<script>

    export default {
    data() {
      return {
        locals: []
      }
    },

    mounted() {
        const me = this;
      axios.get("locals")
        .then(response => {
          console.log("Datos recibidos:", response.data); // Verifica la respuesta en consola
          me.locals = response.data.data; // Asigna los datos a locals
        })
        .catch(error => {
          console.error("Error al cargar los datos:", error);
        });
    }
  }


</script>
<style>

</style>
