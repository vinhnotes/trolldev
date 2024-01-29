<template>
  <div class="container flex flex-row max-w-7xl justify-center mx-auto py-4 sm:px-4 lg:px-6">
    <div class="w-[350px] pt-4 md:block hidden">
      <div class="fixed overflow-y-auto max-w-[220px] h-[calc(100%-120px)] hide-scroll">
        <div>
          <ul tabindex="0" class="menu dark:text-gray-300">
            <li v-for="category in $page.props.categories" :key="category.id">
              <Link
                class="px-2"
                v-bind:class="
                  route().current('category', {
                    id: category.slug
                  })
                    ? 'active'
                    : ''
                "
                :href="
                  route('category', {
                    id: category.slug
                  })
                "
              >
                <i :class="category.icon"></i>
                {{ category.name }}
              </Link>
            </li>
          </ul>
        </div>
        <div>
          <p class="font-bold px-2 mt-4">Tags</p>
          <div class="flex flex-wrap gap-2 px-2 mt-4">
            <div
              class="bg-gray-300 px-2 rounded-md dark:bg-gray-600"
              v-for="tag in $page.props.tags"
              :key="tag.id"
            >
              <InertiaLink :href="route('tag', { slug: tag.slug.en })">
                {{ tag.name.en }} ({{ tag.count }})
              </InertiaLink>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="w-full">
      <slot />
    </div>
    <div class="w-[350px] mt-4 p-2 lg:block hidden">
      <div class="fixed overflow-y-auto max-w-[220px] h-[calc(100%-120px)] hide-scroll">
        <p>MEET US</p>
        <div class="flex flex-wrap gap-4 py-4">
          <a href="https://fb.com/trolldev" target="_blank">
            <font-awesome-icon icon="fa-brands fa-facebook" class="h-[30px] w-[30px]" />
          </a>
          <a href="https://github.com/whatsltd4us/trolldev" target="_blank">
            <font-awesome-icon icon="fa-brands fa-github" class="h-[30px] w-[30px]" />
          </a>
        </div>
        <div v-if="$page.props.quote">
          <span>{{ $page.props.quote.content }}</span>
          <span v-if="$page.props.quote.author"> - {{ $page.props.quote.author }}</span>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
</script>
