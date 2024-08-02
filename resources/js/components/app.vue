<script setup>

</script>

<template>
    <div class="px-5 bg-light rounded-3">
        <div class="container-fluid py-5">
            <h1 class="display-5 fw-bold">Welcome!</h1>
            <nav>
                <router-link class="btn" to="/">Home</router-link>
                <router-link class="btn" to="/karyawan">Data</router-link>
            </nav>
        </div>
        <router-view/>
    </div>
</template>
