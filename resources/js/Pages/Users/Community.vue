<script setup>
import { ref, watch } from 'vue'
import throttle from 'lodash/throttle'
import AppLayout from '@/Layouts/AppLayout.vue'
import UserCard from '../Shared/UserCard.vue'
import SimplePagination from '../Shared/SimplePagination.vue'
import Container from '../../Pages/Shared/Container.vue'

import { router } from '@inertiajs/vue3'

let props = defineProps({
  users: Object,
  filters: Object,
  usercount: String
})

let search = ref(props.filters.search)

watch(
  search,
  throttle(function (value) {
    router.get(
      '/community',
      { search: value },
      {
        preserveState: true,
        replace: true
      }
    )
  }, 500)
)
</script>
<template>
  <AppLayout title="Community">
    <Container>
      <div class="px-4 pt-4 mx-auto">
        <input
          v-model="search"
          type="text"
          class="input input-bordered border-gray-300 dark:border-gray-500 input-info w-full mt-4"
          placeholder="Search.."
        />

        <div v-for="user in users.data" :key="user.id" class="card mt-5">
          <UserCard :profile="user" />
        </div>
      </div>
      <SimplePagination class="my-6" v-if="users.meta.total >= 11" :data="users.links" />
    </Container>
  </AppLayout>
</template>
