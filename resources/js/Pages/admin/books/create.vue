<script setup>

import Sidebar from '@/Components/Admin/Sidebar.vue'
import Header from '@/Components/Admin/Header.vue'
import { useToast } from 'vue-toast-notification';

import Multiselect from '@vueform/multiselect'


</script>

<script>
export default {
    components: {
        Multiselect,
    },
    props: {
        errors: Object,
        auth: Object,
        authors: Object,
        genres: Object,
    },
    data() {
        return {
            form: {
                name: '',
                description: '',
                image_url: null,
                publication_year: '',
                author_id: '',
                genre_id: '',
                quantity: '',
            },


        }
    },
    methods: {
        selectFile(event) {
            // `files` is always an array because the file input may be in multiple mode
            this.form.image_url = event.target.files[0];

            console.log(this.form.image_url)
        },
        submitForm() {
            this.$inertia.post('/admin/books', this.form, {
                onSuccess: () => {
                    // Handle success, emit event, etc.
                    this.$emit('created');

                    const $toast = useToast();
                    $toast.success(this.$page.props.flash.message);

                },
                onError: (errors) => {
                    // Handle error, set errors object, etc.
                    console.error('Error submitting form:', errors);

                    if (errors.name != null) {
                        const $toast = useToast();
                        $toast.error(errors.name);
                    }

                    if (errors.image_url != null) {
                        const $toast = useToast();
                        $toast.error(errors.image_url);
                    }

                    if (errors.description != null) {
                        const $toast = useToast();
                        $toast.error(errors.description);
                    }

                    if (errors.publication_year != null) {
                        const $toast = useToast();
                        $toast.error("The Publication Year is required");
                    }


                    if (errors.author_id != null) {
                        const $toast = useToast();
                        $toast.error("The Author field is required");
                    }

                    if (errors.genre_id != null) {
                        const $toast = useToast();
                        $toast.error("The Genre field is required");
                    }

                    if (errors.quantity != null) {
                        const $toast = useToast();
                        $toast.error("The Quantity field is required");
                    }


                    this.errors = errors.response.data.errors;
                },
            });

        }
    },
    computed: {
        transformedAuthors() {
            return this.authors.map(author => ({
                label: author.name,
                value: author.id,
            }));
        },
        transformedGenres() {
            return this.genres.map(genre => ({
                label: genre.name,
                value: genre.id,
            }));
        },

    }
}

</script>

<template>

    <Sidebar />

    <Header />
    <!-- Comment Form -->
    <div class="max-w-[85rem] px-4 py-4 sm:px-6 lg:px-8 lg:py-4 mx-auto">
        <div class="mx-auto max-w-2xl">
            <!-- Card -->
            <div
                class="mt-5 p-4 relative z-10 bg-white border rounded-xl sm:mt-10 md:p-10 dark:bg-gray-800 dark:border-gray-700">
                <form enctype="multipart/form-data" @submit.prevent="submitForm" >
                    <div class="mb-4 sm:mb-8">
                        <label for="books-name" class="block mb-2 text-sm font-medium dark:text-white">Book
                            Image</label>
                                <label class="block">
                                    <span class="sr-only">Choose profile photo</span>
                                    <input type="file" @change="selectFile" class="block w-full text-sm text-gray-500 p-3 border rounded-lg
                                  file:me-4 file:py-2 file:px-4
                                  file:rounded-lg file:border-0
                                  file:text-sm file:font-semibold
                                  file:bg-green-600 file:text-white
                                  hover:file:bg-green-700
                                  file:disabled:opacity-50 file:disabled:pointer-events-none
                                  dark:text-neutral-500
                                  dark:file:bg-green-500
                                  dark:hover:file:bg-green-400
                                " >
                                </label>
                    </div>
                    <div class="mb-4 sm:mb-8">
                        <label for="authors-name" class="block mb-2 text-sm font-medium dark:text-white">Book
                            Title</label>
                        <input type="text" id="authors-name" v-model="form.name"
                            class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-green-500 focus:ring-green-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600"
                            placeholder="John Doe">
                    </div>

                    <div class="mb-4 sm:mb-8">
                        <label for="authors-name" class="block mb-2 text-sm font-medium dark:text-white">Book
                            Description</label>
                        <textarea type="text" id="authors-name" v-model="form.description"
                            class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-green-500 focus:ring-green-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600">
                        </textarea>
                    </div>

                    <div class="mb-4 sm:mb-8">
                        <label for="publication-year" class="block mb-2 text-sm font-medium dark:text-white">Publication
                            Year</label>
                        <input type="number" id="publication-year" v-model="form.publication_year"
                            class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-green-500 focus:ring-green-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600"
                            placeholder="2022">
                    </div>

                    <div class="mb-4 sm:mb-8">
                        <label for="authors-name" class="block mb-2 text-sm font-medium dark:text-white">Authors
                            Name</label>

                        <Multiselect v-model="form.author_id" :searchable="true" :options="transformedAuthors"
                            id="authors-name" />
                    </div>

                    <div class="mb-4 sm:mb-8">
                        <label for="genres-name" class="block mb-2 text-sm font-medium dark:text-white">Genre</label>
                        <Multiselect v-model="form.genre_id" :searchable="true" :options="transformedGenres"
                            id="genres-name" />
                    </div>

                    <div class="mb-4 sm:mb-8">
                        <label for="quantity" class="block mb-2 text-sm font-medium dark:text-white">Quantity</label>
                        <input type="number" id="quantity" v-model="form.quantity"
                            class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-green-500 focus:ring-green-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600"
                            placeholder="Number of Copies">
                    </div>

                    <div class="mt-6 grid">
                        <button type="submit"
                            class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-green-600 text-white hover:bg-green-700 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">Submit</button>
                    </div>
                </form>
            </div>
            <!-- End Card -->
        </div>
    </div>
    <!-- End Comment Form -->
</template>

<style src="@vueform/multiselect/themes/default.css"></style>