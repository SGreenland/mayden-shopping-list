<script setup>
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Dashboard" />
       <div class="h-[calc(100vh-80px)] grid place-items-center">
           <h1 class="text-xl">Welcome {{ $page.props.auth.user.name }}!</h1>
       </div>
</template>
