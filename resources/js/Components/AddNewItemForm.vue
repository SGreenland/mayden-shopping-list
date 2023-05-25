<template lang="">
    <div class="flex w-3/4 m-auto justify-center">
        <div class="w-1/2">
            <div class="font-bold font-medium">Custom Item</div>
            <div class="flex justify-stretch w-full">
                <TextInput class="w-3/4" v-model="customItem"></TextInput>
                <PrimaryButton @click="addCustom" class="w/1/4">Add</PrimaryButton>
            </div>
        </div>
        <div class="w-1/2">
            <div class="font-bold font-medium">Add from List</div>
            <div class="flex justify-stretch w-full">
                <select class="w-3/4" v-model="selected" @change="handleChange($event)">
                    <option v-for="option in options" :value="option">{{ option }}</option>
                </select>
                <PrimaryButton @click="addOption" class="w/1/4">Add</PrimaryButton>
            </div>
        </div>
    </div>
    <shopping-list @removeItem="removeItem" :list="list"></shopping-list>
</template>
<script setup>
import ShoppingList from "./ShoppingList.vue"
import { ref } from "vue"
import PrimaryButton from "./PrimaryButton.vue";
import TextInput from "./TextInput.vue"
    const customItem = ref('');
    const options = ref(['Bread', 'Cheese', 'Milk', 'Crisps', 'Chocolate'])
    const selected = ref(null);
    const list = ref([]);

    function addCustom() {
        list.value.push({name: customItem.value, checked: false});
    }

    function addOption() {
        list.value.push({name: selected.value, checked: false});
    }

    function removeItem(index) {
        list.value.splice(index, 1);
    }

    function handleChange(e) {
        selected.value = e.target.value;
    }


</script>
<style lang="">

</style>
