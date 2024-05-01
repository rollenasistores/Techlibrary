<script setup>

import { Head, Link } from '@inertiajs/vue3';
import { onMounted } from 'vue';
import Header from '@/Components/welcome/header.vue';

onMounted(() => {
  window.HSStaticMethods.autoInit();
});


</script>

<script>
export default {
    props: {
        books: {
            type: Array,
        }
    },
    data() {
        return {
            searchQuery: null,
        }
    },
    computed: {
        resultQuery() {
            if (this.searchQuery) {
                const queryTerms = this.searchQuery.toLowerCase().split(" ");
                return this.books.filter(book => {
                    const nameMatch = queryTerms.every(v => book.name.toLowerCase().includes(v));
                    const authorMatch = queryTerms.some(v => book.author.name.toLowerCase().includes(v));
                    return nameMatch || authorMatch;
                });
            } else {
                return this.books;
            }
        }
    },
    methods: {
        limitDescription(description) {
            if (description.length > 120) {
                return description.substring(0, 120) + '...';
            } else {
                return description;
            }
        },
        countAvailableCopies(book) {
            return book.copies.filter(copy => copy.is_available).length;
        }

    }
}
</script>

<template>


    <Head title="Welcome" />

    <Header/>


    <Slider />

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-6">
        <!-- Card Blog -->
        <div
            class="relative z-10 flex space-x-3 p-3 bg-white border rounded-lg shadow-lg shadow-gray-100 dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-gray-900/20 ">
            <div class="flex-[1_0_0%] ">
                <label for="hs-search-article-1"
                    class="block text-sm text-gray-700 font-medium dark:text-white"><span class="sr-only">Search
                        Book / Author</span></label>
                <input type="text" v-model.trim="searchQuery" name="hs-search-article-1" id="hs-search-article-1"
                    class="py-2.5 px-4 block w-full border-transparent rounded-lg focus:border-green-500 focus:ring-green-500 dark:bg-neutral-900 dark:border-transparent dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                    placeholder="Search Book / Author">
            </div>
            <div class="flex-[0_0_auto] ">
                <a class="size-[46px] inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-green-600 text-white hover:bg-green-700 disabled:opacity-50 disabled:pointer-events-none"
                    href="#">
                    <svg class="flex-shrink-0 size-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8" />
                        <path d="m21 21-4.3-4.3" />
                    </svg>
                </a>
            </div>
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
                <!-- Title -->

                <!-- End Title -->

                <!-- Grid -->
                <transition-group name="fade" tag="div" class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Card -->
                    <a v-for="book in resultQuery" :key="book.id"
                        class="group flex flex-col h-full border border-gray-200 hover:border-transparent hover:shadow-lg transition-all duration-300 rounded-xl p-5 dark:border-neutral-700 dark:hover:border-transparent dark:hover:shadow-black/40"
                        :href="route('public.books.show', book.id)">
                        <div class="aspect-w-16 aspect-h-11">
                            <img :src="route('photo.show', book.image_url)" alt="Book Image"
                                class="w-full object-cover rounded-xl">
                        </div>
                        <div class="mt-4">
                            <span v-if="countAvailableCopies(book) > 0"
                                class="py-1 px-1.5 inline-flex items-center gap-x-1 text-xs font-medium bg-green-100 text-green-800 rounded-full dark:bg-red-500/10 dark:text-green-500">
                                <svg class="flex-shrink-0 size-3" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path
                                        d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z">
                                    </path>
                                    <path d="m9 12 2 2 4-4"></path>
                                </svg>
                                Available
                            </span>
                            <span v-else
                                class="py-1 px-1.5 inline-flex items-center gap-x-1 text-xs font-medium bg-red-100 text-red-800 rounded-full dark:bg-red-500/10 dark:text-red-500">
                                <svg class="flex-shrink-0 size-3" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path
                                        d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z">
                                    </path>
                                    <path d="M12 9v4"></path>
                                    <path d="M12 17h.01"></path>
                                </svg>
                                Not Available
                            </span>
                        </div>
                        <div class="my-6">
                            <h3
                                class="text-xl font-semibold text-gray-800 dark:text-neutral-300 dark:group-hover:text-white">
                                {{ book.name }}
                            </h3>
                            <h4>
                                {{ book.genre.name }}
                            </h4>
                            <p class="mt-5 text-gray-600 dark:text-neutral-400">
                                {{ limitDescription(book.description) }}
                            </p>
                        </div>

                        <div class="mt-auto flex items-center gap-x-3">
                            <img class="size-8 rounded-full"
                                src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=facearea&facepad=2&w=320&h=320&q=80"
                                alt="Image Description">
                            <div>
                                <h5 class="text-sm text-gray-800 dark:text-neutral-200">By {{ book.author.name }}
                                </h5>
                            </div>
                        </div>
                    </a>
                    <!-- End Card -->
                </transition-group>
                <!-- End Grid -->
            </div>
            <!-- End Card Blog -->
        </div>

        <Footer />
    </div>

</template>

<style>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.3s;
}

.fade-enter,
.fade-leave-to {
    opacity: 0;
}
</style>

