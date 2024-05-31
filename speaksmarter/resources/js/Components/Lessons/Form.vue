<script>
export default {
  name: 'LessonsForm'
}
</script>

<script setup>
import FormSection from '@/Components/FormSection.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import CollectionSelector from '../Common/CollectionSelector.vue';
import { ref } from 'vue';

defineProps({
  form:{
    type: Object,
    required: true
  },
  updating: {
    type: Boolean,
    required: false,
    default: false
  },
  categories: {
    type: Object,
    required: true
  },  
  levels: {
    type: Object,
    required: true
  }, 
})

const categoriesSelected = ref([]);

const onCategories = (_categories) => {
  categoriesSelected.value = _categories
}

defineEmits(['submit'])
</script>

<template>
  <FormSection @submitted="$emit('submit')">
    <template #title>
      {{ updating ? 'Update Lesson' : 'Create New Lesson' }}
    </template>

    <template #description>
      {{ updating ? 'Update The Selected Lesson' : 'Create a New Lesson From Scratch' }}
    </template>

    <template #form>
      <div class="col-span-6 sm:col-span-6">
        <InputLabel for="name" value="Name" />
        <TextInput id="name" v-model="form.name" type="text" autocomplete="name" class="mt-1 block w-full" />
        <InputError :message="$page.props.errors.name" class="mt-2" />
        
        <br />

        <InputLabel for="description" value="Description" />
        <TextInput id="description" v-model="form.description" type="text" autocomplete="description" class="mt-1 block w-full" />
        <InputError :message="$page.props.errors.description" class="mt-2" />

        <br />

        <InputLabel for="content_uri" value="Content URI" />
        <TextInput id="content_uri" v-model="form.content_uri" type="text" autocomplete="content_uri" class="mt-1 block w-full" />
        <InputError :message="$page.props.errors.content_uri" class="mt-2" />

        <br />

        <InputLabel for="pdf_uri" value="PDF" />
        <SecondaryButton class="mt-2 mr-2" type="button">Upload PDF</SecondaryButton>
        <!-- <TextInput id="pdf_uri" v-model="form.pdf_uri" type="text" autocomplete="pdf_uri" class="mt-1 block w-full" /> -->
        <InputError :message="$page.props.errors.pdf_uri" class="mt-2" />

        <br />
        <br />
        
        <div class="w-full">
          <div class="flex">
            <div class="w-1/2">
              <InputLabel for="level" value="Level" />
              <select name="level_id" id="level_id" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                <option v-for="level in levels" :value="level.id">{{ level.name }}
      
                </option>
              </select>
              <InputError :message="$page.props.errors.level_id" class="mt-2" />
              <!-- <InputLabel for="level_id" value="Level id" />
              <TextInput id="level_id" v-model="form.level_id" type="text" autocomplete="level_id" class="mt-1 block w-full" />
              <InputError :message="$page.props.errors.level_id" class="mt-2" /> -->
            </div>
            <div class="w-1/2">
              <InputLabel for="categories" value="Categories" />
              <CollectionSelector :collection="categories" @onCategories="onCategories"></CollectionSelector>
            </div>
          </div>
        </div>
      </div>
    </template>

    <template #actions>
      <PrimaryButton>
        {{ updating ? 'Update' : 'Crate' }}
      </PrimaryButton>
    </template>
  </FormSection>
</template>