<template lang="">
   <!--saved lists-->
    <div class="h-full mt-4">
        <div class="flex m-auto lg:w-2/3 w-3/4 justify-between p-3 bg-gray-300 rounded-lg mb-2" v-for="list in savedLists">
            <a class="w-3/4" :href="`shopping-list/${list.id}`">
                {{ `list_${list.id}  ${list.created_at.substring(0,10)}` }}
            </a>
            <DangerButton @click="deleteList(list.id)">Delete</DangerButton>
        </div>
    </div>
</template>
<script setup>
import axios from "axios";
import DangerButton from "@/Components/DangerButton.vue";
import { router } from '@inertiajs/vue3';

const props = defineProps(['savedLists']);

function deleteList(id) {
    axios.delete(`/shopping-list/${id}`).then(() => {
        alert(
            'List deleted!'
        )
        router.reload({only: ['savedLists']});

    }).catch(error => alert(error.response.data.message));
}

</script>
<style lang="">

</style>
