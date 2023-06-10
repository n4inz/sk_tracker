<template>
    <Sidebar @toggleChildClass="toggleChildClass" />
    <div ref="homeContent" class="p-4 sm:ml-64">
        <div class="p-4 mt-24 flex mx-auto border-2 w-[400px]  flex-col items-center justify-center rounded-lg dark:border-gray-700">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-20 h-20 text-gray-50 opacity-80">
                <path fill="#ef4444" stroke-linecap="round" stroke-linejoin="round" d="M21.75 9v.906a2.25 2.25 0 01-1.183 1.981l-6.478 3.488M2.25 9v.906a2.25 2.25 0 001.183 1.981l6.478 3.488m8.839 2.51l-4.66-2.51m0 0l-1.023-.55a2.25 2.25 0 00-2.134 0l-1.022.55m0 0l-4.661 2.51m16.5 1.615a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V8.844a2.25 2.25 0 011.183-1.98l7.5-4.04a2.25 2.25 0 012.134 0l7.5 4.04a2.25 2.25 0 011.183 1.98V19.5z" />
            </svg>

            <span class="text-center text-slate-700 mt-5">{{ notif.body }}</span>
        </div>
    </div>
</template>

<script>
import Sidebar from './Layouts/Sidebar.vue';
import moment from 'moment';
import 'moment/locale/id'; // Jika Anda ingin menggunakan bahasa Indonesia

moment.locale('id'); // Mengatur bahasa ke bahasa Indonesia

export default {
   
    components: {
        Sidebar,
      
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
    }
  // Logika komponen lain
}


</script>
