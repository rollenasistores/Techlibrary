<script setup>

import { Head, Link } from '@inertiajs/vue3';
import { onMounted } from 'vue';
import Header from '@/Components/welcome/header.vue';
import Books from '@/Components/Books.vue';

onMounted(() => {
    window.HSStaticMethods.autoInit();
});


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
                    • Offer a balanced and technically-oriented curriculum, as well as excellent instruction, learning environment and facilities;<br>
                    • Prepare well-rounded graduates who are agents of social growth and transformation; and<br>
                    • Promote a culture of vocation and good workers who, like St. Hannibal, will be espousing the cause of the poor especially the children.<br>
                </p>
            </div>
            <!-- End Col -->
            <!-- End Col -->
        </div>
        <!-- End Grid -->
    </div>
    <!-- End Features -->
</template>