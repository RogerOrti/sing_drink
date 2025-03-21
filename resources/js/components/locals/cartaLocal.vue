<template>

    <div class="cardsLocals" v-for="cartaLocal in cartasLocals" :key="cartaLocal.id">
     <div class="card" style="width: 18rem;">
        <img src="image" class="card-img-top" alt="imatge restuarant">
         <div class="card-body">
            <h5 class="card-title"> {{ cartaLocal.nom_local }}</h5>
            <h5 class="card-title"> {{ cartaLocal.direccio }}</h5>
            <a href="#" class="btn btn-primary">Saber més</a>
        </div>
        </div>
    </div>
</template>
<script>
export default {

    data() {
        return {
            cartasLocals: []
        }
    },

    mounted() {
        // Realizamos la solicitud HTTP con axios
        axios.get("http://localhost/sing_drink/public/locals")
            .then(response => {
                // Asignamos los datos de la respuesta a cartasLocals
                this.cartasLocals = response.data;
            })
            .catch(error => {
                console.error("Error al cargar los datos:", error);
            });

}
}
</script>
<style>

</style>
