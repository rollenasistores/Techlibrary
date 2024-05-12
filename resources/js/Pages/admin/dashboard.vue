<script setup>
import { onMounted } from 'vue';
import Sidebar from '@/Components/Admin/Sidebar.vue'
import Header from '@/Components/Admin/Header.vue'
onMounted(() => {
  window.HSStaticMethods.autoInit();
});

</script>

<script>
export default {

  props: {
    users: { type: Array, },
    borrowedBooks: { type: Array, },
    books: { type: Array, },
    printings: { type: Array, }
  },
  data() {
    return {
      libraryOpen: true,
      librarianAvailable: true
    };
  },
  computed: {
    libraryStatus() {
      return this.libraryOpen ? 'Open' : 'Closed';
    },
    librarianStatus() {
      return this.librarianAvailable ? 'Available' : 'Not Available';
    },
    libraryButtonText() {
      return this.libraryOpen ? 'Close Library' : 'Open Library';
    },
    librarianButtonText() {
      return this.librarianAvailable ? 'Librarian Not Available' : 'Librarian Available';
    }
  },
  methods: {
    toggleLibraryStatus() {
      this.libraryOpen = !this.libraryOpen;
    },
    toggleLibrarianStatus() {
      this.librarianAvailable = !this.librarianAvailable;
    }
  }
}


</script>

