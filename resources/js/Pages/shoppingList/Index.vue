<template lang="">
   <!--saved lists-->
    <div class="h-full mt-4">
        <div class="flex m-auto w-3/4 justify-center" v-for="list,index in savedLists">
            <a :href="`shopping-list/${list.id}`">
                {{ `list_${index}_${list.created_at.substring(0,10)}` }}
            </a>
        </div>
    </div>
</template>
<script setup>
const props = defineProps(['savedLists']);

</script>
<style lang="">

</style>
