<script setup>
import { onMounted } from 'vue';

import NavLink from '@/Components/NavLink.vue';

onMounted(() => {
  window.HSStaticMethods.autoInit();
});


</script>

<template>
  <!-- Sidebar -->
  <div id="application-sidebar" class="hs-overlay [--auto-close:lg]
 hs-overlay-open:translate-x-0
 -translate-x-full transition-all duration-300 transform
 w-[260px]
 hidden
 fixed inset-y-0 start-0 z-[60]
 bg-white border-e border-gray-200
 lg:block lg:translate-x-0 lg:end-auto lg:bottom-0
 dark:bg-neutral-800 dark:border-neutral-700
">
    <div class="px-8 pt-4">
      <!-- Logo -->
      <a class="flex-none rounded-xl text-xl inline-block font-semibold focus:outline-none focus:opacity-80"
        :href="route('dashboard')" aria-label="Preline">
        <div class="flex items-center">
          <img src="/logo.png" class="w-12 mr-2" alt="Logo">
          <span class="text-sm text-custom-blue hover:text-custom-blue-dark mt-2">TechLibrary</span>
      </div>
      </a>
      <!-- End Logo -->
    </div>

    <nav class="hs-accordion-group p-6 w-full flex flex-col flex-wrap" data-hs-accordion-always-open>
      <ul class="space-y-1.5">
        <li>
          <NavLink :href="route('admin.dashboard')" :active="route().current('admin.dashboard')">
            <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
              viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
              stroke-linejoin="round">
              <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
              <polyline points="9 22 9 12 15 12 15 22" />
            </svg>
            Dashboard
          </NavLink>
        </li>

        <li>
          <NavLink :href="route('genres.index')" :active="route().current('genres.index')">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
              class="lucide lucide-album flex-shrink-0 size-4">
              <rect width="18" height="18" x="3" y="3" rx="2" ry="2" />
              <polyline points="11 3 11 11 14 8 17 11 17 3" />
            </svg>
            Genre Management
          </NavLink>
        </li>

        <li>
          <NavLink :href="route('authors.index')" :active="route().current('authors.index')">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
              class="lucide lucide-square-user flex-shrink-0 size-4">
              <rect width="18" height="18" x="3" y="3" rx="2" />
              <circle cx="12" cy="10" r="3" />
              <path d="M7 21v-2a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v2" />
            </svg>
            Author Management
          </NavLink>
        </li>

        <li>
          <NavLink :href="route('books.index')" :active="route().current('books.index')">
            <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
              viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
              stroke-linejoin="round">
              <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z" />
              <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z" />
            </svg>
            Book Management
          </NavLink>
        </li>
        <li>
          <NavLink :href="route('borrows.index')" :active="route().current('borrows.index')">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
              class="lucide lucide-corner-left-up flex-shrink-0 size-4">
              <polyline points="14 9 9 4 4 9" />
              <path d="M20 20h-7a4 4 0 0 1-4-4V4" />
            </svg>
            Borrow Management
          </NavLink>
        </li>
        <li>
          <NavLink :href="route('printing.index')" :active="route().current('printing.index')">

            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
              class=" flex-shrink-0 size-4lucide lucide-printer">
              <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2" />
              <path d="M6 9V3a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v6" />
              <rect x="6" y="14" width="12" height="8" rx="1" />
            </svg>
            Printing Management
          </NavLink>
        </li>
        <li>
          <NavLink :href="route('users.index')" :active="route().current('users.index')">

            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
              class=" flex-shrink-0 size-4lucide lucide-printer">
              <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2" />
              <path d="M6 9V3a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v6" />
              <rect x="6" y="14" width="12" height="8" rx="1" />
            </svg>
            Student Management
          </NavLink>
        </li>
      </ul>
    </nav>
  </div>
  <!-- End Sidebar -->
</template>