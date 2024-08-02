<script setup>
//import ref and onMounted
import { ref, onMounted } from 'vue';

//import api
import api from '../api';

//define state
const total = ref("");
const aktif = ref("");
const nonaktif = ref("");

//method fetchDataCount
const fetchDataCount = async () => {
    //fetch data
    await api.get('/api/karyawan/count')
        .then(response => {
            total.value = response.data.data.total
            aktif.value = response.data.data.aktif
            nonaktif.value = response.data.data.nonaktif
            // console.log(total);
        });
}

//run hook "onMounted"
onMounted(() => {
    //call method "fetchDataKaryawans"
    fetchDataCount();
});

</script>

<template>
    <div class="container-fluid pb-5">
        <div class="card border-0 rounded shadow mb-2 col-lg-4">
            <div class="card-body">
                <p>Total karyawan: {{ total }}</p>
            </div>
        </div>
        <div class="card border-0 rounded shadow col-lg-4">
            <div class="card-body">
                <p>Total karyawan aktif: {{ aktif }}</p>
                <p>Total karyawan nonaktif: {{ nonaktif }}</p>
            </div>
        </div>
    </div>
</template>
