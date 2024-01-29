<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import NotificationsCard from '../Shared/NotificationsCard.vue'
import Empty from '../Shared/Empty.vue'
import SimplePagination from '../Shared/SimplePagination.vue'
import Container from '../Shared/Container.vue'

defineProps({
  notifications: Object
})
</script>
<template>
  <AppLayout title="Notifications">
    <Container>
      <div class="py-4 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6 text-center">
        <Empty v-if="notifications.total === 0" class="w-full mt-20" />

        <div class="w-full">
          <NotificationsCard
            class="mb-4"
            v-for="notification in notifications.data"
            :key="notification.id"
            :notification="notification"
          />
        </div>

        <SimplePagination v-if="notifications.next_page_url !== null" :data="notifications.data" />
      </div>
    </Container>
  </AppLayout>
</template>
