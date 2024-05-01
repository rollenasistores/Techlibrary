<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Footer from '@/Components/Footer.vue';

</script>
<script>
export default {
    props: {
        books: {
            type: Array,
        },
        booksOfAuthor: {
            type: Object,
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
    <AppLayout title="Borrow a Book">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Borrow a Book
            </h2>
        </template>



        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-6">

            <!-- Blog Article -->
            <div class="max-w-[85rem] px-4 sm:px-6 lg:px-8 mx-auto">
                <div class="grid lg:grid-cols-3 gap-y-8 lg:gap-y-0 lg:gap-x-6">
                    <!-- Content -->
                    <div class="lg:col-span-2">
                        <div class="py-8 lg:pe-8">
                            <div class="space-y-5 lg:space-y-8">
                                <div class="flex justify-between">
                                    <a class="inline-flex items-center gap-x-1.5 text-sm text-gray-600 decoration-2 hover:underline dark:text-blue-500"
                                        :href="route('books')">
                                        <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg"
                                            width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path d="m15 18-6-6 6-6" />
                                        </svg>
                                        Back to Book
                                    </a>

                                    <a v-if="countAvailableCopies(books) > 0" class="inline-flex items-center gap-x-1.5 text-sm decoration-2 hover:underline dark:text-blue-500 border p-2 rounded-lg bg-blue-500 text-white"
                                    :href="route('public.books.borrow', books.id)">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-book-open-check flex-shrink-0 size-4">
                                        <path d="M8 3H2v15h7c1.7 0 3 1.3 3 3V7c0-2.2-1.8-4-4-4Z" />
                                        <path d="m16 12 2 2 4-4" />
                                        <path d="M22 6V3h-6c-2.2 0-4 1.8-4 4v14c0-1.7 1.3-3 3-3h7v-2.3" />
                                    </svg>

                                    Borrow the Book
                                </a>


                                    <a v-else class="inline-flex items-center gap-x-1.5 text-sm decoration-2 hover:scale-105  transition-all dark:text-green-500 border p-2 rounded-lg bg-green-700 text-white hover:bg-green-900"
                                        :href="route('books')">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-book-open-check flex-shrink-0 size-4">
                                            <path d="M8 3H2v15h7c1.7 0 3 1.3 3 3V7c0-2.2-1.8-4-4-4Z" />
                                            <path d="m16 12 2 2 4-4" />
                                            <path d="M22 6V3h-6c-2.2 0-4 1.8-4 4v14c0-1.7 1.3-3 3-3h7v-2.3" />
                                        </svg>

                                        Reserve the Book
                                    </a>


                                </div>

                                <h2 class="text-3xl font-bold lg:text-5xl dark:text-white">{{ books.name }}</h2>

                                <div class="flex items-center gap-x-5">
                                    <p class="text-xs sm:text-sm text-gray-800 dark:text-neutral-200">
                                        {{
                                                books.genre.name }}
                                    </p>
                                </div>

                                <p class="text-lg text-gray-800 dark:text-neutral-200">{{ books.description }}</p>


                            </div>
                        </div>
                    </div>
                    <!-- End Content -->

                    <!-- Sidebar -->
                    <div
                        class="lg:col-span-1 lg:w-full lg:h-full lg:bg-gradient-to-r lg:from-gray-50 lg:via-transparent lg:to-transparent dark:from-neutral-800">
                        <div class="sticky top-0 start-0 py-8 lg:ps-8">
                            <!-- Avatar Media -->
                            <div
                                class="group flex items-center gap-x-3 border-b border-gray-200 pb-8 mb-8 dark:border-neutral-700">
                                <a class="block flex-shrink-0" href="#">
                                    <img class="size-10 rounded-full"
                                        src="https://images.unsplash.com/photo-1669837401587-f9a4cfe3126e?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=facearea&facepad=2&w=320&h=320&q=80"
                                        alt="Image Description">
                                </a>

                                <a class="group grow block" href="">
                                    <h5
                                        class="group-hover:text-gray-600 text-sm font-semibold text-gray-800 dark:group-hover:text-neutral-400 dark:text-neutral-200">
                                        {{ books.author.name }}
                                    </h5>
                                </a>

                            </div>
                            <!-- End Avatar Media -->
                            <p class="mb-3 text-justify text-2xl uppercase">Other Books Made by</p>

                            <div class="space-y-6">
                                <!-- Media -->
                                <a v-for="booksOfAuthors in booksOfAuthor" class="group flex items-center gap-x-6"
                                    href="#">
                                    <div class="grow">

                                        <p class="text-bold mb-2 uppercase border-l-8 border-green-600">
                                            {{ booksOfAuthors.name }}
                                        </p>

                                        <span
                                            class="text-sm font-bold text-gray-800 group-hover:text-blue-600 dark:text-neutral-200 dark:group-hover:text-blue-500">
                                            {{ limitDescription(booksOfAuthors.description) }}
                                        </span>
                                    </div>

                                    <div class="flex-shrink-0 relative rounded-lg overflow-hidden size-20">
                                        <img class="size-full absolute top-0 start-0 object-cover rounded-lg"
                                            :src="route('photo.show', booksOfAuthors.image_url)"
                                            alt="Image Description">
                                    </div>
                                </a>
                                <!-- End Media -->

                            </div>
                        </div>
                    </div>
                    <!-- End Sidebar -->
                </div>


            </div>
            <!-- End Blog Article -->

            <Footer />
        </div>

    </AppLayout>
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
