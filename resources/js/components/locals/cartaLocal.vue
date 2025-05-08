<template>
    <div>
        <div class="cardsLocals">
            <div class="card m-4" v-for="local in locals" :key="local.id" style="width: 18rem;">
                <div class="card-body mt-3">
                    <img class="fotoCardLocals m-2" :src="local.multimedia_local.ruta" />
                    <h5 class="card-title m-1">{{ local.nom_local }}</h5>
                    <h5 class="card-title m-2">{{ local.direccio }}</h5>
                    <a :href="'local/' + local.id_local" class="btn btn-primary mt-2">Saber más</a>
                    <button @click="abrirModal(local)" class="btn btn-success mt-2">Enviar mensaje</button>
                </div>
            </div>
        </div>

        <div v-if="modalVisible" class="modal-overlay" @click="cerrarModal">
            <div class="modal-content" @click.stop>
                <h4>Enviar mensaje</h4>
                <input v-model="newMessage" placeholder="Escribe tu mensaje" required class="mensajes-send" />
                <button @click="sendMessage" type="button" class="btn btn-success mt-2">Enviar</button>
                <button @click="cerrarModal" class="btn btn-secondary mt-2">Cerrar</button>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    props: {
        usuarioId: {
            type: Number,
            required: true,
        },
    },
    data() {
        return {
            locals: [],
            modalVisible: false,
            newMessage: "",
            selectedLocal: null,
            idPropietario: null,
            idMusic: this.usuarioId,
        };
    },
    mounted() {
        console.log("idMusic desde la prop:", this.idMusic);
        this.getLocals();
    },
    methods: {
        getLocals(page = 1) {
            axios.get("locals/paginado", { params: { page } })
                .then((response) => {
                    this.locals = response.data.data;
                })
                .catch((error) => {
                    console.error("Error al cargar los datos:", error);
                });
        },

        cambiarPagina(nuevaPagina) {
            if (nuevaPagina >= 1) {
                this.getLocals(nuevaPagina);
            }
        },

        async abrirModal(local) {
            this.selectedLocal = local.id_local;
            this.modalVisible = true;

            try {
                const propResponse = await axios.get(`propietari/local/${local.id_local}`);
                console.log("Respuesta del propietario:", propResponse.data);

                if (!propResponse.data.length) {
                    throw new Error("Propietario no encontrado");
                }

                this.idPropietario = propResponse.data[0]?.id_user;
                console.log("idPropietario asignado:", this.idPropietario);
            } catch (error) {
                console.error("Error al abrir modal:", error);
                alert(`Error al obtener datos del local: ${error.message}`);
                this.cerrarModal();
            }
        },

        async sendMessage() {
            console.log("idPropietario:", this.idPropietario);
            console.log("idMusic:", this.idMusic);
            console.log("Nuevo mensaje:", this.newMessage);

            if (!this.newMessage.trim()) {
                alert("Por favor escribe un mensaje");
                return;
            }

            if (!this.idPropietario || !this.idMusic) {
                alert("Por favor selecciona un local antes de enviar un mensaje");
                return;
            }

            try {
                const response = await axios.post("/chat", {
                    id_propietari: this.idPropietario,
                    id_music: this.idMusic,
                    missatge: this.newMessage,
                });

                alert("Mensaje enviado con éxito!");
                this.cerrarModal();
            } catch (error) {
                console.error("Error al enviar mensaje:", error);
                alert("No se pudo enviar el mensaje");
            }
        },

        cerrarModal() {
            this.modalVisible = false;
            this.newMessage = "";
        }
    }
};
</script>



<style scoped>
.mensajes-send {
    color: black;
}

.modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
}

.modal-content {
    background-color: rgb(255, 255, 255);
    padding: 20px;
    color: black;
    border-radius: 10px;
    width: 300px;
}

textarea {
    width: 100%;
    height: 100px;
    margin-bottom: 10px;
}
</style>
