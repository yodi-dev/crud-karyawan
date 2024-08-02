<script setup>
//import ref
import { ref } from "vue";

//import router
import { useRouter } from 'vue-router';

//import api
import api from "../../api";

//init router
const router = useRouter();

//define state
const nama = ref("");
const pekerjaan_id = ref("");
const divisi = ref("");
const status = ref("");
const errors = ref([]);


//method "storePost"
const storePost = async () => {

    //init formData
    let formData = new FormData();

    //assign state value to formData
    formData.append("nama", nama.value);
    formData.append("pekerjaan_id", pekerjaan_id.value);
    formData.append("divisi", divisi.value);
    formData.append("status", status.value);

    //store data with API
    await api.post('/api/karyawans', formData)
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
                        <form @submit.prevent="storePost()">
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
                                class="btn btn-md btn-primary rounded-sm shadow border-0">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
