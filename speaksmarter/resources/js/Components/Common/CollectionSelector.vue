<script setup>
import { ref } from 'vue';
defineProps({
  collection: {
    type: Array,
    required: true
  }
})
import Swal from 'sweetalert2'

const currentSelection = ref(1);
const selection = ref([]);
const emit = defineEmits(['onCategories']);

const handleAddToSelection = () => {
  let alreadyExists = false
  selection.value.forEach( item => {
    if(item.id == currentSelection.value.id){
      alreadyExists = true
      return 
    }
  })
  if(alreadyExists){
    Swal.fire("Category already selected");
    return
  }
  selection.value.push(currentSelection.value)
  emit('onCategories', selection.value)
}

const handleRemoveSelection = (index) => {
  selection.value = selection.value.filter(item => item.id !== index) 
  emit('onCategories', selection.value)
}

</script>

<template>
  <div>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <select v-model="currentSelection" class="mr-2 w-3/4 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
      <option v-for="(item, index) in collection" :key="index" :value="item">{{ item?.name }}</option>
    </select>
    <button @click="handleAddToSelection" class="text-white bg-indigo-500 hover:bg-indigo-700 py-2 px-4 rounded">
      <i class="fas fa-plus"></i> Add
    </button>
    <div>
      <ul>
          <li v-for="(item) in selection" class="text-white bg-indigo-500 hover:bg-indigo-700 py-2 px-4 rounded mt-1 mb-1">{{ item.name }} <span @click="handleRemoveSelection(item.id)" class="float-right"><i class="fas fa-times"></i></span></li>
      </ul> 
    </div>
  </div>
</template>