<template>
    <div class="cardsLocals">
        <div class="card" v-for="local in locals" :key="local.id" style="width: 18rem;">
            <div class="card-body">
                <img class="fotoCardLocals" :src="local.multimedia.ruta" />
                <h5 class="card-title">{{ local.nom_local }}</h5>
                <h5 class="card-title">{{ local.direccio }}</h5>
                <a :href="'locals/' + local.id_local" class="btn btn-primary">Saber más</a>
            </div>
        </div>
    </div>
    <div class="pagination">
        <button :disabled="ActualPagina === 1" @click="cambiarPagina(ActualPagina - 1)">Anterior</button>
        <span>Página {{ ActualPagina }} de {{ UltimaPagina }}</span>
        <button :disabled="ActualPagina === UltimaPagina" @click="cambiarPagina(ActualPagina + 1)">Siguiente</button>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            locals: [],
            ActualPagina: 1,
            UltimaPagina: 1,
        }
    },

    methods: {
        GetLocal(page = 1) {
            const me = this;
            axios.get("locals", { params: { page } })
                .then(response => {
                    console.log("Datos recibidos:", response.data); // Verifica la respuesta en consola
                    me.locals = response.data.data;
                    me.ActualPagina = response.data.meta.current_page;
                    me.UltimaPagina = response.data.meta.last_page;
                })
                .catch(error => {
                    console.error("Error al cargar los datos:", error);
                });
        },
        cambiarPagina(pagina) {
            if (pagina >= 1 && pagina <= this.UltimaPagina) {
                this.GetLocal(pagina);
            }
        }
    },
    created() {
        this.GetLocal();
    }
}
</script>
