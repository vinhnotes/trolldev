<template>
  <div>
    <div class="card card-compact bg-gray-200 dark:bg-gray-800 rounded">
      <div class="card-body">
        <div class="flex justify-between text-left">
          <h2 class="card-title">
            <InertiaLink
              :href="
                route('user-profile', {
                  id: profile.data.username
                })
              "
            >
              <div class="avatar">
                <div class="w-10 mask mask-hexagon">
                  <img class="w-10" :src="profile.data.avatar" />
                </div>
              </div>
            </InertiaLink>
            <div class="ml-2 mb-2">
              <InertiaLink
                :href="
                  route('user-profile', {
                    id: profile.data.username
                  })
                "
              >
                {{ profile.name }}
                <div class="text-sm">@{{ profile.data.username }}</div>
              </InertiaLink>
            </div>
          </h2>
          <InertiaLink
            v-if="
              $page.props.auth.user !== null &&
              profile.data.is.following === false &&
              profile.data.is.self === false
            "
            preserveScroll
            method="post"
            as="button"
            type="button"
            class="btn btn-primary gap-2"
            :href="route('follow', { id: profile.data.username })"
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              width="24"
              height="24"
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              stroke-width="1.5"
              stroke-linecap="round"
              stroke-linejoin="round"
            >
              <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
              <circle cx="8.5" cy="7" r="4"></circle>
              <line x1="20" y1="8" x2="20" y2="14"></line>
              <line x1="23" y1="11" x2="17" y2="11"></line>
            </svg>
          </InertiaLink>
          <InertiaLink
            v-if="
              $page.props.auth.user !== null &&
              profile.data.is.following === true &&
              profile.data.is.self === false
            "
            preserveScroll
            method="post"
            as="button"
            type="button"
            class="btn btn-secondary gap-2"
            :href="route('follow', { id: profile.data.username })"
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              width="24"
              height="24"
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              stroke-width="1.5"
              stroke-linecap="round"
              stroke-linejoin="round"
            >
              <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
              <circle cx="8.5" cy="7" r="4"></circle>
              <line x1="23" y1="11" x2="17" y2="11"></line>
            </svg>
          </InertiaLink>
        </div>
        <p class="my-2 ml-2 text-left" v-if="profile.data.about === null">No bio yet!</p>
        <p class="my-2 ml-2 text-left">{{ profile.data.about }}</p>
        <div class="flex my-4">
          <div class="flex justify-start">
            <div class="hidden sm:flex">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="mr-2 mt-1"
                width="14"
                height="14"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              >
                <circle cx="12" cy="12" r="10"></circle>
                <polyline points="12 6 12 12 16 14"></polyline>
              </svg>
              {{ profile.data.time }}
            </div>
            <svg
              xmlns="http://www.w3.org/2000/svg"
              width="14"
              height="14"
              viewBox="0 0 24 24"
              class="ml-3 mr-1 mt-1"
              fill="none"
              stroke="currentColor"
              stroke-width="1.5"
              stroke-linecap="round"
              stroke-linejoin="round"
            >
              <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path>
              <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path>
            </svg>
            <p v-if="profile.data.website === null">No website</p>
            <a v-else :href="profile.data.link" class="break-all" target="_blank">{{
              profile.data.website
            }}</a>
          </div>
        </div>

        <div class="card-actions flex ml-2">
          <InertiaLink
            preserve-scroll
            class="btn-link font-bold"
            :href="route('user-profile', { id: profile.data.username })"
          >
            {{ profile.data.postcount }}
            <span class="font-normal">Posts</span>
          </InertiaLink>
          <InertiaLink
            preserve-scroll
            class="btn-link font-bold"
            :href="route('user-profile', { id: profile.data.username })"
          >
            {{ profile.data.replycount }}
            <span class="font-normal">Replies</span>
          </InertiaLink>
          <InertiaLink
            preserve-scroll
            class="btn-link font-bold"
            :href="route('user-profile', { id: profile.data.username })"
          >
            {{ profile.data.votecount }}
            <span class="font-normal">Votes</span>
          </InertiaLink>
          <InertiaLink
            preserve-scroll
            class="btn-link font-bold"
            :href="
              route('user-profile-follows', {
                id: profile.data.username
              })
            "
          >
            {{ profile.data.followings }}
            <span class="font-normal">Follows</span>
          </InertiaLink>
          <InertiaLink
            preserve-scroll
            class="btn-link font-bold"
            :href="
              route('user-profile-followers', {
                id: profile.data.username
              })
            "
          >
            {{ profile.data.followers }}
            <span class="font-normal">Followers</span>
          </InertiaLink>
        </div>
      </div>
    </div>
  </div>
</template>
<script setup>
defineProps({
  profile: Object
})
</script>
