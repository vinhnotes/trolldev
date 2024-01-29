<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import Container from '../../Pages/Shared/Container.vue'
import { useForm } from '@inertiajs/vue3'
import InputError from '@/Components/InputError.vue'
import InputLabel from '@/Components/InputLabel.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import ColorPicker from '../../Pages/Shared/ColorPicker.vue'
import { ref } from 'vue'

const props = defineProps({
  meme: Object
})

const memePreview = ref(null)

let form = useForm({
  id: props.meme.data.id,
  meme: props.meme.data.file,
  topLabel: null,
  bottomLabel: null,
  font: null,
  color: null
})

let submit = () => {
  form.post('/meme/store', {
    onSuccess: (response) => {
      if (response.props.jetstream.flash.file) {
        memePreview.value = response.props.jetstream.flash.file
      }
    }
  })
}
</script>

<template>
  <AppLayout title="Meme Generator">
    <Container>
      <div class="py-4 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6 text-center">
        <div class="card sm:card-side card-compact bg-gray-200 dark:bg-gray-800 rounded">
          <figure class="sm:w-[300px] w-full p-4">
            <img v-show="!memePreview" :src="meme.data.file" :alt="meme.data.filename" />
            <img v-show="memePreview" :src="memePreview" :alt="meme.data.filename" />
          </figure>
          <div class="card-body">
            <button disabled class="btn mt-8 disabled glass">
              <svg class="h-12 w-12" viewBox="0 0 32 32">
                <g fill="none" fill-rule="evenodd" id="Page-1" stroke="none" stroke-width="1">
                  <g fill="#157EFB" id="icon-15-file-ai">
                    <path
                      d="M8.00684834,10 C6.34621185,10 5,11.3422643 5,12.9987856 L5,20.0012144 C5,21.6573979 6.33599155,23 8.00684834,23 L24.9931517,23 C26.6537881,23 28,21.6577357 28,20.0012144 L28,12.9987856 C28,11.3426021 26.6640085,10 24.9931517,10 L8.00684834,10 L8.00684834,10 Z M7.99456145,11 C6.89299558,11 6,11.9001762 6,12.992017 L6,20.007983 C6,21.1081436 6.90234375,22 7.99456145,22 L25.0054385,22 C26.1070044,22 27,21.0998238 27,20.007983 L27,12.992017 C27,11.8918564 26.0976562,11 25.0054385,11 L7.99456145,11 L7.99456145,11 Z M19,14 L19,19 L18,19 L18,20 L21,20 L21,19 L20,19 L20,14 L21,14 L21,13 L18,13 L18,14 L19,14 L19,14 Z M15,17 L12,17 L12,20 L11,20 L11,16.5 L11,15 C11,13.8877296 11.897616,13 13.0048815,13 L13.9951185,13 C15.1061002,13 16,13.8954305 16,15 L16,17 L16,20 L15,20 L15,17 L15,17 L15,17 Z M12.9989566,14 C12.4472481,14 12,14.4438648 12,15 L12,16 L15,16 L15,15 C15,14.4477153 14.5573397,14 14.0010434,14 L12.9989566,14 L12.9989566,14 Z"
                      id="file-ai"
                    />
                  </g>
                </g>
              </svg>
              AI Generator (coming soon...)
            </button>
            <form @submit.prevent="submit">
              <div class="col-span-6 sm:col-span-4">
                <InputLabel for="topLabel" value="Top Label" class="text-left" />
                <textarea
                  id="topLabel"
                  v-model="form.topLabel"
                  type="text"
                  class="mt-1 block w-full textarea textarea-primary bg-white text-gray-900 dark:bg-gray-900 dark:text-white border-gray-300 dark:border-gray-700"
                  autocomplete="text"
                />
                <InputError :message="form.errors.topLabel" class="mt-2" />
              </div>

              <div class="col-span-6 sm:col-span-4 mt-2">
                <InputLabel for="bottomLabel" value="Bottom Label" class="text-left" />
                <textarea
                  id="bottomLabel"
                  v-model="form.bottomLabel"
                  type="text"
                  class="mt-1 block w-full textarea textarea-primary bg-white text-gray-900 dark:bg-gray-900 dark:text-white border-gray-300 dark:border-gray-700"
                  autocomplete="text"
                />
                <InputError :message="form.errors.bottomLabel" class="mt-2" />
              </div>

              <!-- <div class="col-span-6 sm:col-span-4 mt-2">
                                <InputLabel
                                    for="font"
                                    value="Font"
                                    class="text-left"
                                />
                                <TextInput
                                    id="font"
                                    v-model="form.font"
                                    type="text"
                                    class="mt-1 block w-full"
                                    autocomplete="text"
                                />
                                <InputError
                                    :message="form.errors.font"
                                    class="mt-2"
                                />
                            </div> -->

              <div class="col-span-6 sm:col-span-4 mt-2">
                <InputLabel for="color" value="Text Color" class="text-left" />
                <ColorPicker v-model="form.color" />
                <InputError :message="form.errors.color" class="mt-2" />
              </div>

              <PrimaryButton
                class="mt-8 w-full h-12 text-center"
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
              >
                Generate
              </PrimaryButton>
            </form>
          </div>
        </div>
      </div>
    </Container>
  </AppLayout>
</template>
