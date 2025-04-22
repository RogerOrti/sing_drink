<template>
    <div>
        <div class="icono-chat">
            <Button @click="mostrarModal" class="mb-4">
                <svg fill="#EEC765" height="70px" width="70px" version="1.1" id="Layer_1"
                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                    viewBox="-27.6 -27.6 515.20 515.20" xml:space="preserve" stroke="#EEC765" stroke-width="0.00460003"
                    transform="rotate(0)">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#EEC765"
                        stroke-width="15.640102000000002">
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

        <Dialog v-model:visible="mostrar" id="chat" modal header="CHAT"
            :style="{ width: '40vw', background: '#EEC765' }" @hide="handleClose">
            <div class="chat-container">
                <div class="user-list">
                    <h3>Mensajes</h3>
                    <ul>
                        <li v-for="user in users" :key="user.id" @click="selectUser(user)"
                            :class="{ active: selectedUser && selectedUser.id === user.id }">
                            <span class="avatar">{{ user.name.charAt(0) }}</span>
                            <div class="user-info">
                                <strong>{{ user.name }}</strong>
                                <p>{{ user.messages[user.messages.length - 1] }}</p>
                            </div>
                        </li>
                    </ul>
                </div>

                <div class="chat-box" v-if="selectedUser">
                    <div class="chat-header">
                        <span class="avatar">{{ selectedUser.name.charAt(0) }}</span>
                        <h3>{{ selectedUser.name }}</h3>
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
    </div>
</template>
<script>
// import { ref, onMounted, onUnmounted } from "vue";
// import { useAuthStore } from "@/stores/auth";
// import axios from "@/config/axios";
// import Dialog from "primevue/dialog";
// import Button from "primevue/button";
// import InputText from "primevue/inputtext";

// export default {
//     components: {
//         Dialog,
//         Button,
//         InputText
//     },
//     setup() {
//         const authStore = useAuthStore();
//         const mostrar = ref(false);
//         const newMessage = ref("");
//         const selectedUser = ref(null);
//         const users = ref([]);
//         const messages = ref([]);
//         const isLoading = ref(false);
//         const error = ref(null);

//         const fetchConversations = async () => {
//             try {
//                 isLoading.value = true;
//                 const response = await axios.get("/api/chat");
//                 const currentUserId = authStore.user.id_user;

//                 users.value = response.data.map(conv => {
//                     const isOwner = conv.id_propietari === currentUserId;
//                     const otherUser = isOwner ? conv.musico.usuario : conv.propietario.usuario;

//                     return {
//                         id: isOwner ? conv.id_music : conv.id_propietari,
//                         name: otherUser.nombre,
//                         avatar: otherUser.foto_perfil,
//                         messages: [conv.missatge],
//                         isOwner: !isOwner
//                     };
//                 });
//             } catch (err) {
//                 error.value = "Error al cargar conversaciones";
//                 console.error(err);
//             } finally {
//                 isLoading.value = false;
//             }
//         };

//         const selectUser = async (user) => {
//             selectedUser.value = user;
//             await fetchMessages(user.id, user.isOwner);
//         };

//         const fetchMessages = async (otherUserId, isOwner) => {
//             try {
//                 isLoading.value = true;
//                 const currentUserId = authStore.user.id_user;

//                 const url = isOwner
//                     ? `/api/chat/${otherUserId}/${currentUserId}`
//                     : `/api/chat/${currentUserId}/${otherUserId}`;

//                 const response = await axios.get(url);
//                 selectedUser.value.messages = response.data.map(msg => msg.missatge);
//                 messages.value = response.data.map(msg => ({
//                     id: msg.id_chat,
//                     text: msg.missatge,
//                     sent: msg.enviat,
//                     isMine: msg.id_propietari === currentUserId || msg.id_music === currentUserId,
//                     timestamp: msg.created_at
//                 }));
//             } catch (err) {
//                 error.value = "Error al cargar mensajes";
//                 console.error(err);
//             } finally {
//                 isLoading.value = false;
//             }
//         };

//         const enviarFormulario = async () => {
//             if (!newMessage.value.trim() || !selectedUser.value) return;

//             try {
//                 const response = await axios.post('/api/chat/enviar', {
//                     id_destinatario: selectedUser.value.id,
//                     mensaje: newMessage.value,
//                     es_propietario: !selectedUser.value.isOwner
//                 });

//                 messages.value.push({
//                     id: response.data.chat.id_chat,
//                     text: newMessage.value,
//                     sent: true,
//                     isMine: true,
//                     timestamp: new Date().toISOString()
//                 });

//                 selectedUser.value.messages.push(newMessage.value);
//                 newMessage.value = "";

//                 await fetchConversations();
//             } catch (err) {
//                 error.value = "Error al enviar mensaje";
//                 console.error(err);
//             }
//         };

//         const handleClose = () => {
//             mostrar.value = false;
//             selectedUser.value = null;
//             messages.value = [];
//         };

//         const mostrarModal = () => {
//             mostrar.value = true;
//             fetchConversations();
//         };


//         let pollInterval;
//         onMounted(() => {
//             pollInterval = setInterval(() => {
//                 if (selectedUser.value) {
//                     fetchMessages(selectedUser.value.id, selectedUser.value.isOwner);
//                 }
//             }, 5000);
//         });

//         onUnmounted(() => {
//             clearInterval(pollInterval);
//         });

//         return {
//             mostrar,
//             newMessage,
//             selectedUser,
//             users,
//             messages,
//             isLoading,
//             error,
//             mostrarModal,
//             selectUser,
//             enviarFormulario,
//             handleClose
//         };
//     }
// };
</script>

<style scoped>
.user-info p {
    color: wheat;
}

.icono-chat {
    position: fixed;
    bottom: 0;
    right: 0;
    margin: 20px;
}

#chat {
    display: block;
    border-radius: 10px;
    padding: 5px;
}

.chat-container {
    display: flex;
    height: 100%;
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

.user-list li.active,
.user-list li:hover {
    background: #131b33;
}

.avatar {
    width: 100px;
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
    background: white;
    display: flex;
    flex-direction: column;
}

.chat-header {
    display: flex;
    align-items: center;
    padding: 20px;
    background-color: #222E50;
}

.chat-header span {
    width: 10%;
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
    background: #d3d3d3;
    align-self: flex-end;
}

.received {
    background: #EEC765;
    align-self: flex-start;
}

.chat-input {
    display: flex;
    padding: 10px;
    background: #222e50;
}

.chat-input input {
    flex: 1;
    margin-right: 10px;
}
</style>
