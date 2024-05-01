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
        borrows: Object,
    },
    data() {
        return {
            form: {
                name: this.borrows.user.name,
                code: '',
            }
        }
    },
    methods: {
        submitForm() {
            this.$inertia.put(`/admin/borrows/${this.borrows.id}`, this.form, {
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

                    if (errors.code != null) {
                        const $toast = useToast();
                        $toast.error(errors.code);
                    }

                    this.errors = errors.response.data.errors;
                },
            });
        }
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
                <form @submit.prevent="submitForm">
                    <div class="mb-4 sm:mb-8">
                        <label for="student-name" class="block mb-2 text-sm font-medium dark:text-white">Student
                            Name</label>
                        <input type="text" id="student-name" v-model="form.name"
                            class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-green-500 focus:ring-green-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600"
                            placeholder="Returning Code" disabled>
                    </div>

                    <div class="mb-4 sm:mb-8">
                        <label for="Department-name" class="block mb-2 text-sm font-medium dark:text-white">Returning
                            Code</label>
                        <input type="text" id="Department-name" v-model="form.code"
                            class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-green-500 focus:ring-green-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600"
                            placeholder="4DFO2OPQE">
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