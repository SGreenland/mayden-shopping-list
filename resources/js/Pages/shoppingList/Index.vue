<template lang="">
   <!--saved lists-->
   <AuthenticatedLayout>
    <div class="h-full mt-4">
        <div class="flex m-auto w-3/4 justify-center" v-for="list in savedLists">
            <a :href="`shopping-list/${list.id}`">
                {{ list.created_at.substring(0,10) }}
            </a>
        </div>
    </div>
    </AuthenticatedLayout>
</template>
<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
const props = defineProps(['savedLists']);

</script>
<style lang="">

</style>
