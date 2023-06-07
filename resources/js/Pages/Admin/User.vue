<template>
    <Sidebar @toggleChildClass="toggleChildClass" />
    <div  ref="homeContent" class="p-4 sm:ml-64">
        <div  class="flex flex-wrap items-center justify-evenly">

            <div v-for="user in users" :key="user" class="max-w-xs w-80 p-6 mb-3 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <div class="flex items-end space-x-2">
                    <div  :class="user.color + ' flex items-center justify-center w-12 h-12 text-white rounded-full'">
                        {{ user.name.charAt(0) }}
                    </div>
                    <div  v-if="user.status === 0" class="w-4 h-4 rounded-full bg-blue-500 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="6" stroke="currentColor" class="w-2 h-2 font-bold text-white">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                        </svg>
                    </div>
                    <div v-if="user.status === 1" class="w-4 h-4 bg-red-500 rounded-full flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-3 h-3 text-white">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>

                    </div>

                </div>

                <!-- <svg class="w-10 h-10 mb-2 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5 5a3 3 0 015-2.236A3 3 0 0114.83 6H16a2 2 0 110 4h-5V9a1 1 0 10-2 0v1H4a2 2 0 110-4h1.17C5.06 5.687 5 5.35 5 5zm4 1V5a1 1 0 10-1 1h1zm3 0a1 1 0 10-1-1v1h1z" clip-rule="evenodd"></path><path d="M9 11H3v5a2 2 0 002 2h4v-7zM11 18h4a2 2 0 002-2v-5h-6v7z"></path></svg> -->
                <a href="#">
                    <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white"> {{ user.name.length > 20 ? user.name.slice(0, 20) + '...' : user.name }}</h5>
                </a>
                <div>
                    <p class="mb-3 font-normal text-gray-500 dark:text-gray-400">
                        @{{ user.username }}
                    </p>
                    <p class="mb-3 font-normal text-gray-500 dark:text-gray-400">
                        {{ user.email }}
                    </p>

                </div>
                <div class="flex items-center justify-between">
                    <a href="#" class="inline-flex items-center text-blue-600 hover:underline">
                        See our guideline
                        <svg class="w-5 h-5 ml-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M11 3a1 1 0 100 2h2.586l-6.293 6.293a1 1 0 101.414 1.414L15 6.414V9a1 1 0 102 0V4a1 1 0 00-1-1h-5z"></path><path d="M5 5a2 2 0 00-2 2v8a2 2 0 002 2h8a2 2 0 002-2v-3a1 1 0 10-2 0v3H5V7h3a1 1 0 000-2H5z"></path></svg>
                    </a>
                    <button v-if="user.status === 1" @click="verifyUser(user.id)" class="hover:bg-blue-500 hover:text-white font-semibold text-blue-500 border-[2px] border-blue-500 rounded text-sm p-1">
                        Verify
                    </button>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
import Sidebar from '../Layouts/Sidebar.vue';
import { useForm,Link } from '@inertiajs/vue3';
import { ref , reactive } from 'vue';

export default {
    components: {
        Sidebar,
        Link
    },

    props: {
        users: {
            type: Array,
        
        },
    },
    
    methods: {
        toggleChildClass() {
            this.$refs.homeContent.classList.toggle('sm:ml-64');
        },
        
        verifyUser(id){
           
            this.$inertia.post('/verify-user/'+id,{}, {
                preserveScroll: true
            });
        }

    }
 
}


</script>
