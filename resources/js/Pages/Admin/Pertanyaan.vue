<template>
    <Sidebar @toggleChildClass="toggleChildClass" />
    <div ref="homeContent" class="p-4 sm:ml-64">
        <div class="w-3/4 mx-auto flex flex-col p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
            <div v-if="$page.props.auth.admin === true" class="w-full mb-5 flex justify-end">
                <Link href="/tambah-pertanyaan">
                    <button class=" bg-blue-500 text-white p-2 rounded-md text-sm">Buat pertanyaan</button>
                </Link>
            </div>
            <div class="relative overflow-x-auto px-10">
                <form class="mt-5" @submit.prevent="jawabPertanyaan">
                <div v-for="item in loadPertanyaan" :key="item">
                    <div class="relative z-0 w-full mb-6 group">

                        <label
                            :for="item.type === 'checkbox' ? 'floating_checkbox' : 'floating_email'"
                            class="text-blue-600 text-sm"
                        >{{ item.name_text }}</label>
                        <!-- Render input field if item.type is not checkbox -->
                        <input
                            v-if="item.type === 'text'"
                            type="text"
                            :value="formData[item.name]"
                            @input="formData[item.name] = $event.target.value"
                            id="floating_email"
                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                            placeholder=" "
                        />

                        <!-- Render checkbox if item.type is checkbox -->
                        <div v-for="pilihan in item.jawaban" :key="item.jawaban" v-else-if="item.type === 'checkbox'" class="flex items-center mb-4 mt-5">
                            <input
                                type="checkbox"
                                @change="toggleCheckbox(item.name, pilihan)"
                                :id="pilihan"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                            />
                            <!-- <input
                            type="checkbox"
                           
                            @change="formData[item.name] = pilihan"
                            id=""
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                            /> -->
                            <label for="default-checkbox" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ pilihan.jawaban.charAt(0).toUpperCase() + pilihan.jawaban.slice(1) }}</label>
                        </div>

                        <div v-for="pilihan in item.jawaban" :key="pilihan" v-else-if="item.type === 'radio'" class="flex items-center mb-4 mt-5">
                            <input
                                type="radio"
                                :checked="formData[item.name] === pilihan"
                                @change="formData[item.name] = pilihan"
                                id=""
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                            />
                            <label for="default-checkbox" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ pilihan.jawaban.charAt(0).toUpperCase() + pilihan.jawaban.slice(1) }}</label>
                        </div>

                        
                   

                    </div>
                </div>
                    
                    <button v-if="$page.props.auth.admin === false" type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Main modal -->
    <div id="modalPertanyaan" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Tambah Pertanyaan
                    </h3>
                    <!-- <button @click="modalDismisPertanyaan" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" >
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        <span class="sr-only">Close modal</span>
                    </button> -->
                </div>
                <!-- Modal body -->
                <form action="" @submit.prevent="submitPertanyaan">
                    <div class="p-6 space-y-6">
                        <div>
                            <label for="small-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Type pertanyaan</label>
                            <select v-model="data.valuePertanyaan" @change="typePertanyaan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected value="text">Input</option>
                                <option value="checkbox">Pilihan checkbox</option>
                                <option value="radio">Pilihan radio</option>
                            </select>
                        </div>

                        <div class="mt-5">
                            <div>
                                <label for="small-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title pertanyaan</label>
                                <input v-model="data.titlePertanyaan" type="text" id="small-input" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
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
                    <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">I accept</button>
                        <!-- <button @click="modalDismisPertanyaan" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Decline</button> -->
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import Sidebar from '../Layouts/Sidebar.vue';
import { useForm , Link } from '@inertiajs/vue3';
import { Modal } from 'flowbite';
import { ref , reactive } from 'vue';

export default {
    components: {
        Sidebar,
        Link
    },

    props: {
        loadPertanyaan: {
        type: Array,
        
        },
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

            const targetEl = document.getElementById('modalPertanyaan');
            const modal = new Modal(targetEl, {});
            modal.hide();
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

        modalAddPertanyaan: function(){
            const targetEl = document.getElementById('modalPertanyaan');
            const modal = new Modal(targetEl, {});
            modal.show();

        },


        jawabPertanyaan: function(){
            const submit = this.formData;
            this.$inertia.post('/submit-pertanyaan',{data:submit}, {
                preserveScroll: true
            });
        },
        toggleCheckbox(fieldName, value) {
            if (!this.formData[fieldName]) {
                // Jika nilai belum ada, inisialisasi dengan array kosong
                this.formData[fieldName] = [];
            }

            if (this.formData[fieldName].includes(value)) {
                // Jika nilai sudah ada dalam array, hapus dari array
                const index = this.formData[fieldName].indexOf(value);
                this.formData[fieldName].splice(index, 1);
            } else {
                // Jika nilai belum ada dalam array, tambahkan ke array
                this.formData[fieldName].push(value);
            }
        }

    }
  // Logika komponen lain
}


</script>
