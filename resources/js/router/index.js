//import vue router
import { createRouter, createWebHistory } from 'vue-router'
import home from '../components/home.vue';
import karyawan from '../components/karyawan/index.vue';
import create from '../components/karyawan/create.vue';
import edit from '../components/karyawan/edit.vue';

//define a routes
const routes = [
    {
        path: '/',
        component: home
    },
    {
        path: '/karyawan',
        component: karyawan
    },
    {
        path: '/create',
        name: 'karyawans.create',
        component: create
    },
    {
        path: '/edit/:id',
        name: 'karyawans.edit',
        component: edit
    }
]

//create router
const router = createRouter({
    history: createWebHistory(),
    routes // <-- routes,
})

export default router
