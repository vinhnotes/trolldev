<template>
  <span
    v-if="unreadNotificationsCount > 0"
    class="bg-red-300 rounded-full h-4 min-w-4 text-xs text-center dark:bg-red-800 dark:text-white"
    >{{ unreadNotificationsCount > 10 ? '10+' : unreadNotificationsCount }}</span
  >
</template>
<script setup>
defineProps({
  unreadNotificationsCount: Number
})
</script>
