<script setup>
import { ref } from 'vue'
import { Head, Link, router } from '@inertiajs/vue3'
import ApplicationMark from '@/Components/ApplicationMark.vue'
import Banner from '@/Components/Banner.vue'
import Dropdown from '@/Components/Dropdown.vue'
import DropdownLink from '@/Components/DropdownLink.vue'
import NavLink from '@/Components/NavLink.vue'
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue'

import Compose from '../Pages/Shared/Compose.vue'
import NotificationBadge from '@/Pages/Shared/NotificationBadge.vue'

defineProps({
  title: String
})

const showingNavigationDropdown = ref(false)

const logout = () => {
  router.post(route('logout'))
}
</script>

<template>
  <div>
    <Head :title="title" />

    <Banner />

    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
      <nav class="bg-white border-b border-gray-100 dark:bg-gray-900 fixed top-0 w-full z-10">
        <!-- Primary Navigation Menu -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div class="flex justify-between h-16">
            <div class="flex">
              <!-- Logo -->
              <div class="shrink-0 flex items-center">
                <Link :href="route('index')">
                  <ApplicationMark class="block h-9 w-auto" />
                </Link>
              </div>

              <!-- Navigation Links -->
              <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                <NavLink :href="route('index')" :active="route().current('index')">
                  Recent
                </NavLink>
                <NavLink :href="route('trending')" :active="route().current('trending')">
                  Trending
                </NavLink>
                <NavLink :href="route('community')" :active="route().current('community')">
                  Community
                </NavLink>
                <NavLink :href="route('meme.index')" :active="route().current('meme.index')">
                  Create MEME
                </NavLink>
                <NavLink :href="route('ask.index')" :active="route().current('ask.index')">
                  ASK
                </NavLink>
              </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
              <Compose v-if="$page.props.auth.user !== null" />
              <!-- Settings Dropdown -->
              <div class="ms-3 relative" v-if="$page.props.auth.user !== null">
                <Dropdown align="right" width="48">
                  <template #trigger>
                    <button
                      v-if="$page.props.jetstream.managesProfilePhotos"
                      class="flex text-sm border-2 border-transparent rounded-full focus:outline-none transition"
                    >
                      <img
                        class="h-8 w-8 rounded-full object-cover"
                        :src="$page.props.auth.user.profile_photo_url"
                        :alt="$page.props.auth.user.name"
                      />
                      <NotificationBadge
                        class="ml-[-10px]"
                        :unread-notifications-count="$page.props.unreadNotificationsCount"
                      />
                    </button>

                    <span v-else class="inline-flex rounded-md">
                      <button
                        type="button"
                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150"
                      >
                        {{ $page.props.auth.user.name }}

                        <svg
                          class="ms-2 -me-0.5 h-4 w-4"
                          xmlns="http://www.w3.org/2000/svg"
                          fill="none"
                          viewBox="0 0 24 24"
                          stroke-width="1.5"
                          stroke="currentColor"
                        >
                          <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M19.5 8.25l-7.5 7.5-7.5-7.5"
                          />
                        </svg>
                      </button>
                    </span>
                  </template>

                  <template #content>
                    <!-- Account Management -->
                    <div class="block px-4 py-2 text-xs text-gray-400">Manage Account</div>

                    <DropdownLink :href="route('profile.show')"> Profile </DropdownLink>

                    <DropdownLink :href="route('notifications')"> Notifications </DropdownLink>

                    <div class="border-t border-gray-200" />

                    <!-- Authentication -->
                    <form @submit.prevent="logout">
                      <DropdownLink as="button"> Log Out </DropdownLink>
                    </form>
                  </template>
                </Dropdown>
              </div>

              <template v-else>
                <Link
                  :href="route('login')"
                  class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                  >Log in</Link
                >

                <Link
                  v-if="$page.props.canRegister"
                  :href="route('register')"
                  class="ms-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                  >Register</Link
                >
              </template>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
              <Compose v-if="$page.props.auth.user !== null" class="mr-2" />

              <button
                class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out"
                @click="showingNavigationDropdown = !showingNavigationDropdown"
              >
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                  <path
                    :class="{
                      hidden: showingNavigationDropdown,
                      'inline-flex': !showingNavigationDropdown
                    }"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M4 6h16M4 12h16M4 18h16"
                  />
                  <path
                    :class="{
                      hidden: !showingNavigationDropdown,
                      'inline-flex': showingNavigationDropdown
                    }"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M6 18L18 6M6 6l12 12"
                  />
                </svg>

                <NotificationBadge
                  class="ml-[-10px] mt-[-10px]"
                  :unread-notifications-count="$page.props.unreadNotificationsCount"
                />
              </button>
            </div>
          </div>
        </div>

        <!-- Responsive Navigation Menu -->
        <div
          :class="{
            block: showingNavigationDropdown,
            hidden: !showingNavigationDropdown
          }"
          class="sm:hidden"
        >
          <div class="pt-2 pb-3 space-y-1">
            <ResponsiveNavLink :href="route('index')" :active="route().current('index')">
              Recent
            </ResponsiveNavLink>
            <ResponsiveNavLink :href="route('trending')" :active="route().current('trending')">
              Trending
            </ResponsiveNavLink>
            <ResponsiveNavLink :href="route('community')" :active="route().current('community')">
              Community
            </ResponsiveNavLink>
            <ResponsiveNavLink :href="route('meme.index')" :active="route().current('meme')">
              Create MEME
            </ResponsiveNavLink>
            <ResponsiveNavLink :href="route('ask.index')" :active="route().current('ask')">
              ASK
            </ResponsiveNavLink>

            <div
              class="dropdown dropdown-end block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out dark:text-gray-300"
            >
              <div tabindex="0" class="h-full cursor-pointer flex items-center">Categories</div>
              <ul
                tabindex="0"
                class="menu dropdown-content w-full z-[1] p-2 shadow bg-base-100 rounded-box mt-4 dark:text-gray-300"
              >
                <li v-for="category in $page.props.categories" :key="category.id">
                  <Link
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
          </div>

          <!-- Responsive Settings Options -->
          <div class="pt-4 pb-1 border-t border-gray-200" v-if="$page.props.auth.user !== null">
            <div class="flex items-center px-4">
              <div v-if="$page.props.jetstream.managesProfilePhotos" class="shrink-0 me-3">
                <img
                  class="h-10 w-10 rounded-full object-cover"
                  :src="$page.props.auth.user.profile_photo_url"
                  :alt="$page.props.auth.user.name"
                />
              </div>

              <div>
                <div class="font-medium text-base text-gray-800">
                  {{ $page.props.auth.user.name }}
                </div>
                <div class="font-medium text-sm text-gray-500">
                  {{ $page.props.auth.user.email }}
                </div>
              </div>
            </div>

            <div class="mt-3 space-y-1">
              <ResponsiveNavLink
                :href="route('profile.show')"
                :active="route().current('profile.show')"
              >
                Profile
              </ResponsiveNavLink>
              <ResponsiveNavLink
                :href="route('notifications')"
                :active="route().current('notifications')"
              >
                Notifications
              </ResponsiveNavLink>

              <!-- Authentication -->
              <form method="POST" @submit.prevent="logout">
                <ResponsiveNavLink as="button"> Log Out </ResponsiveNavLink>
              </form>
            </div>
          </div>
          <template v-else>
            <ResponsiveNavLink
              :href="route('login')"
              class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500 me-4"
              >Log in</ResponsiveNavLink
            >

            <ResponsiveNavLink
              v-if="$page.props.canRegister"
              :href="route('register')"
              class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
              >Register</ResponsiveNavLink
            >
          </template>
        </div>
      </nav>

      <!-- Page Heading -->
      <div class="pt-16">
        <header v-if="$slots.header" class="bg-white shadow dark:bg-gray-900">
          <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <slot name="header" />
          </div>
        </header>

        <!-- Page Content -->
        <main>
          <slot />
        </main>
      </div>
    </div>
  </div>
</template>
