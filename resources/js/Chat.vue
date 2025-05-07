<template>
    <div class="icono-chat">
        <Button @click="toggleChat" class="mb-4" :style="{ background: 'none', border: 'none' }">
            <svg fill="#EEC765" height="55px" width="70px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="-27.6 -27.6 515.20 515.20" xml:space="preserve"
                stroke="#EEC765" stroke-width="0.00460003" transform="rotate(0)">
                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#EEC765"
                    stroke-width="15.640102000000002">
                    <g>
                        <path
                            d="M455.608,4.394c-4.192-4.192-10.459-5.521-15.99-3.394L9.616,166.376c-5.624,2.163-9.409,7.482-9.607,13.505 c-0.199,6.023,3.225,11.58,8.694,14.11l175.93,81.379l81.379,175.93c2.46,5.318,7.782,8.703,13.612,8.703 c0.165,0,0.332-0.003,0.498-0.008c6.023-0.199,11.342-3.983,13.505-9.607L459.002,20.385C461.13,14.852,459.8,8.585,455.608,4.394 z M278.354,406.523l-68.807-148.751c-0.747-1.615-1.769-3.07-3.008-4.309L418.887,41.116L278.354,406.523z">
                        </path>
                    </g>
                </g>
            </svg>
        </Button>
    </div>


    <div v-if="isChatOpen" class="chat-window">
        <div class="chat-content">
            <div class="chat-sidebar">
                <div class="chat-header">
                    <h2>Chat</h2>
                    <button class="close-button" @click="toggleChat">×</button>
                </div>
                <ul class="chat-list">
                    <li v-for="chat in filteredChats" :key="chat.id"
                        @click="fetchMessages(chat.id_propietari, chat.id_music)">
                        <div class="avatar">
                            {{ chat.id_propietari === this.currentUserId ? chat.music.nom : chat.propietari.nom }}
                        </div>

                        <div class="chat-info">
                            <p class="chat-name">
                                {{ chat.id_propietari === this.currentUserId ? chat.music.nom : chat.propietari.nom }}
                            </p>
                            <p class="chat-last">Último mensaje...</p>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="chat-messages">
                <div v-if="messages.length" class="messages-container">
                    <div v-for="message in messages" :key="message.id" class="message-bubble"
                        :class="{ 'from-user': message.propietari.id === currentUserId }">
                        <span>{{ message.missatge }}</span>
                    </div>
                </div>

                <form @submit.prevent="sendMessage" class="message-form">
                    <input v-model="newMessage" placeholder="Escribe tu mensaje" required />
                    <button type="submit">Enviar</button>
                </form>
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
            isChatOpen: false,
            chats: [],
            messages: [],
            newMessage: "",
            currentChat: null,
            currentChatName: "",
        };
    },
    computed: {
        currentUserId() {
            return this.usuarioId;
        },
        filteredChats() {
            const uniqueChats = new Map();

            this.chats.forEach(chat => {
                const key = `${chat.id_propietari}-${chat.id_music}`;
                if (!uniqueChats.has(key)) {
                    uniqueChats.set(key, chat);
                }
            });

            return Array.from(uniqueChats.values()).filter(chat => chat.id_propietari === this.currentUserId || chat.id_music === this.currentUserId);
        }


    },
    created() {
        this.fetchChats();
    },
    methods: {
        toggleChat() {
            this.isChatOpen = !this.isChatOpen;
        },
        async fetchChats() {
            try {
                const response = await axios.get("chat");
                this.chats = response.data;
            } catch (error) {
                console.error("Error al obtener conversaciones", error);
            }
        },
        async fetchMessages(idPropietari, idMusic) {
            try {
                const response = await axios.get(`chat/${idPropietari}/${idMusic}`);
                this.messages = response.data;
                this.currentChat = { idPropietari, idMusic };
                const currentUser = this.chats.find(
                    (chat) =>
                        chat.id_propietari === idPropietari && chat.id_music === idMusic
                );
                this.currentChatName = currentUser
                    ? `${currentUser.propietari.name} y ${currentUser.music.name}`
                    : "Usuario";
            } catch (error) {
                console.error("Error al obtener mensajes", error);
            }
        },
        async sendMessage() {
            if (!this.currentChat) return alert("Selecciona una conversación");
            try {
                const { idPropietari, idMusic } = this.currentChat;
                const response = await axios.post("/chat", {
                    id_propietari: idPropietari,
                    id_music: idMusic,
                    missatge: this.newMessage,
                });
                this.messages.push(response.data);
                this.newMessage = "";
            } catch (error) {
                console.error("Error al enviar el mensaje", error);
            }
        },
    },
};
</script>


<style scoped>
.icono-chat {
    position: fixed;
    bottom: 0;
    right: 0;
    margin: 20px;
    z-index: 1000;

}

.chat-header h2 {
    display: flex;
    justify-content: space-between;
    padding: 20px;
    text-transform: uppercase;
    font-weight: bold;
    margin-left: 40px;
    background: #222E50;
    color: #EEC765;
}

.close-button {
    background: none;
    border: none;
    color: #EEC765;
    font-size: 38px;
    cursor: pointer;
    position: absolute;
    top: 10px;

}

.chat-window {
    position: fixed;
    bottom: 10px;
    right: 10px;
    width: 800px;
    height: 600px;
    background: #f5f5f5;
    display: flex;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
    z-index: 1000;
}

.chat-content {
    display: flex;
    width: 100%;
    height: 100%;
}

.chat-sidebar {
    width: 30%;
    background: #222E50;
    color: #EEC765;
    display: flex;
    flex-direction: column;
    overflow-y: auto;
    padding: 20px;
}

.chat-sidebar h2 {
    margin-bottom: 20px;
}

.chat-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.chat-list li {
    display: flex;
    align-items: center;
    padding: 10px;
    margin-bottom: 10px;
    cursor: pointer;
    border-radius: 10px;
}

.chat-list li:hover {
    background: #4260b4;
}

.avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    text-transform: uppercase;
    background: #EEC765;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #222E50;
    font-weight: bold;
    font-size: 20px;
    margin-right: 10px;
}

.chat-info {
    display: flex;
    flex-direction: column;
}

.chat-name {
    font-weight: bold;
}

.chat-last {
    font-size: 12px;
    color: #EEC765;
}

.chat-messages {
    width: 70%;
    background: #ffffff;
    display: flex;
    flex-direction: column;
    position: relative;
}

.messages-container {
    flex: 1;
    overflow-y: auto;
    padding: 20px;
}

.message-bubble {
    max-width: 70%;
    margin-bottom: 10px;
    padding: 10px;
    border-radius: 15px;
    background: #222E50;
    color: #ffffff;
}

.message-bubble.from-user {
    background: #222E50;
    color: rgb(0, 0, 0);
    align-self: flex-end;
}

.message-form {
    display: flex;
    padding: 10px;
    background: #f5f5f5;
    border-top: 1px solid #ddd;
}

.message-form input {
    flex: 1;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 10px;
    color: black;
    margin-right: 10px;
}

.message-form button {
    background: #EEC765;
    color: white;
    border: none;
    border-radius: 10px;
    padding: 10px 20px;
    cursor: pointer;
}
</style>
