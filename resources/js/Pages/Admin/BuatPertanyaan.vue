<template>
    <Sidebar @toggleChildClass="toggleChildClass" />
    <div ref="homeContent" class="p-4 sm:ml-64">
        <div class="w-3/4 mx-auto flex flex-col p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
            <!-- <div class="w-full mb-5 flex justify-end">
                <button @click="modalAddPertanyaan" class=" bg-blue-500 text-white p-2 rounded-md text-sm">Buat pertanyaan</button>
            </div> -->
            <div class="relative overflow-x-auto px-10">
                                <form action="" @submit.prevent="submitPertanyaan">
                    <div class="p-6 space-y-6">
                        <div>
                            <label for="small-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Type pertanyaan</label>
                            <select v-model="data.valuePertanyaan" @change="typePertanyaan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected value="text">Input</option>
                                <option value="checkbox">Pilihan checkbox</option>
                                <option value="radio">Pilihan radio</option>
                            </select>
                            <div v-if="data.errors.valuePertanyaan" v-text="data.errors.valuePertanyaan" class="text-xs text-red-500 mt-2"></div>
                        </div>

                        <div class="mt-5">
                            <div>
                                <label for="small-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title pertanyaan</label>
                                <input v-model="data.titlePertanyaan" type="text" id="small-input" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <div v-if="data.errors.titlePertanyaan" v-text="data.errors.titlePertanyaan" class="text-xs text-red-500 mt-2"></div>
                            </div>

                            <div class="mt-5">
                                <div ref="jawabanTitle" class="hidden flex items-center space-x-2 mb-2">
                                    <label  for="small-input" class="block text-sm font-medium text-gray-900 dark:text-white">Jawaban</label>
                                    <div @click="addJawaban" class="hover:cursor-pointer">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex flex-wrap"  v-for="item,index in formJawaban" :key="item">
                                    <div class="w-full mr-3 mb-1">
                                        <input v-model="data.jawaban[index]" type="text" id="small-input" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center justify-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600 mx-auto">
                        <Link class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600" href="/pertanyaan">Kembali</Link>
                        <button type="submit" class="text-white bg-blue-700 mx-auto hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-16 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Tambah</button>
                       
                    </div>
                </form>
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

    data() {
        return {
        formData: {},
        };
    },

    setup(){
        const jawabanTitle = ref(null);
        const formJawaban = reactive([])
        const data = useForm({
            valuePertanyaan: '',
            titlePertanyaan:'',
            jawaban:[]
        })

        const typePertanyaan = () => {
            if (data.valuePertanyaan !== 'text') {
                jawabanTitle.value.classList.remove('hidden');
                 formJawaban.push({ jawaban : ''})

            } else {
                jawabanTitle.value.classList.add('hidden');
                jawaban.value = '';
            }
        
        }

        const submitPertanyaan = () => {
            data.post('/store-pertanyaan');
        }

        const addJawaban = () => {
            formJawaban.push({ jawaban : ''})
        }

        return {
            addJawaban,
            formJawaban,
            data,
            jawabanTitle,
            typePertanyaan,
            submitPertanyaan
        };


    },
    methods: {
        toggleChildClass() {
        this.$refs.homeContent.classList.toggle('sm:ml-64');
        },

        jawabPertanyaan: function(){
             console.log(this.formData)

        },

    }
  // Logika komponen lain
}


</script>
