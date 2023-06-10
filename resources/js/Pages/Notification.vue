<template>
    <Sidebar @toggleChildClass="toggleChildClass" />
    <div ref="homeContent" class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
            
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3 rounded-l-lg">
                                Notification
                            </th>
                            <th></th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="item in notif" :key="item" class="bg-white dark:bg-gray-800">
                            <th scope="row" class="hover:cursor-pointer  ">
                                <Link class="flex space-x-2 items-center justify-start px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white" :href="'/detail-notification/'+ item.id">
                                <svg v-if="item.read_at_at == null" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-white">
                                    <path fill="#22c55e" stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                                </svg>
                                <svg v-if="item.read_at_at != null" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gray-50">
                                    <path fill="#dc2626" stroke-linecap="round" stroke-linejoin="round" d="M21.75 9v.906a2.25 2.25 0 01-1.183 1.981l-6.478 3.488M2.25 9v.906a2.25 2.25 0 001.183 1.981l6.478 3.488m8.839 2.51l-4.66-2.51m0 0l-1.023-.55a2.25 2.25 0 00-2.134 0l-1.022.55m0 0l-4.661 2.51m16.5 1.615a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V8.844a2.25 2.25 0 011.183-1.98l7.5-4.04a2.25 2.25 0 012.134 0l7.5 4.04a2.25 2.25 0 011.183 1.98V19.5z" />
                                </svg>

                                <span> {{ item.body }} </span>
                                </Link>
                            </th>
                            <th>
                                <span>{{ formatTime(item.created_at) }}</span>
                            </th>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>

       
    </div>
</template>

<script>
import Sidebar from './Layouts/Sidebar.vue';
import moment from 'moment';
import { Link } from '@inertiajs/vue3';
import 'moment/locale/id'; // Jika Anda ingin menggunakan bahasa Indonesia

moment.locale('id'); // Mengatur bahasa ke bahasa Indonesia

export default {
   
    components: {
        Sidebar,
        Link,
    },
    props: {
        notif: {
            type: Array,
        
        },

    },



    methods: {
        toggleChildClass() {
            this.$refs.homeContent.classList.toggle('sm:ml-64');
        },
        formatTime(created_at) {
            return moment(created_at).fromNow();
        },
    }
  // Logika komponen lain
}


</script>
