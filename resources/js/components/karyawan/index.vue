<script setup>
//import ref and onMounted
import { ref, onMounted } from 'vue';

//import api
import api from '../../api';

//define state
const karyawans = ref([]);

//method fetchDataKaryawans
const fetchDataKaryawans = async () => {
    //fetch data
    await api.get('/api/karyawans')
        .then(response => {
            //set response data to state "posts"
            karyawans.value = response.data.data
            // console.log(response.data.data);
        });
}

//run hook "onMounted"
onMounted(() => {
    //call method "fetchDataKaryawans"
    fetchDataKaryawans();
});

//method deleteKaryawan
const deleteKaryawan = async (id) => {

    //delete Karyawan with API
    await api.delete(`/api/karyawans/${id}`)
        .then(() => {
            //call method "fetchDataKaryawans"
            fetchDataKaryawans();
        })

};

</script>

<template>
    <div class="container-fluid pb-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 rounded shadow">
                    <div class="card-header">
                        <h2>Data Karyawan</h2>
                    </div>
                    <div class="card-body">
                        <router-link :to="{ name: 'karyawans.create' }"
                            class="btn btn-md rounded shadow border-0 mb-3">+</router-link>
                        <table class="table table-bordered">
                            <thead class="bg-dark text-white">
                                <tr>
                                    <th class="text-center" scope="col">Nama</th>
                                    <th class="text-center" scope="col">Pekerjaan</th>
                                    <th class="text-center" scope="col">Divisi</th>
                                    <th class="text-center" scope="col">Status</th>
                                    <th class="text-center" scope="col" style="width:15%">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-if="karyawans.length == 0">
                                    <td colspan="5" class="text-center">
                                        <div class="alert alert-danger mb-0">
                                            Data Belum Tersedia!
                                        </div>
                                    </td>
                                </tr>
                                <tr v-else v-for="(value, index) in karyawans" :key="index">
                                    <td>{{ value.nama }}</td>
                                    <td>{{ value.pekerjaan }}</td>
                                    <td>{{ value.divisi }}</td>
                                    <td>{{ value.status }}</td>
                                    <td class="text-center">
                                        <router-link :to="{ name: 'karyawans.edit', params: { id: value.id } }" class="btn btn-sm rounded-sm shadow border-0 me-2">EDIT</router-link>
                                        <button @click.prevent="deleteKaryawan(value.id)" class="btn btn-sm rounded-sm shadow border-0">DEL</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

