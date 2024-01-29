<script setup>
import throttle from 'lodash/throttle'
import AppLayout from '@/Layouts/AppLayout.vue'
import { ref, watch } from 'vue'

import SimplePagination from '../Shared/SimplePagination.vue'
import Card from '../Shared/Card.vue'
import Empty from '../Shared/Empty.vue'
import Container from '../../Pages/Shared/Container.vue'

import { router } from '@inertiajs/vue3'

let props = defineProps({
  posts: Object,
  filters: Object
})

let search = ref(props.filters.search)

watch(
  search,
  throttle(function (value) {
    router.get(
      '/',
      { search: value },
      {
        preserveState: true,
        replace: true,
        preserveScroll: true
      }
    )
  }, 1000)
)
</script>

<template>
  <AppLayout title="Home">
    <Container>
      <Empty v-if="posts.meta.total === 0" />

      <Card :posts="posts" />

      <SimplePagination class="pt-4" v-if="posts.meta.total >= 5" :data="posts.links" />
    </Container>
  </AppLayout>
</template>
