<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <Link :href="'/'" class="text-4xl text-bold font-weight-bolder">
        <div class="flex items-center hover:cursor-pointer">
            <img src="/logo.png" class="w-24 mr-2" alt="Logo">
            <span class="text-xl text-custom-blue hover:text-custom-blue-dark mt-2">TechLibrary</span>
        </div>
    </Link>
</template>
