<template>
    <Sidebar @toggleChildClass="toggleChildClass" />
    <div ref="homeContent" class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
            <Bar
                id="my-chart-id"
                :options="chartOptions"
                :data="chartData"
            />
        </div>

        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-10">
            <Bar
                id="my-chart-id"
                :options="chartOptions1"
                :data="chartData1"
            />
        </div>
    </div>
</template>

<script>
import Sidebar from './Layouts/Sidebar.vue';
import { Bar } from 'vue-chartjs';
import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale } from 'chart.js'
ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale)

export default {
    name: 'BarChart',
    components: {
        Sidebar,
        Bar,
    },
    props: {
        userRegister: {
            type: Array,
        
        },

        userJawab:{
            type: Array,
        }
    },

    data() {
        return {
            chartData: {
                labels: [ 'Sen', 'Sel', 'Rab' ,'Kam','Jum','Sab','Ming'],
                datasets: [
                    {
                        label: 'User Register',
                        backgroundColor: '#06b6d4',
                        data: this.userRegister
                    }
                ]
            },
            chartOptions: {
                responsive: true
            },


            chartData1: {
                labels: [ 'Sen', 'Sel', 'Rab' ,'Kam','Jum','Sab','Ming'],
                datasets: [
                    {
                        label: 'User Jawab pertanyaan',
                        backgroundColor: '#34d399',
                        data: this.userJawab
                    }
                ]
            },
            chartOptions1: {
                responsive: true
            },


        }
    },


    methods: {
        toggleChildClass() {
        this.$refs.homeContent.classList.toggle('sm:ml-64');
        }
    }
  // Logika komponen lain
}


</script>
