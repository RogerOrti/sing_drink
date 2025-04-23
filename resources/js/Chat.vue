        <template>
                <div class="icono-chat">
                    <Button @click="mostrarModal" class="mb-4">
                        <svg fill="#EEC765" height="70px" width="70px" version="1.1" id="Layer_1"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                            viewBox="-27.6 -27.6 515.20 515.20" xml:space="preserve" stroke="#EEC765"
                            stroke-width="0.00460003" transform="rotate(0)">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"
                                stroke="#EEC765" stroke-width="15.640102000000002">
                                <g>
                                    <g>
                                        <path
                                            d="M455.608,4.394c-4.192-4.192-10.459-5.521-15.99-3.394L9.616,166.376c-5.624,2.163-9.409,7.482-9.607,13.505 c-0.199,6.023,3.225,11.58,8.694,14.11l175.93,81.379l81.379,175.93c2.46,5.318,7.782,8.703,13.612,8.703 c0.165,0,0.332-0.003,0.498-0.008c6.023-0.199,11.342-3.983,13.505-9.607L459.002,20.385C461.13,14.852,459.8,8.585,455.608,4.394 z M278.354,406.523l-68.807-148.751c-0.747-1.615-1.769-3.07-3.008-4.309L418.887,41.116L278.354,406.523z">
                                        </path>
                                    </g>
                                </g>
                            </g>
                            <g id="SVGRepo_iconCarrier">
                                <g>
                                    <g>
                                        <path
                                            d="M455.608,4.394c-4.192-4.192-10.459-5.521-15.99-3.394L9.616,166.376c-5.624,2.163-9.409,7.482-9.607,13.505 c-0.199,6.023,3.225,11.58,8.694,14.11l175.93,81.379l81.379,175.93c2.46,5.318,7.782,8.703,13.612,8.703 c0.165,0,0.332-0.003,0.498-0.008c6.023-0.199,11.342-3.983,13.505-9.607L459.002,20.385C461.13,14.852,459.8,8.585,455.608,4.394 z M278.354,406.523l-68.807-148.751c-0.747-1.615-1.769-3.07-3.008-4.309L418.887,41.116L278.354,406.523z">
                                        </path>
                                    </g>
                                </g>
                            </g>
                        </svg>
                    </Button>
                </div>
                <Dialog v-model:visible="mostrar" id="chat" modal header="SING&DRINK"
            :style="{ width: '40vw', background: '#EEC765', borderRadius: '10px', padding: '5px' }">
        <div class="chat-container">
            <div class="user-list">
                <h3>Mensajes</h3>
                <ul>
                    <li v-for="user in usuaris" :key="user.id" @click="selectUser(user)"
                        :class="{ active: selectedUser && selectedUser.id === user.id }">
                        <span class="avatar">{{ user.nom.charAt(0) }}</span>
                        <div class="user-info">
                            <strong>{{ user.nom }}</strong>
                            <p>{{ user.missatge }}</p>
                        </div>
                    </li>
                </ul>
            </div>

            <div class="chat-box" v-if="selectedUser">
                <div class="chat-header">
                    <span class="avatar">{{ selectedUser.nom.charAt(0) }}</span>
                    <h3>{{ selectedUser.nom }}</h3>
                </div>
                <div class="messages">
                    <div v-for="(msg, index) in selectedUser.messages" :key="index"
                         :class="['message', index % 2 === 0 ? 'sent' : 'received']">
                        <p>{{ msg }}</p>
                    </div>
                </div>
                <form @submit.prevent="enviarFormulario" class="chat-input">
                    <InputText v-model="newMessage" type="text" placeholder="Escribe aqui" />
                    <Button type="submit" icon="pi pi-send"></Button>
                </form>
            </div>
        </div>
    </Dialog>
</template>

<script>
import { ref, onMounted } from "vue";
import Dialog from "primevue/dialog";
import Button from "primevue/button";
import InputText from "primevue/inputtext";
import axios from "axios";

export default {
    components: {
        Dialog,
        Button,
        InputText
    },
    setup() {
        const mostrar = ref(false);
        const newMessage = ref("");
        const selectedUser = ref(null);
        const usuaris = ref([]);

        const mostrarModal = () => {
            mostrar.value = true;
        };

        const selectUser = (usuari) => {
            selectedUser.value = usuari;
            fetchMessages(usuari.id);
        };

        const fetchMessages = (userId) => {
            axios.get(`chat/${userId}`)
                .then((response) => {
                    selectedUser.value.messages = response.data;
                })
                .catch((error) => {
                    console.error("Error al obtener los mensajes:", error);
                });
        };

        const enviarFormulario = () => {
            if (newMessage.value.trim() && selectedUser.value) {
                const messageData = {
                    userId: selectedUser.value.id,
                    message: newMessage.value
                };

                axios.post("chat", messageData)
                    .then(() => {
                        selectedUser.value.messages.push(newMessage.value);
                        newMessage.value = "";
                    })
                    .catch((error) => {
                        console.error("Error al enviar el mensaje:", error);
                    });
            }
        };

        onMounted(() => {
            axios.get("chat/usuarios/opuestos")
                .then((response) => {
                    usuaris.value = response.data;
                })
                .catch((error) => {
                    console.error("Error al obtener los usuarios:", error);
                });
        });

        return {
            mostrar,
            newMessage,
            selectedUser,
            usuaris,
            mostrarModal,
            selectUser,
            enviarFormulario
        };
    }
};
</script>


<style scoped>
.icono-chat {
    position: fixed;
    bottom: 0;
    right: 0;
    margin: 20px;
}

#chat {
    display: block;
    border-radius: 10px;
    padding: 10px;

}

.chat-container {
    display: flex;
    height: 60vh;
    background: #EAEAEA;
}

.user-list {
    width: 20vh;
    background: #222E50;
    color: white;
    padding: 20px;
}

.user-list ul {
    list-style: none;
    padding: 0;
}

.user-list li {
    display: flex;
    align-items: center;
    padding: 10px;
    cursor: pointer;
    border-bottom: 1px solid rgba(255, 255, 255, 0.2);
}

li:hover {
    background: #131b33;
}

.avatar {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: #777;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 10px;
    color: white;
    font-weight: bold;
}

.chat-box {
    flex: 1;
    background: #43558a;
    display: flex;
    flex-direction: column;
}

.chat-header {
    display: flex;
    align-items: center;
    padding: 20px;
    background: #131b33;
}

.messages {
    flex: 1;
    padding: 20px;
    overflow-y: auto;
}

.message {
    padding: 10px 15px;
    border-radius: 10px;
    margin: 5px 0;
    max-width: 60%;
}

.sent {
    background: #222E50;
    color: white;
    align-self: flex-end;
}

.received {
    background: #EEC765;
    align-self: flex-start;
}

.chat-input {
    display: flex;
    padding: 10px;
    background: #131b33;
}

.chat-input input {
    flex: 1;
    margin-right: 10px;
}
</style>
