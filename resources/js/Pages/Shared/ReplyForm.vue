<template>
  <div>
    <div class="mx-auto px-4">
      <form @submit.prevent="submit">
        <h3 class="font-bold text-lg dark:text-white">
          Write a reply ({{ $page.props.auth.user.username }})
        </h3>
        <div class="form-control pt-2">
          <textarea
            v-model="form.reply"
            id="reply"
            name="reply"
            class="textarea textarea-primary bg-white text-gray-900 dark:bg-gray-800 dark:text-white border-gray-300"
            placeholder="Write a reply (max 500 characters)"
          ></textarea>
          <p class="mt-2 text-sm">{{ characterCount }}/500</p>
          <div v-if="form.errors.reply" v-text="form.errors.reply" class="text-red-500 mt-1"></div>
        </div>
        <div class="flex justify-end">
          <button type="submit" :disabled="form.processing" class="btn btn-sm btn-success gap-2">
            Reply
            <svg class="h-4 w-4" viewBox="0 0 35 35" xmlns="http://www.w3.org/2000/svg">
              <path
                d="M19.564,29.894a3.21,3.21,0,0,1-1.355-.3A3.16,3.16,0,0,1,16.366,26.7l-.024-3.187c-4.27-.575-7.937.03-10.651,1.755A3.186,3.186,0,0,1,.883,21.883c1.626-7.269,6.162-11.609,12.133-11.609a14.144,14.144,0,0,1,3.35.4V8.3a3.189,3.189,0,0,1,5.242-2.441l10.934,9.2a3.187,3.187,0,0,1,0,4.879l-10.934,9.2A3.167,3.167,0,0,1,19.564,29.894ZM13.325,20.8a26.184,26.184,0,0,1,4.459.4,1.25,1.25,0,0,1,1.037,1.207l.045,4.288a.67.67,0,0,0,.4.624.663.663,0,0,0,.734-.1l10.935-9.2a.689.689,0,0,0,0-1.054h0L20,7.771a.69.69,0,0,0-1.132.528V12.37a1.249,1.249,0,0,1-1.694,1.168,11.64,11.64,0,0,0-4.156-.764c-6.8,0-9.044,6.752-9.694,9.656a.664.664,0,0,0,.28.707.65.65,0,0,0,.747.023A16.427,16.427,0,0,1,13.325,20.8Z"
              />
            </svg>
          </button>
        </div>
      </form>
    </div>
  </div>
</template>
<script setup>
import { useForm } from '@inertiajs/vue3'
import { computed } from 'vue'

let props = defineProps({
  post: Object
})

const characterCount = computed(() => {
  return form.reply.length
})

let form = useForm({
  reply: ''
})

let submit = () => {
  form.post(route('reply', { id: props.post.id }), {
    forceFormData: true,
    preserveScroll: true,
    onSuccess: () => form.reset('reply')
  })
}
</script>
