<template>
  <div>
    <button class="btn btn-sm btn-primary" @click="openModal">
      <svg
        class="feather feather-edit p-1"
        fill="none"
        height="24"
        stroke="currentColor"
        stroke-linecap="round"
        stroke-linejoin="round"
        stroke-width="2"
        viewBox="0 0 24 24"
        width="24"
        xmlns="http://www.w3.org/2000/svg"
      >
        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
      </svg>
      Post
    </button>

    <TransitionRoot appear :show="isOpen" as="template">
      <Dialog as="div" @close="closeModal" class="relative z-10">
        <TransitionChild
          as="template"
          enter="duration-300 ease-out"
          enter-from="opacity-0"
          enter-to="opacity-100"
          leave="duration-200 ease-in"
          leave-from="opacity-100"
          leave-to="opacity-0"
        >
          <div class="fixed inset-0 bg-black bg-opacity-25" />
        </TransitionChild>

        <div class="fixed inset-0 overflow-y-auto">
          <div class="flex min-h-full items-center justify-center p-4 text-center">
            <TransitionChild
              as="template"
              enter="duration-300 ease-out"
              enter-from="opacity-0 scale-95"
              enter-to="opacity-100 scale-100"
              leave="duration-200 ease-in"
              leave-from="opacity-100 scale-100"
              leave-to="opacity-0 scale-95"
            >
              <DialogPanel
                class="w-full max-w-md transform rounded-2xl bg-white dark:bg-gray-800 p-6 text-left align-middle shadow-xl transition-all"
              >
                <DialogTitle
                  as="h3"
                  class="text-lg font-medium leading-6 text-gray-900 dark:text-white pb-2"
                >
                  Upload a short
                </DialogTitle>
                <form @submit.prevent="submit">
                  <div class="flex justify-between">
                    <div>
                      <label
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                        for="image"
                        >Image</label
                      >
                      <input
                        class="block mb-5 w-full text-xs text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                        id="image"
                        @input="form.file = $event.target.files[0]"
                        type="file"
                      />
                    </div>
                    <div>
                      <label
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                        for="video"
                        >Video</label
                      >
                      <input
                        class="block mb-5 w-full text-xs text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                        id="video"
                        @input="form.video = $event.target.files[0]"
                        type="file"
                      />
                    </div>
                  </div>

                  <div class="form-control py-2">
                    <textarea
                      v-model="form.description"
                      id="description"
                      name="description"
                      class="textarea textarea-primary bg-white text-gray-900 dark:bg-gray-900 dark:text-white border-gray-300 dark:border-gray-700"
                      placeholder="Write a description (max 500 characters)"
                    ></textarea>
                    <p class="mt-2 text-sm text-gray-900 dark:text-white">
                      {{ characterCount }}/500
                    </p>
                    <div
                      v-if="form.errors.description"
                      v-text="form.errors.description"
                      class="text-red-500 mt-1"
                    ></div>
                  </div>
                  <div
                    v-if="form.errors.status"
                    v-text="form.errors.status"
                    class="text-red-500 mt-1"
                  ></div>

                  <!-- Tags -->
                  <label class="label" for="tags">
                    <span class="label-text">Tags</span>
                  </label>
                  <Multiselect
                    placeholder="Add tags"
                    autocomplete="off"
                    id="tags"
                    v-model="form.tags"
                    :options="
                      $page.props.tags.map((tag) => {
                        return {
                          value: tag.name.en,
                          label: tag.name.en
                        }
                      })
                    "
                    mode="tags"
                    :close-on-select="false"
                    :searchable="true"
                    :create-option="true"
                    class="mb-4"
                    :classes="{
                      containerActive: 'boder-gray-500',
                      tag: 'bg-emerald-600 text-white text-sm font-semibold py-0.5 pl-2 rounded mr-1 mb-1 flex items-center whitespace-nowrap min-w-0 rtl:pl-0 rtl:pr-2 rtl:mr-0 rtl:ml-1',
                      tagRemoveIcon:
                        'bg-multiselect-remove bg-center bg-no-repeat opacity-70 inline-block w-3 h-3 group-hover:opacity-60 text-white'
                    }"
                  />

                  <div class="modal-action mt-2">
                    <div class="justify-start">
                      <select
                        v-model="form.category"
                        name="category"
                        id="category"
                        class="select select-bordered w-full max-w-xs"
                      >
                        <option disabled value="">Category</option>
                        <option
                          v-for="category in $page.props.categories"
                          :key="category.id"
                          :value="category.id"
                          selected
                        >
                          {{ category.name }}
                        </option>
                      </select>
                    </div>

                    <button type="submit" :disabled="form.processing" class="btn btn-success gap-2">
                      Publish
                      <svg class="h-6 w-6" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0 0h48v48h-48z" fill="none" />
                        <path d="M10 8v4h28v-4h-28zm0 20h8v12h12v-12h8l-14-14-14 14z" />
                      </svg>
                    </button>
                  </div>
                </form>
              </DialogPanel>
            </TransitionChild>
          </div>
        </div>
      </Dialog>
    </TransitionRoot>
  </div>
</template>
<script setup>
import { ref } from 'vue'
import { useForm } from '@inertiajs/vue3'
import { computed } from 'vue'
import { TransitionRoot, TransitionChild, Dialog, DialogPanel, DialogTitle } from '@headlessui/vue'
import Multiselect from '@vueform/multiselect'

const characterCount = computed(() => {
  return form.description.length
})

let form = useForm({
  description: '',
  video: '',
  file: '',
  category: '',
  tags: []
})

let submit = () => {
  form.post('/upload', {
    forceFormData: true,
    onSuccess: () => [
      form.reset('description', 'video', 'category', 'file', 'tags'),
      (isOpen.value = false)
    ]
  })
}

const isOpen = ref(false)

function closeModal() {
  isOpen.value = false
}
function openModal() {
  isOpen.value = true
}
</script>
