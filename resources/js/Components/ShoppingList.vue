<template lang="">
    <draggable
        v-if="list.length"
        v-model="draggableList"
        @start="drag = true"
        @end="handleDragEnd"
        :sort="true"
        class="grid grid-cols-1 gap-4"
        item-key="id"
        :disabled="props.readOnly"
    >
        <template #item="{ element, index }">
            <div class="flex justify-between w-3/4 m-auto border rounded-lg p-3 my-3 bg-blue-200 cursor-move">
                <div>{{ element.name }}</div>
                <div>{{ element.price }}</div>
                <div>
                    <label for="done-checkbox">Mark as Done </label>
                    <Checkbox
                        :disabled="props.readOnly"
                        id="done-checkbox"
                        class="mr-4"
                        :checked="element.checked"
                        @change="$emit('updateChecked',$event.target.checked, index)"
                    ></Checkbox>
                    <DangerButton :disabled="props.readOnly" @click="$emit('removeItem', index)"
                        >Remove</DangerButton
                    >
                </div>
            </div>
        </template>
    </draggable>
</template>
<script setup>
import { onMounted, watch, ref } from "vue";
import draggable from "vuedraggable";
import Checkbox from "./Checkbox.vue";
import DangerButton from "./DangerButton.vue";
const props = defineProps(["list", "readOnly"]);
const drag = ref(false);
const draggableList = ref(props.list);
const emit = defineEmits(["removeItem", "updateListOrder", "updateChecked"]);


function handleDragEnd() {
    drag.value = false;
    emit('updateListOrder', draggableList.value);
}



</script>
<style lang=""></style>
