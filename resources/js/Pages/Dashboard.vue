<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import AddNewItemForm from '@/Components/AddNewItemForm.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
       <div class="h-screen grid place-items-center">
           <h1 class="text-xl">Welcome to my Shopping List App!</h1>
       </div>
    </AuthenticatedLayout>
</template>
