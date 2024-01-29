<template>
  <div class="flex flex-wrap gap-2">
    <div
      class="bg-gray-300 px-2 rounded-md dark:bg-gray-600"
      v-for="tag in post.tags"
      :key="tag.id"
    >
      <InertiaLink :href="route('tag', { slug: tag.slug })">
        {{ tag.name }}
      </InertiaLink>
    </div>
  </div>
</template>
<script setup>
defineProps({
  post: Object
})
</script>
