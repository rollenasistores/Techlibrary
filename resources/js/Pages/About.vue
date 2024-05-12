<script setup>

import { Head, Link } from '@inertiajs/vue3';
import { onMounted } from 'vue';
import Header from '@/Components/welcome/header.vue';
import Books from '@/Components/Books.vue';

import { useToast } from 'vue-toast-notification';
onMounted(() => {
    window.HSStaticMethods.autoInit();
});


</script>

<script>
export default {

    props: {
        errors: Object,
        auth: Object,
        authors: Object,
        genres: Object,
    },
    data() {
        return {
            form: {
                firstName: '',
                lastName: '',
                email: '',
                phoneNumber: '',
                details: '',
            },


        }
    },
    methods: {
        submitForm() {
            this.$inertia.post('/public/contact', this.form, {
                onSuccess: () => {
                    // Handle success, emit event, etc.
                    this.$emit('created');

                    const $toast = useToast();
                    $toast.success(this.$page.props.flash.message);

                },
                onError: (errors) => {
                    // Handle error, set errors object, etc.
                    console.error('Error submitting form:', errors);

                    if (errors.firstName != null) {
                        const $toast = useToast();
                        $toast.error(errors.firstName);
                    }

                    if (errors.lastName != null) {
                        const $toast = useToast();
                        $toast.error(errors.lastName);
                    }

                    if (errors.email != null) {
                        const $toast = useToast();
                        $toast.error(errors.email);
                    }

                    if (errors.phoneNumber != null) {
                        const $toast = useToast();
                        $toast.error(errors.phoneNumber);
                    }

                    if (errors.details != null) {
                        const $toast = useToast();
                        $toast.error(errors.details);
                    }


                    this.errors = errors.response.data.errors;
                },
            });

        }
    }
}

</script>

