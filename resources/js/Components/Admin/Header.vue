<script setup>

import { router } from '@inertiajs/vue3';
import Breadcrumb from '@/Components/Admin/Breadcrumb.vue';


const logout = () => {
  router.post(route('logout'));
};


</script>

<template>

  <header
    class="sticky top-0 inset-x-0 flex flex-wrap sm:justify-start sm:flex-nowrap z-[48] w-full bg-white border-b text-sm py-2.5 sm:py-4 lg:ps-64 dark:bg-neutral-800 dark:border-neutral-700">
    <nav class="flex basis-full items-center w-full mx-auto px-4 sm:px-6" aria-label="Global">
      <div class="me-5 lg:me-0 lg:hidden">
        <!-- Logo -->
        <a class="flex-none rounded-xl text-xl inline-block font-semibold focus:outline-none focus:opacity-80"
          :href="route('dashboard')">
          <div class="flex items-center">
            <img src="/logo.png" class="w-12 mr-2" alt="Logo">
            <span class="text-sm text-custom-blue hover:text-custom-blue-dark mt-2">TechLibrary</span>
        </div> 
        </a>
        <!-- End Logo -->
      </div>

      <div class="w-full flex items-center justify-end ms-auto sm:justify-between sm:gap-x-3 sm:order-3">
        <div class="sm:hidden">
          <button type="button"
            class="w-[2.375rem] h-[2.375rem] inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent text-gray-800 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:bg-neutral-700">
            <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
              viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
              stroke-linejoin="round">
              <circle cx="11" cy="11" r="8" />
              <path d="m21 21-4.3-4.3" />
            </svg>
          </button>
        </div>

        <div class="hidden sm:block">
          <label for="icon" class="sr-only">Search</label>
          <div class="relative min-w-72 md:min-w-80">
            <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-4">
              <svg class="flex-shrink-0 size-4 text-gray-400 dark:text-neutral-400" xmlns="http://www.w3.org/2000/svg"
                width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round">
                <circle cx="11" cy="11" r="8" />
                <path d="m21 21-4.3-4.3" />
              </svg>
            </div>
            <input type="text" id="icon" name="icon"
              class="py-2 px-4 ps-11 block w-full border-gray-200 rounded-lg text-sm focus:border-lime-500 focus:ring-lime-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
              placeholder="Search">
          </div>
        </div>

        <div class="flex flex-row items-center justify-end gap-2">

          <div class="hs-dropdown [--placement:bottom-right] relative inline-flex">
            <button id="hs-dropdown-with-header" type="button"
              class="w-[2.375rem] h-[2.375rem] inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent text-gray-800 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:bg-neutral-700">
              <img class="inline-block size-[38px] rounded-full ring-2 ring-white dark:ring-neutral-800"
                src="https://images.unsplash.com/photo-1568602471122-7832951cc4c5?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=facearea&facepad=2&w=320&h=320&q=80"
                alt="Image Description">
            </button>

            <div
              class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-60 bg-white shadow-md rounded-lg p-2 dark:bg-neutral-900 dark:border dark:border-neutral-700"
              aria-labelledby="hs-dropdown-with-header">
              <div class="py-3 px-5 -m-2 bg-gray-100 rounded-t-lg dark:bg-neutral-800">
                <p class="text-sm text-gray-500 dark:text-neutral-400">Signed in as</p>
                <p class="text-sm font-medium text-gray-800 dark:text-neutral-300"> {{ $page.props.auth.user.email }}
                </p>
              </div>
              <div class="mt-2 py-2 first:pt-0 last:pb-0">

                <form @submit.prevent="logout">
                  <button
                    class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:ring-2 focus:ring-lime-500 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300"
                    href="#">
                    <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                      viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                      stroke-linejoin="round">
                      <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                      <circle cx="9" cy="7" r="4" />
                      <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                      <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                    </svg>
                    Logout
                  </button>
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </nav>
  </header>
  <!-- ========== END HEADER ========== -->

  <Breadcrumb />

</template>