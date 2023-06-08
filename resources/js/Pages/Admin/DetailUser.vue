<template>
    <Sidebar @toggleChildClass="toggleChildClass" />
    <div  ref="homeContent" class="p-4 sm:ml-64">
        <div class="w-3/4 mx-auto flex flex-col p-4 border-2 border-blue-500 border-dashed rounded-lg dark:border-gray-700">
            <div class="mx-auto">
                <div class="flex items-center space-x-8 max-w-sm p-6 bg-white  rounded-lg dark:bg-gray-800 dark:border-gray-700">
                    <div class="w-24">
                        <div :class="data.color + ' w-24 h-24 text-lg flex items-center justify-center text-white rounded-full'">
                             {{ data.name.charAt(0).toUpperCase() }}
                            <!-- <svg class="w-10 h-10 mb-2 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5 5a3 3 0 015-2.236A3 3 0 0114.83 6H16a2 2 0 110 4h-5V9a1 1 0 10-2 0v1H4a2 2 0 110-4h1.17C5.06 5.687 5 5.35 5 5zm4 1V5a1 1 0 10-1 1h1zm3 0a1 1 0 10-1-1v1h1z" clip-rule="evenodd"></path><path d="M9 11H3v5a2 2 0 002 2h4v-7zM11 18h4a2 2 0 002-2v-5h-6v7z"></path></svg> -->
                        </div>

                    </div>
                    <div>
                        <a href="#">
                            <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">{{ data.name }}</h5>
                        </a>
                        <p class=" font-normal text-gray-500 dark:text-gray-400">@{{ data.username }}</p>
                        <span class=" font-normal text-gray-500 dark:text-gray-400">{{ data.email }}</span>
                    </div>
                </div>
            </div>

            <div v-if="jawaban !== null" class="grid grid-cols-2 gap-4">
                <div v-for="(item, index) in objectEntries(jawaban)" :key="index" class="p-4 bg-gray-100 border rounded">
                <p class="font-semibold">{{ item[0] }}</p>
                <template v-if="Array.isArray(item[1])">
                    <div v-for="(subItem, subIndex) in item[1]" :key="subIndex" class="ml-4 mt-2">
                        <p class="text-gray-500">{{ subItem['jawaban'] }}</p>
                    </div>
                </template>
                <template v-else-if="typeof item[1] === 'object'">
                    <div class="ml-4 mt-2">
                        <p class="text-gray-500">{{ item[1]['jawaban'] }}</p>
                    </div>
                </template>
                <template v-else>
                    <div class="ml-4 mt-2">
                        <p class="text-gray-500">{{ item[1] }}</p>
                    </div>
                </template>
                </div>
            </div>

            <div v-else class="flex flex-col items-center justify-center h-48">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-32 h-32 text-gray-500 opacity-50">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" />
                </svg>

                <h1 class="text-gray-500 text-1xl font-semibold">User belum menjawab pertanyaan</h1>
            </div>
           
        </div>
    </div>

</template>

<script>
import Sidebar from '../Layouts/Sidebar.vue';
import { Link } from '@inertiajs/vue3';


export default {
    components: {
        Sidebar,
        Link
    },

    props: {
        data: {
            type: Array,
        
        },
        jawaban:{
             type: Array,
        }
    },
    
    methods: {
        toggleChildClass() {
            this.$refs.homeContent.classList.toggle('sm:ml-64');
        },
        
        verifyUser(id){
           
            this.$inertia.post('/verify-user/'+id,{}, {
                preserveScroll: true
            });
        },
        objectEntries(obj) {
            return Object.entries(obj);
        }

    }
 
}


</script>
