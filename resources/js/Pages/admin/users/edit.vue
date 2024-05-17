<script setup>

import Sidebar from '@/Components/Admin/Sidebar.vue'
import Header from '@/Components/Admin/Header.vue'
import { useToast } from 'vue-toast-notification';



</script>

<script>
export default {
    props: {
        errors: Object,
        auth: Object,
        users: Object,
    },
    data() {
        return {
            form: {
                name: this.users.name,
            }
        }
    },
    methods: {
        submitForm() {
            this.$inertia.put(`/admin/authors/${this.users.id}`, this.form, {
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

                    this.errors = errors.response.data.errors;
                },
            });
        }
    }
}

</script>

<template>

    <Sidebar/>

    <Header/>
        <!-- Comment Form -->
        <div class="max-w-[85rem] px-4 py-4 sm:px-6 lg:px-8 lg:py-4 mx-auto">
            <div class="mx-auto max-w-2xl">
                <!-- Card -->
                <div
                    class="mt-5 p-4 relative z-10 bg-white border rounded-xl sm:mt-10 md:p-10 dark:bg-gray-800 dark:border-gray-700">
                    <form @submit.prevent="submitForm">
                        <div class="mb-4 sm:mb-8">
                            <label for="authors-name" class="block mb-2 text-sm font-medium dark:text-white">Author Name</label>
                            <input type="text" id="authors-name" v-model="form.name"
                                class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-green-500 focus:ring-green-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600"
                                placeholder="Authors Name">
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