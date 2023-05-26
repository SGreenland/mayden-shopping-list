<template lang="">
    <div class="flex w-3/4 m-auto justify-between border rounded-lg p-3 my-3 bg-blue-200" v-for="item,index in list" :key="index">
        <div>{{ item.name }}</div>
        <div>
            <Checkbox class="mr-4" :checked="item.checked" v-model="item.checked"></Checkbox>
            <DangerButton @click="$emit('removeItem', index)">Remove</DangerButton>
        </div>
    </div>
</template>
<script setup>
    import Checkbox from './Checkbox.vue';
    import DangerButton from './DangerButton.vue';
    const props = defineProps(['list'])
    defineEmits(['removeItem']);




</script>
<style lang="">

</style>
