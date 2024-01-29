<template>
  <AppLayout title="Meme Templates">
    <Container>
      <div class="py-4 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6 text-center">
        <div class="w-full lg:columns-3 sm:columns-2 columns-1 gap-4">
          <div v-for="meme in memes.data" :key="meme.id" class="inline-block w-full group mb-4">
            <Link
              :href="
                route('meme.create', {
                  meme: meme.slug
                })
              "
            >
              <div class="card card-compact bg-gray-200 dark:bg-gray-800">
                <figure>
                  <img
                    :src="meme.file"
                    class="object-cover hover:opacity-75"
                    :alt="meme.filename"
                  />
                </figure>
                <div class="card-body">
                  <h2 class="card-title">{{ meme.name }}</h2>
                  <p class="text-left">
                    {{ meme.description }}
                  </p>
                  <p class="text-left font-medium">Used {{ meme.count }} times.</p>
                </div>
              </div>
            </Link>
          </div>
        </div>
      </div>
    </Container>
  </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import Container from '../../Pages/Shared/Container.vue'

import { Link } from '@inertiajs/vue3'

defineProps({
  memes: Object
})
</script>
