<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Footer from '@/Components/Footer.vue';

import { useToast } from 'vue-toast-notification';
</script>
<script>
export default {

    props: {
        errors: Object,
        auth: Object,
    },
    data() {
        return {
            form: {
                file_name: null,
                printing_type: null,
                copies: null,
            },
        }
    },
    methods: {
        selectFile(event) {
            // `files` is always an array because the file input may be in multiple mode
            this.form.file_name = event.target.files[0];

            console.log(this.form.file_name)

        },
        submitForm() {
            this.$inertia.post('/printing/store', this.form, {
                onSuccess: () => {
                    // Handle success, emit event, etc.
                    this.$emit('created');

                    const $toast = useToast();
                    if (!(this.$page.props.flash.message == null)) {

                        $toast.success(this.$page.props.flash.message);

                    } else {
                        $toast.error(this.$page.props.flash.error);
                    }

                },
                onError: (errors) => {
                    // Handle error, set errors object, etc.
                    console.error('Error submitting form:', errors);

                    if (errors.file_name != null) {
                        const $toast = useToast();
                        $toast.error(errors.file_name);
                    }

                    if (errors.printing_type != null) {
                        const $toast = useToast();
                        $toast.error(errors.printing_type);
                    }

                    if (errors.copies != null) {
                        const $toast = useToast();
                        $toast.error(errors.copies);
                    }



                    this.errors = errors.response.data.errors;
                },
            });

        }
    }
}
</script>


<template>

    <AppLayout title="Printing Service">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Printing Service
            </h2>
        </template>

        <div class="max-w-[85rem] px-4 py-4 sm:px-6 lg:px-8 lg:py-4 mx-auto">
            <div class="mx-auto max-w-2xl">
                <!-- Card -->
                <div
                    class="mt-5 p-4 relative z-10 bg-white border rounded-xl sm:mt-10 md:p-10 dark:bg-gray-800 dark:border-gray-700">
                    <form enctype="multipart/form-data" @submit.prevent="submitForm">

                        <div class="mb-4 sm:mb-8">
                            <label for="books-name" class="block mb-2 text-sm font-medium dark:text-white">File
                                Upload</label>
                            <label class="block">
                                <span class="sr-only">Choose profile photo</span>
                                <input type="file" @change="selectFile" class="block w-full text-sm text-gray-500 p-3 border rounded-lg
                                      file:me-4 file:py-2 file:px-4
                                      file:rounded-lg file:border-0
                                      file:text-sm file:font-semibold
                                      file:bg-custom-blue file:text-white
                                      hover:file:bg-custom-blue-dark
                                      file:disabled:opacity-50 file:disabled:pointer-events-none
                                      dark:text-neutral-500
                                      dark:file:bg-custom-blue
                                      dark:hover:file:bg-custom-blue-dark
                                    ">
                            </label>
                        </div>
                        
                        <div class="mb-4 sm:mb-8">
                            <label for="quantity"
                                class="block mb-2 text-sm font-medium dark:text-white">Printing Type</label>
                                <select v-model="form.printing_type" class="py-3 px-4 pe-9 block w-full border-gray-200 rounded-lg text-sm focus:border-custom-blue focus:ring-custom-blue-dark disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                    <option selected="">Select Printing Type</option>
                                    <option value="Black & white - ₱2.00 Per Page">Black & white - ₱2.00 Per Page</option>
                                    <option value="Color Printing - ₱5.00 Per Page">Color Printing - ₱5.00 Per Page</option>
                                    <option value="Double-sided Black & White - ₱3.50 Per Page">Double-sided Black & White - ₱3.50 Per Page</option>
                                    <option value="Double-sided Color Printing - ₱7 Per Page">Double-sided Color Printing - ₱7 Per Page</option>
                                  </select>
                        </div>

                        <div class="mb-4 sm:mb-8">
                            <label for="quantity"
                                class="block mb-2 text-sm font-medium dark:text-white">No. Copies</label>
                            <input type="number" id="quantity" v-model="form.copies"
                                class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-custom-blue focus:ring-custom-blue-dark disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600"
                                placeholder="Number of Copies">
                        </div>

                        <div class="mt-6 grid">
                            <button type="submit"
                                class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-custom-blue text-white hover:bg-custom-blue-dark disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">Submit</button>
                        </div>
                    </form>
                </div>
                <!-- End Card -->
            </div>
        </div>
        <Footer />
    </AppLayout>

</template>
