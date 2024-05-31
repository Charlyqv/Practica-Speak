<script>
export default {
  name: 'CategoriesIndex'
}
</script>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';
import { Inertia } from '@inertiajs/inertia';
import Swal from 'sweetalert2'

defineProps({
  categories: {
    type: Object,
    required: true 
  }
})

const deleteCategory = id => {

  Swal.fire({
    title: "Are you sure?",
    text: "This action cannot be reversed",
    icon: "question",
    showDenyButton: true,    
    confirmButtonText: 'Yes',
    denyButtonText: 'No',
  }).then((result) => {
  if (result.isConfirmed) {
    Swal.fire('Category deleted!', '', 'success')
    Inertia.delete(route('categories.destroy', id))
  } else if (result.isDenied) {
    Swal.fire('Changes are not saved', '', 'info')
  }
});
}
</script>

<template>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
  <AppLayout>
    <template #header>
      <h1 class="font-semibold text-xl text-gray-800 leading-tight">Categories</h1>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="p-6 bg-white border-b border-gray-200" v-if="$page.props.user.permissions.includes('create categories')">
          <div class="flex justify-between">
            <Link :href="route('categories.create')" class="text-white bg-indigo-500 hover:bg-indigo-700 py-2 px-4 rounded">
              CREATE CATEGORY
            </Link>
          </div>

          <div class="mt-4">
            <ul role="list" class="divide-y divide-gray-100">
              <li class="flex justify-between gap-x-6 py-5" v-for="category in categories.data">
                <div class="flex min-w-0 gap-x-4">
                  <div class="min-w-0 flex-auto">
                    <p class="text-md font-semibold leading-6 text-gray-900">{{ category.name }}</p>
                  </div>
                </div>
                <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
                  <p class="text-sm leading-6 text-gray-900">
                    <Link :href="route('categories.edit', category.id)" v-if="$page.props.user.permissions.includes('update categories')" class="bg-green-500 text-white py-2 px-4 rounded m-2">
                      <i class="fas fa-edit"></i> Edit
                    </Link>
                    <Link @click="deleteCategory(category.id)" v-if="$page.props.user.permissions.includes('delete categories')" class="bg-red-500 text-white py-2 px-4 rounded">
                      <i class="fas fa-trash"></i> Delete
                    </Link>
                  </p>
                </div>
              </li>
            </ul>
          </div>
          <div class="flex items-center justify-center text-center mt-2">
            <Link v-if="categories.current_page > 1" :href="categories.prev_page_url" class="py-2 px-4 rounded m-2 border border-black">
              PREV
            </Link>
            <Link v-if="categories.current_page < categories.last_page" :href="categories.next_page_url" class="py-2 px-4 rounded m-2 border border-black">
              NEXT
            </Link>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>