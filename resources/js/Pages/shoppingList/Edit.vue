<template lang="">
    <add-new-item-form :savedList="props.list" :id="props.id"></add-new-item-form>
</template>
<script setup>
import { onMounted } from 'vue';
import AddNewItemForm from '../../Components/AddNewItemForm.vue'
const props = defineProps({list: Array, id: Number});


</script>
<style lang="">

</style>
