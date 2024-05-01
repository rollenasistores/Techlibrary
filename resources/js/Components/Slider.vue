<script setup>
</script>

<template>

    
  <!-- Slider -->
<div class="px-4 lg:px-6 lg:px-8 py-10">
    <div data-hs-carousel='{
        "loadingClasses": "opacity-0"
      }' class="relative">
      <div class="hs-carousel relative overflow-hidden w-full h-[30rem] md:h-[calc(100vh-106px)]  bg-gray-100 rounded-2xl dark:bg-neutral-800">
        <div class="hs-carousel-body absolute top-0 bottom-0 start-0 flex flex-nowrap transition-transform duration-700 opacity-0">
          <!-- Item -->
          <div class="hs-carousel-slide">
            <div class="h-[30rem] md:h-[calc(100vh-106px)]  flex flex-col bg-[url('https://wallpapercrafter.com/desktop/215762-the-interior-of-a-vast-libraryimpressive-library-c.jpg')] bg-cover bg-center bg-no-repeat">
              <div class="mt-auto w-2/3 md:max-w-lg ps-5 pb-5 md:ps-10 md:pb-10">
                <span class="block text-white text-2xl">Tech Library</span>
                <span class="block text-white text-md md:text-sm">is a digital platform that simplifies book reservations, borrowing, and printing services for students. It offers diverse materials with extensive search capabilities, a virtual book club, and a book progress tracker. Additionally, TechLibrary includes a printing service, sending timely reminders for book returns and promoting student engagement through book reviews.</span>
                <div class="mt-5">
                  <a :href="route('aboutus')" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-xl bg-white border border-transparent text-black hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none" href="#">
                    About Us
                  </a>
                </div>
              </div>
            </div>
          </div>
          <!-- End Item -->
  
  
          <!-- Item -->
          <div class="hs-carousel-slide">
            <div class="h-[30rem] md:h-[calc(100vh-106px)]  flex flex-col bg-[url('https://wallpaperaccess.com/full/253418.jpg')] bg-cover bg-center bg-no-repeat">
              <div class="mt-auto w-2/3 md:max-w-lg ps-5 pb-5 md:ps-10 md:pb-10">
                <span class="block text-white">TechLibrary Printing Service</span>
                <span class="block text-white text-md md:text-sm">Just upload your file, and we'll take care of the rest. Enjoy hassle-free printing with TechLibrary Printing Service.</span>
                <div class="mt-5">
                  <a :href="route('public.printing.create')" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-xl bg-white border border-transparent text-black hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none" href="#">
                    Print Now
                  </a>
                </div>
              </div>
            </div>
          </div>
          <!-- End Item -->
        </div>
      </div>
  
      <!-- Arrows -->
      <button type="button" class="hs-carousel-prev hs-carousel:disabled:opacity-50 disabled:pointer-events-none absolute inset-y-0 start-0 inline-flex justify-center items-center w-12 h-full text-black hover:bg-white/20 rounded-s-2xl focus:outline-none focus:bg-white/20">
        <span class="text-2xl" aria-hidden="true">
          <svg class="flex-shrink-0 size-3.5 md:size-4" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"></path>
          </svg>
        </span>
        <span class="sr-only">Previous</span>
      </button>
  
      <button type="button" class="hs-carousel-next hs-carousel:disabled:opacity-50 disabled:pointer-events-none absolute inset-y-0 end-0 inline-flex justify-center items-center w-12 h-full text-black hover:bg-white/20 rounded-e-2xl focus:outline-none focus:bg-white/20">
        <span class="sr-only">Next</span>
        <span class="text-2xl" aria-hidden="true">
          <svg class="flex-shrink-0 size-3.5 md:size-4" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"></path>
          </svg>
        </span>
      </button>
      <!-- End Arrows -->
    </div>
  </div>
  <!-- End Slider -->
  
</template>