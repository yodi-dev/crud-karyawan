<script setup>
//import ref
import { ref, onMounted } from "vue";

//import router
import { useRouter, useRoute } from 'vue-router';

//import api
import api from "../../api";

//init router
const router = useRouter();

//init route
const route = useRoute();

//define state
const nama = ref("");
const pekerjaan_id = ref("");
const divisi = ref("");
const status = ref("");
const errors = ref([]);

//onMounted
onMounted(async () => {
    //fetch detail data post by ID
    await api.get(`/api/karyawans/${route.params.id}`)
        .then(response => {
            //set response data to state
            nama.value = response.data.data.nama
            pekerjaan_id.value = response.data.data.pekerjaan_id
            divisi.value = response.data.data.divisi
            status.value = response.data.data.status
            // console.log(response);
        });
})


//method "updateKaryawan"
const updateKaryawan = async () => {
    //init formData
    let formData = new FormData();

    //assign state value to formData
    formData.append("nama", nama.value);
    formData.append("pekerjaan_id", pekerjaan_id.value);
    formData.append("divisi", divisi.value);
    formData.append("status", status.value);
    formData.append("_method", "PATCH");

    //store data with API
    await api.post(`/api/karyawans/${route.params.id}`, formData)
        .then(() => {
            //redirect
            router.push({ path: "/karyawan" });
        })
        .catch((error) => {
            //assign response error data to state "errors"
            errors.value = error.response.data;
        });
};
</script>

<template>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 rounded shadow">
                    <div class="card-body">
                        <form @submit.prevent="updateKaryawan()">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Nama</label>
                                <input type="text" class="form-control" v-model="nama" placeholder="Masukkan nama">
                                <div v-if="errors.nama" class="alert alert-danger mt-2">
                                    <span>{{ errors.nama[0] }}</span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Pekerjaan</label>
                                <input type="text" class="form-control" v-model="pekerjaan_id"
                                    placeholder="ID Pekerjaan">
                                <div v-if="errors.pekerjaan_id" class="alert alert-danger mt-2">
                                    <span>{{ errors.pekerjaan_id[0] }}</span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Divisi</label>
                                <input class="form-control" v-model="divisi" placeholder="divisi">
                                <div v-if="errors.divisi" class="alert alert-danger mt-2">
                                    <span>{{ errors.divisi[0] }}</span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Status</label>
                                <input class="form-control" v-model="status" placeholder="status">
                                <div v-if="errors.status" class="alert alert-danger mt-2">
                                    <span>{{ errors.status[0] }}</span>
                                </div>
                            </div>
                            <button type="submit"
                                class="btn btn-md btn-primary rounded-sm shadow border-0">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
