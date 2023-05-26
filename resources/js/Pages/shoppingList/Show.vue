<template lang="">
    <div>
    <div class="p-3">
        <SecondaryButton><a href="/shopping-list">Back</a></SecondaryButton>
    </div>
    <shopping-list :list="list"></shopping-list>
    </div>
</template>
<script setup>
import SecondaryButton from '../../Components/SecondaryButton.vue';
import ShoppingList from '../../Components/ShoppingList.vue';
const props = defineProps(['list']);
</script>
<style lang="">

</style>
