<template lang="">
    <Modal :show="displayModal">
        <div class="h-32 grid place-items-center">
            {{ modalText }}
            <SecondaryButton @click="displayModal = false"
                >Close</SecondaryButton
            >
        </div>
    </Modal>
    <div class="p-3">
        <label for="budget-options">Choose budget(£):</label>
        <select v-model="budget" name="budget" id="budget-options">
            <option value="10">10</option>
            <option value="20">20</option>
            <option value="30">30</option>
            <option value="40">40</option>
        </select>
    </div>
    <div
        class="grid mt-7 lg:grid-cols-2 w-3/4 gap-2 grid-cols-1 justify-between m-auto"
    >
        <div class="w-full">
            <div class="font-bold font-medium">Custom Item</div>
            <div class="flex justify-stretch w-full h-10">
                <TextInput
                    @keyup.enter="addCustom"
                    class="pl-2 w-4/5"
                    v-model="customItem"
                ></TextInput>
                <PrimaryButton @click="addCustom" class="w-1/5 justify-center"
                    >Add</PrimaryButton
                >
            </div>
        </div>
        <div class="w-full">
            <div class="font-bold font-medium">Add from List</div>
            <div class="flex justify-stretch w-full h-10">
                <select
                    class="w-4/5"
                    v-model="selected"
                    @change="handleChange($event)"
                >
                    <option v-for="option in options" :value="option.name">
                        {{ option.name }}
                    </option>
                </select>
                <PrimaryButton @click="addOption" class="w-1/5 justify-center"
                    >Add</PrimaryButton
                >
            </div>
        </div>
        <SecondaryButton
            v-if="
                (list.length && $page.props.auth.user) ||
                (props.savedList && $page.props.auth.user)
            "
            @click="saveList"
            class="absolute right-0 top-16 mt-2 mr-3 h-10"
            >Save</SecondaryButton
        >
    </div>
    <!--needed conditional rendering to wait for local storage to set list-->
    <shopping-list
        v-if="list.length || props.savedList"
        @updateChecked="updateChecked"
        @updateListOrder="updateListOrder"
        @removeItem="removeItem"
        :list="props.savedList ? props.savedList : list"
    ></shopping-list>
</template>
<script setup>
import ShoppingList from "./ShoppingList.vue";
import Modal from "./Modal.vue";
import { ref, onMounted, onUpdated, watch } from "vue";
import PrimaryButton from "./PrimaryButton.vue";
import SecondaryButton from "./SecondaryButton.vue";
import TextInput from "./TextInput.vue";
const customItem = ref("");
const options = ref([
    { name: "Bread", price: 1.2 },
    { name: "Cheese", price: 2.0 },
    { name: "Milk", price: 0.8 },
    { name: "Eggs", price: 2.5 },
    { name: "Crisps", price: 2.2 },
    { name: "Chocolate", price: 1.7 },
]);
const selected = ref(null);
const list = ref([]);
const displayModal = ref(false);
const modalText = ref("");
const budget = ref(null);
const totalCost = ref(null);

const props = defineProps(["savedList", "id"]);

onMounted(() => {
    // console.log(props.savedList);
    if (!props.savedList) {
        // if existing list stored & not editing saved list then set list value
        if (
            localStorage.getItem("currentList") &&
            JSON.parse(localStorage.getItem("currentList")).length
        ) {
            list.value = JSON.parse(localStorage.getItem("currentList"));
        }
    }
    else list.value = props.savedList;
});


watch(
    list,
    () => {
        //update local storage when list updated(if not editing saved list)
        if(!props.id){
            localStorage.setItem("currentList", JSON.stringify(list.value));
        }
        //calculate total cost
        if (list.value.length) {
            totalCost.value = list.value
                .map((i) => i.price)
                .reduce((total, curr) => {
                    if(curr == "n/a") return total;
                    else return total + curr;
                });
        }
        //if budget set and totalcost exceeds it then alert user
        if (budget.value && totalCost.value > budget.value) {
            modalText.value = "You have exceeded your budget!";
            displayModal.value = true;
        }
    },
    { deep: true }
);

function addCustom() {
    list.value.push({
        name: customItem.value,
        price: "n/a",
        checked: false,
        id: list.value.length,
    });
    customItem.value = "";
}

function addOption() {
    list.value.push({
        name: selected.value,
        price: options.value
            .filter((o) => o.name == selected.value)
            .map((x) => x.price)
            .pop(),
        checked: false,
        id: list.value.length,
    });
}

function removeItem(index) {
    list.value.splice(index, 1);
}

function handleChange(e) {
    selected.value = e.target.value;
}

function saveList() {
    if(props.id) updateSavedList()
      else {
        axios
            .post("/shopping-list", { list: list.value })
            .then((response) => {
                if (response.status == 200) {
                    modalText.value = "List Saved!"
                    displayModal.value = true;
                }
            })
            .catch((error) => {
                alert("Error: " + error.response.data.message);
            });
      }
}

function updateSavedList() {
    axios.put(`/shopping-list/${props.id}`, {list: list.value}).then((response) => {
                if (response.status == 200) {
                    modalText.value = "List Updated!"
                    displayModal.value = true;
                }
            })
            .catch((error) => {
                alert("Error: " + error.response.data.message);
            });
}

function updateListOrder(updatedList) {
    list.value = updatedList;
}

function updateChecked(checked, index) {
    list.value[index].checked = checked;
}
</script>
<style lang=""></style>
