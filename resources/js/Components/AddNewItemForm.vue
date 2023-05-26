<template lang="">
    <div class="grid mt-7 lg:grid-cols-2 w-3/4 gap-2 grid-cols-1 justify-between m-auto">
        <div class="w-full">
            <div class="font-bold font-medium">Custom Item</div>
            <div class="flex justify-stretch w-full h-10">
                <TextInput @keyup.enter="addCustom"  class="w-4/5" v-model="customItem"></TextInput>
                <PrimaryButton @click="addCustom" class="w-1/5 justify-center">Add</PrimaryButton>
            </div>
        </div>
        <div class="w-full">
            <div class="font-bold font-medium">Add from List</div>
            <div class="flex justify-stretch w-full h-10">
                <select class="w-4/5" v-model="selected" @change="handleChange($event)">
                    <option v-for="option in options" :value="option">{{ option }}</option>
                </select>
                <PrimaryButton @click="addOption" class="w-1/5 justify-center">Add</PrimaryButton>
            </div>
        </div>
        <SecondaryButton v-if="list.length" @click="saveList" class="absolute right-0 top-16 mt-2 mr-3 h-10">Save</SecondaryButton>
    </div>
    <shopping-list @removeItem="removeItem" :list="list"></shopping-list>
</template>
<script setup>
import ShoppingList from "./ShoppingList.vue"
import { ref, onMounted, onUnmounted } from "vue"
import PrimaryButton from "./PrimaryButton.vue";
import SecondaryButton from "./SecondaryButton.vue";
import TextInput from "./TextInput.vue";
    const customItem = ref('');
    const options = ref(['Bread', 'Cheese', 'Milk', 'Eggs', 'Crisps', 'Chocolate']);
    const selected = ref(null);
    const list = ref([]);

    onMounted(() => {
        //if existing list stored then set list value
       if(JSON.parse(localStorage.getItem('currentList')).length){
        list.value = JSON.parse(localStorage.getItem('currentList'))
       }
    })

    onUnmounted(() => {
        //persist state to localStorage
        localStorage.setItem('currentList', JSON.stringify(list.value));
    })

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

    function saveList() {
        axios.post('/shopping-list', {list: list.value}).then((response) => {
            console.log(response.data)
        }).catch(error => {
            alert('Error: ' + error.response.data);
        })
    }
</script>
<style lang="">

</style>
