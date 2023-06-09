<template>
    <Sidebar @toggleChildClass="toggleChildClass" />
    <div ref="homeContent" class="p-4 sm:ml-64">
         <div class="container mx-auto p-4">
            <div class="flex flex-col ">
                <div class="flex-1 border-b-2">
                    <div class="p-4 bg-gray-200">
                    <h1 class="text-lg font-bold">Chat Group</h1>
                    </div>
                    <div ref="messageContainer" class="p-4 flex flex-col overflow-y-auto h-[350px]">
                        <div v-for="message in messages" :key="message.id" class="mb-2">
                            <div v-if="message.user_id == $page.props.auth.id" class="flex flex-row-reverse">
                            <div class="bg-blue-500 text-white rounded-lg p-2">
                                {{ message.body }}
                            </div>
                            </div>
                            <div v-else class="flex">
                            <div class="bg-gray-200 rounded-lg p-2">
                                {{ message.body }}
                            </div>
                            </div>
                        </div>
                                  <div ref="scrollAnchor"></div>

                    </div>
                </div>
                <div class="p-4">
                    <input
                    v-model="newMessage"
                    @keydown.enter="sendMessage"
                    placeholder="Type your message..."
                    class="border border-gray-300 rounded-lg px-4 py-2 w-full"
                    />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Sidebar from './Layouts/Sidebar.vue';
import axios from 'axios';

export default {
    components: {
        Sidebar
    },

    data() {
        return {
        messages: [
           
        ],
        newMessage: "",
        };
    },
    mounted() {
        // this.scrollToBottom();
        this.fetchMessages();
    },

    updated() {
        // this.scrollToBottom();
    },
    methods: {
        toggleChildClass() {
        this.$refs.homeContent.classList.toggle('sm:ml-64');
        },

        fetchMessages() {
             setInterval(() => {
                 axios.get('/getmessages') // Ganti dengan URL endpoint API Anda
                 .then(response => {
                     this.messages = response.data.data;
                     console.log(response.data.data)
                 })
                 .catch(error => {
                     console.error(error);
                 });
             }, 2000);
             
        },

        sendMessage() {
            if (this.newMessage) {
                this.messages.push({ id: Date.now(), body: this.newMessage, user_id:  this.$page.props.auth.id});
                this.$inertia.post('/store-chat' , {body: this.newMessage}) // Ganti dengan route Inertia Anda
                this.newMessage = "";
                this.scrollToBottom();
            }
        },
        scrollToBottom() {
        this.$nextTick(() => {
            const container = this.$refs.messageContainer;
            const anchor = this.$refs.scrollAnchor;
            container.scrollTop = anchor.offsetTop;
        });
        },
    }
  // Logika komponen lain
}


</script>
