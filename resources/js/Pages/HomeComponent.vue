<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import HomeLayout from '@/Layouts/HomeLayout.vue';
import Home from '@/Components/Front/Home.vue';
import { Link } from '@inertiajs/inertia-vue3';
</script>

<template>
    <Head title="Home" />
    <HomeLayout>

    <Home/>


    <slot />


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>
    </HomeLayout>
</template>
