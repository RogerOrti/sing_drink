<template>
    <div>
      <div class="icono-chat">
        <Button @click="mostrarModal" class="mb-4">
          <svg xmlns="http://www.w3.org/2000/svg" style="color: #EEC765;" width="75" height="75" fill="currentColor" class="bi bi-chat-dots-fill" viewBox="0 0 16 16">
            <path d="M16 8c0 3.866-3.582 7-8 7a9 9 0 0 1-2.347-.306c-.584.296-1.925.864-4.181 1.234-.2.032-.352-.176-.273-.362.354-.836.674-1.95.77-2.966C.744 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7M5 8a1 1 0 1 0-2 0 1 1 0 0 0 2 0m4 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0m3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2"/>
          </svg>
        </Button>
      </div>

      <Dialog v-model:visible="mostrar" id="chat" modal header="CHAT" :style="{ width: '40vw', background: '#EEC765' }">
        <div class="chat-container">
          <div class="user-list">
            <h3>Mensajes</h3>
            <ul>
              <li v-for="user in users" :key="user.id" @click="selectUser(user)" :class="{ active: selectedUser && selectedUser.id === user.id }">
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
              <div v-for="(msg, index) in selectedUser.messages" :key="index" :class="['message', index % 2 === 0 ? 'sent' : 'received']">
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
  import { ref } from "vue";
  import Dialog from "primevue/dialog";
  import Button from "primevue/button";
  import InputText from "primevue/inputtext";

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
      const users = ref([
        { id: 1, name: "Jordi Celemin", messages: ["No se programar ayudame."] },
        { id: 2, name: "Pablo Lin", messages: ["Xhe Xhe"] },
        { id: 3, name: "Roger", messages: ["Tienes 4kg de droga?"] },
        { id: 4, name: "Erfan", messages: ["Shadow the collonus el mejor juego de la historia !!!"] }
      ]);

      const mostrarModal = () => {
        mostrar.value = true;
      };

      const selectUser = (user) => {
        selectedUser.value = user;
      };

      const enviarFormulario = () => {
        if (newMessage.value.trim() && selectedUser.value) {
          selectedUser.value.messages.push(newMessage.value);
          newMessage.value = "";
        }
      };

      return {
        mostrar,
        newMessage,
        selectedUser,
        users,
        mostrarModal,
        selectUser,
        enviarFormulario
      };
    }
  };
  </script>

  <style >
  .icono-chat{
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
    height: 60vh;
    background: #EAEAEA;
  }
  .user-list {
    width: 20vh;
    background:  #222E50;
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
  .user-list li.active, .user-list li:hover {
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
    background: white;
    display: flex;
    flex-direction: column;
  }
  .chat-header {
    display: flex;
    align-items: center;
    padding: 20px;
    background: #F5F5F5;
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
    background: #F5F5F5;
  }
  .chat-input input {
    flex: 1;
    margin-right: 10px;
  }
  </style>