<template>
    <Header />



    <!-- Features -->
    <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
        <div class="aspect-w-9 aspect-h-7">
            <img class="w-full h-80 object-cover rounded-xl"
                src="https://images.unsplash.com/photo-1624571409412-1f253e1ecc89?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=987&q=80"
                alt="Image Description">
        </div>

        <!-- Grid -->
        <div class="mt-5 lg:mt-16 grid lg:grid-cols-3 gap-8 lg:gap-12">
            <div class="lg:col-span-1">
                <h2 class="font-bold text-2xl md:text-3xl text-gray-800 dark:text-neutral-200">
                    Vision
                </h2>
                <p class="mt-2 md:mt-4 text-gray-500 dark:text-neutral-500">
                    Rogationist College is a prime Catholic educational community dedicated to the formation of
                    culturally competent and socially responsible persons driven by the ideals of St. Hannibal Mary di
                    Francia.
                    Mission
                </p>
            </div>
            <!-- End Col -->

            <div class="lg:col-span-2">
                <h2 class="font-bold text-2xl md:text-3xl text-gray-800 dark:text-neutral-200">
                    Mission
                </h2>
                <p class="mt-2 md:mt-4 text-gray-500 dark:text-neutral-500">
                    • Form its members toward love of God and neighbor, patriotism, integrity, and excellence;<br>
                    • Offer a balanced and technically-oriented curriculum, as well as excellent instruction, learning
                    environment and facilities;<br>
                    • Prepare well-rounded graduates who are agents of social growth and transformation; and<br>
                    • Promote a culture of vocation and good workers who, like St. Hannibal, will be espousing the cause
                    of the poor especially the children.<br>
                </p>
            </div>
            <!-- End Col -->
            <!-- End Col -->
        </div>
        <!-- End Grid -->
    </div>
    <!-- End Features -->

    <hr class="border-4">
    <!-- Contact Us -->
    <div class="px-4  max-w-full py-10 sm:px-6 lg:px-8 lg:py-14 ">
        <div class="max-w-2xl lg:max-w-5xl mx-auto">
            <div class="text-center">
                <h1 class="text-3xl font-bold text-gray-800 sm:text-4xl dark:text-white">
                    Contact us
                </h1>
                <p class="mt-1 text-gray-600 dark:text-neutral-400">
                    We'd love to talk about how we can help you.
                </p>
            </div>

            <div class="mt-12 grid items-center lg:grid-cols-2 gap-6 lg:gap-16">
                <!-- Card -->
                <div class="flex flex-col border rounded-xl p-4 sm:p-6 lg:p-8 dark:border-neutral-700">
                    <h2 class="mb-8 text-xl font-semibold text-gray-800 dark:text-neutral-200">
                        Fill in the form
                    </h2>

                    <form @submit.prevent="submitForm">
                        <div class="grid gap-4">
                            <!-- Grid -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label for="hs-firstname-contacts-1" class="sr-only">First Name</label>
                                    <input type="text" v-model="form.firstName" name="hs-firstname-contacts-1" id="hs-firstname-contacts-1"
                                        class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-custom-blue focus:ring-custom-blue-dark disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                        placeholder="First Name">
                                </div>

                                <div>
                                    <label for="hs-lastname-contacts-1" class="sr-only">Last Name</label>
                                    <input type="text" v-model="form.lastName" name="hs-lastname-contacts-1" id="hs-lastname-contacts-1"
                                        class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-custom-blue focus:ring-custom-blue-dark disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                        placeholder="Last Name">
                                </div>
                            </div>
                            <!-- End Grid -->

                            <div>
                                <label for="hs-email-contacts-1" class="sr-only">Email</label>
                                <input type="email" v-model="form.email" name="hs-email-contacts-1" id="hs-email-contacts-1"
                                    autocomplete="email"
                                    class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-custom-blue focus:ring-custom-blue disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                    placeholder="Email">
                            </div>

                            <div>
                                <label for="hs-phone-number-1" class="sr-only">Phone Number</label>
                                <input type="text" v-model="form.phoneNumber" name="hs-phone-number-1" id="hs-phone-number-1"
                                    class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-custom-blue focus:ring-custom-blue disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                    placeholder="Phone Number">
                            </div>

                            <div>
                                <label for="hs-about-contacts-1" class="sr-only">Details</label>
                                <textarea id="hs-about-contacts-1" v-model="form.details" name="hs-about-contacts-1" rows="4"
                                    class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-custom-blue focus:ring-custom-blue disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                    placeholder="Details"></textarea>
                            </div>
                        </div>
                        <!-- End Grid -->

                        <div class="mt-4 grid">
                            <button type="submit"
                                class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-custom-blue text-white hover:bg-custom-blue-dark disabled:opacity-50 disabled:pointer-events-none">Send
                                inquiry</button>
                        </div>

                        <div class="mt-3 text-center">
                            <p class="text-sm text-gray-500 dark:text-neutral-500">
                                We'll get back to you in 1-2 business days.
                            </p>
                        </div>
                    </form>
                </div>
                <!-- End Card -->

                <div class="divide-y divide-gray-200 dark:divide-neutral-800">
                    <!-- Icon Block -->
                    <div class="flex gap-x-7 py-6">
                        <svg class="flex-shrink-0 size-6 mt-1.5 text-gray-800 dark:text-neutral-200"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10" />
                            <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3" />
                            <path d="M12 17h.01" />
                        </svg>
                        <div class="grow">
                            <h3 class="font-semibold text-gray-800 dark:text-neutral-200">Knowledgebase</h3>
                            <p class="mt-1 text-sm text-gray-500 dark:text-neutral-500">We're here to help with any
                                questions or code.</p>
                            <a class="mt-2 inline-flex items-center gap-x-2 text-sm font-medium text-gray-600 hover:text-gray-800 dark:text-neutral-400 dark:hover:text-neutral-200"
                                href="#">
                                Contact support
                                <svg class="flex-shrink-0 size-2.5 transition ease-in-out group-hover:translate-x-1"
                                    width="16" height="16" viewBox="0 0 16 16" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M0.975821 6.92249C0.43689 6.92249 -3.50468e-07 7.34222 -3.27835e-07 7.85999C-3.05203e-07 8.37775 0.43689 8.79749 0.975821 8.79749L12.7694 8.79748L7.60447 13.7596C7.22339 14.1257 7.22339 14.7193 7.60447 15.0854C7.98555 15.4515 8.60341 15.4515 8.98449 15.0854L15.6427 8.68862C16.1191 8.23098 16.1191 7.48899 15.6427 7.03134L8.98449 0.634573C8.60341 0.268455 7.98555 0.268456 7.60447 0.634573C7.22339 1.00069 7.22339 1.59428 7.60447 1.9604L12.7694 6.92248L0.975821 6.92249Z"
                                        fill="currentColor" />
                                </svg>
                            </a>
                        </div>
                    </div>
                    <!-- End Icon Block -->

                    <!-- Icon Block -->
                    <div class="flex gap-x-7 py-6">
                        <svg class="flex-shrink-0 size-6 mt-1.5 text-gray-800 dark:text-neutral-200"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M14 9a2 2 0 0 1-2 2H6l-4 4V4c0-1.1.9-2 2-2h8a2 2 0 0 1 2 2v5Z" />
                            <path d="M18 9h2a2 2 0 0 1 2 2v11l-4-4h-6a2 2 0 0 1-2-2v-1" />
                        </svg>
                        <div class="grow">
                            <h3 class="font-semibold text-gray-800 dark:text-neutral-200">FAQ</h3>
                            <p class="mt-1 text-sm text-gray-500 dark:text-neutral-500">Search our FAQ for answers to
                                anything you might ask.</p>
                            <a class="mt-2 inline-flex items-center gap-x-2 text-sm font-medium text-gray-600 hover:text-gray-800 dark:text-neutral-400 dark:hover:text-neutral-200"
                                href="#">
                                Visit FAQ
                                <svg class="flex-shrink-0 size-2.5 transition ease-in-out group-hover:translate-x-1"
                                    width="16" height="16" viewBox="0 0 16 16" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M0.975821 6.92249C0.43689 6.92249 -3.50468e-07 7.34222 -3.27835e-07 7.85999C-3.05203e-07 8.37775 0.43689 8.79749 0.975821 8.79749L12.7694 8.79748L7.60447 13.7596C7.22339 14.1257 7.22339 14.7193 7.60447 15.0854C7.98555 15.4515 8.60341 15.4515 8.98449 15.0854L15.6427 8.68862C16.1191 8.23098 16.1191 7.48899 15.6427 7.03134L8.98449 0.634573C8.60341 0.268455 7.98555 0.268456 7.60447 0.634573C7.22339 1.00069 7.22339 1.59428 7.60447 1.9604L12.7694 6.92248L0.975821 6.92249Z"
                                        fill="currentColor" />
                                </svg>
                            </a>
                        </div>
                    </div>
                    <!-- End Icon Block -->

                    <!-- Icon Block -->
                    <div class=" flex gap-x-7 py-6">
                        <svg class="flex-shrink-0 size-6 mt-1.5 text-gray-800 dark:text-neutral-200"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path
                                d="M21.2 8.4c.5.38.8.97.8 1.6v10a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V10a2 2 0 0 1 .8-1.6l8-6a2 2 0 0 1 2.4 0l8 6Z" />
                            <path d="m22 10-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 10" />
                        </svg>
                        <div class="grow">
                            <h3 class="font-semibold text-gray-800 dark:text-neutral-200">Contact us by email</h3>
                            <p class="mt-1 text-sm text-gray-500 dark:text-neutral-500">If you wish to write us an email
                                instead please use</p>
                            <a class="mt-2 inline-flex items-center gap-x-2 text-sm font-medium text-gray-600 hover:text-gray-800 dark:text-neutral-400 dark:hover:text-neutral-200"
                                href="#">
                                rogationistcollege@rog.edu.ph
                            </a>
                        </div>
                    </div>
                    <!-- End Icon Block -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Contact Us -->
</template>