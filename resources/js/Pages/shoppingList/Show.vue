<template lang="">
    <div>
    <div class="p-3">
        <SecondaryButton><a href="/shopping-list">Back</a></SecondaryButton>
        <SecondaryButton><a :href="`/shopping-list/${props.id}/edit`">Edit</a></SecondaryButton>
    </div>
    <shopping-list :readOnly="true" :list="list"></shopping-list>
    </div>
</template>
<script setup>
import SecondaryButton from '../../Components/SecondaryButton.vue';
import ShoppingList from '../../Components/ShoppingList.vue';
const props = defineProps(['list', 'id']);
</script>
<style lang="">

</style>