<template>
  <Header />


  <Sidebar />

  <!-- Content -->
  <div class="w-full lg:ps-64">
    <div class="p-4 sm:p-6 space-y-4 sm:space-y-6">
      <!-- Grid -->
      <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
        <!-- Card -->
        <div class="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
          <div class="p-4 md:p-5">
            <div class="flex items-center gap-x-2">
              <p class="text-xs uppercase tracking-wide text-gray-500 dark:text-neutral-500">
                Total Students
              </p>
              <div class="hs-tooltip">
                <div class="hs-tooltip-toggle">
                  <svg class="flex-shrink-0 size-4 text-gray-500 dark:text-neutral-500"
                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10" />
                    <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3" />
                    <path d="M12 17h.01" />
                  </svg>
                  <span
                    class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible z-10 py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-neutral-700"
                    role="tooltip">
                    The number users
                  </span>
                </div>
              </div>
            </div>

            <div class="mt-1 flex items-center gap-x-2">
              <h3 class="text-xl sm:text-2xl font-medium text-gray-800 dark:text-neutral-200">
                {{ users }}
              </h3>
            </div>
          </div>
        </div>
        <!-- End Card -->


        <!-- Card -->
        <div class="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
          <div class="p-4 md:p-5">
            <div class="flex items-center gap-x-2">
              <p class="text-xs uppercase tracking-wide text-gray-500 dark:text-neutral-500">
                Total Borrowed Books
              </p>
              <div class="hs-tooltip">
                <div class="hs-tooltip-toggle">
                  <svg class="flex-shrink-0 size-4 text-gray-500 dark:text-neutral-500"
                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10" />
                    <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3" />
                    <path d="M12 17h.01" />
                  </svg>
                  <span
                    class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible z-10 py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-neutral-700"
                    role="tooltip">
                    number Borrowed Books
                  </span>
                </div>
              </div>
            </div>

            <div class="mt-1 flex items-center gap-x-2">
              <h3 class="text-xl sm:text-2xl font-medium text-gray-800 dark:text-neutral-200">
                {{ borrowedBooks }}
              </h3>
            </div>
          </div>
        </div>
        <!-- End Card -->

        <!-- Card -->
        <div class="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
          <div class="p-4 md:p-5">
            <div class="flex items-center gap-x-2">
              <p class="text-xs uppercase tracking-wide text-gray-500 dark:text-neutral-500">
                Total Books
              </p>
              <div class="hs-tooltip">
                <div class="hs-tooltip-toggle">
                  <svg class="flex-shrink-0 size-4 text-gray-500 dark:text-neutral-500"
                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10" />
                    <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3" />
                    <path d="M12 17h.01" />
                  </svg>
                  <span
                    class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible z-10 py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-neutral-700"
                    role="tooltip">
                    number of Books
                  </span>
                </div>
              </div>
            </div>

            <div class="mt-1 flex items-center gap-x-2">
              <h3 class="text-xl sm:text-2xl font-medium text-gray-800 dark:text-neutral-200">
                {{ books }}
              </h3>
            </div>
          </div>
        </div>
        <!-- End Card -->
        <!-- Card -->
        <div class="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
          <div class="p-4 md:p-5">
            <div class="flex items-center gap-x-2">
              <p class="text-xs uppercase tracking-wide text-gray-500 dark:text-neutral-500">
                Total Printing
              </p>
              <div class="hs-tooltip">
                <div class="hs-tooltip-toggle">
                  <svg class="flex-shrink-0 size-4 text-gray-500 dark:text-neutral-500"
                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10" />
                    <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3" />
                    <path d="M12 17h.01" />
                  </svg>
                  <span
                    class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible z-10 py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-neutral-700"
                    role="tooltip">
                    Number of Printing Service
                  </span>
                </div>
              </div>
            </div>

            <div class="mt-1 flex items-center gap-x-2">
              <h3 class="text-xl sm:text-2xl font-medium text-gray-800 dark:text-neutral-200">
                {{ printings }}
              </h3>
            </div>
          </div>
        </div>
        <!-- End Card -->
      </div>
      <!-- End Grid -->
    </div>
  </div>

  <div class="flex flex-wrap md:flex-wrap-reverse">
    <div class=" w-full lg:ps-64  container lg:w-1/2">
      <div class="p-4 sm:p-6 space-y-4 sm:space-y-6">
        <div class="border mx-auto p-5 rounded-lg text-custom-blue">
          <h1 class="text-3xl font-bold mb-4 text-custom-blue">Library Rules and Regulations</h1>

          <div class="bg-white shadow-md rounded-lg p-3 mb-3">
            <h2 class="text-sm font-semibold mb-1">1. Silence</h2>
            <p class="text-xs">Maintain silence at all times within the library premises for a conducive
              studying environment.</p>
          </div>

          <div class="bg-white shadow-md rounded-lg p-3 mb-3">
            <h2 class="text-sm font-semibold mb-1">2. No Food and Drinks</h2>
            <p class="text-xs">Prohibited to maintain cleanliness and prevent damage to library
              materials.</p>
          </div>

          <div class="bg-white shadow-md rounded-lg p-3 mb-3">
            <h2 class="text-sm font-semibold mb-1">3. Mobile Phones</h2>
            <p class="text-xs">Set to silent mode or turned off to avoid disturbance to others.</p>
          </div>

          <div class="bg-white shadow-md rounded-lg p-3 mb-3">
            <h2 class="text-sm font-semibold mb-1">4. Handling of Materials</h2>
            <p class="text-xs">Handle library materials with care and return to their proper place.</p>
          </div>

          <div class="bg-white shadow-md rounded-lg p-3 mb-3">
            <h2 class="text-sm font-semibold mb-1">5. Borrowed Books</h2>
            <p class="text-xs">Return borrowed books on time to avoid fines or penalties.</p>
          </div>

          <div class="bg-white shadow-md rounded-lg p-3 mb-3">
            <h2 class="text-sm font-semibold mb-1">6. Computer Terminals</h2>
            <p class="text-xs">Use for research and study only, not for entertainment or gaming.</p>
          </div>

          <div class="bg-white shadow-md rounded-lg p-3 mb-3">
            <h2 class="text-sm font-semibold mb-1">7. Printing Services</h2>
            <p class="text-xs">Available with fees according to the printing price list.</p>
          </div>

          <div class="bg-white shadow-md rounded-lg p-3 mb-3">
            <h2 class="text-sm font-semibold mb-1">8. Personal Belongings</h2>
            <p class="text-xs">Do not leave unattended; lockers may be provided.</p>
          </div>

          <div class="bg-white shadow-md rounded-lg p-3 mb-3">
            <h2 class="text-sm font-semibold mb-1">9. Disruptive Behavior</h2>
            <p class="text-xs">Not tolerated; may result in suspension or legal action.</p>
          </div>

          <div class="bg-white shadow-md rounded-lg p-3 mb-3">
            <h2 class="text-sm font-semibold mb-1">10. Authority of Librarian</h2>
            <p class="text-xs">Librarian has full authority to enforce rules; non-compliance may result
              in
              expulsion.</p>
          </div>
        </div>
      </div>
    </div>

    <div>
      <div class="p-4 sm:p-6 space-y-4 sm:space-y-6">
        <div class="border mx-auto p-5 rounded-lg text-custom-blue">
          <h2 class="text-lg font-semibold mb-2">Library Opening Hours</h2>
          <p class="text-sm mb-2">Monday to Friday</p>
          <p class="text-xs mb-2">8:00 AM to 5:00 PM</p>
        </div>
      </div>
    </div>
    <div>
      <div class="p-4 sm:p-6 space-y-4 sm:space-y-6">
        <div class="border mx-auto p-5 rounded-lg text-custom-blue">
          <h2 class="text-lg font-semibold mb-2">Library Status</h2>
          <p class="text-sm mb-2">Current Status:</p>
          <p class="text-xs mb-2">Library: <span :class="{'font-semibold': libraryOpen}">{{ libraryStatus }}</span></p>
          <p class="text-xs mb-2">Librarian: <span :class="{'font-semibold': librarianAvailable}">{{ librarianStatus }}</span></p>
        </div>
        <div class="flex justify-center space-x-4">
          <button @click="toggleLibraryStatus" :class="{'bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded': libraryOpen, 'bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded': !libraryOpen}">
            {{ libraryButtonText }}
          </button>
          <button @click="toggleLibrarianStatus" :class="{'bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded': librarianAvailable, 'bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded': !librarianAvailable}">
            {{ librarianButtonText }}
          </button>
        </div>
      </div>
    </div>
  </div>

</template>