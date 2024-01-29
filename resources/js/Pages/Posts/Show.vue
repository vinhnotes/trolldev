<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import Vote from '../Shared/Vote.vue'
import ReplyForm from '../Shared/ReplyForm.vue'
import ReplyCard from '../Shared/ReplyCard.vue'
import Container from '../../Pages/Shared/Container.vue'
import Tag from '../../Pages/Shared/Tag.vue'

defineProps({
  post: Object
})
</script>
<template>
  <AppLayout title="Post">
    <Container>
      <article class="my-6 px-4">
        <div class="card compact w-full rounded bg-gray-200 dark:bg-gray-800">
          <figure v-if="post.data.file !== null">
            <img :src="post.data.file" class="object-cover w-full" alt="" />
          </figure>
          <div v-if="post.data.video !== null">
            <vue-plyr :options="options">
              <video controls crossorigin playsinline>
                <source size="720" :src="post.data.video" type="video/mp4" />
              </video>
            </vue-plyr>
          </div>
          <div class="flex justify-between">
            <div class="flex mt-4 ml-4">
              Posted in
              <div class="badge badge-outline ml-1 mt-1">
                {{ post.data.category }}
              </div>
            </div>
            <div class="flex mt-4 mr-4">
              <div class="badge badge-outline">
                {{ post.data.time }}
              </div>
            </div>
          </div>
          <div class="card-body">
            <p>{{ post.data.description }}</p>
            <Tag :post="post.data" />

            <div class="card-actions justify-between mt-2">
              <Vote :post="post.data" />
              <div>
                <button class="btn btn-sm btn-primary">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="20"
                    height="20"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                  >
                    <path
                      d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"
                    ></path>
                  </svg>
                </button>
              </div>
            </div>
          </div>
        </div>
      </article>

      <section v-if="$page.props.auth.user !== null">
        <ReplyForm :post="post.data" />
      </section>

      <section>
        <div v-if="post.data.replies !== null" class="px-4 mx-auto max-w-screen-xl py-16 lg:px-6">
          <ReplyCard :post="post.data" />
        </div>
      </section>
    </Container>
  </AppLayout>
</template>
