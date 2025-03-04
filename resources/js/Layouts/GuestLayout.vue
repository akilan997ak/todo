<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-black">
        <div>
            <Link href="/">
                <!-- Use an img tag to reference the logo with a transparent background -->
                <img src="/assets/logo.png" alt="Custom Logo" class="w-80 h-60" />
            </Link>
        </div>

        <div
            class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg"
        >
            <slot />
        </div>
    </div>
</template>

<style scoped>
/* Ensure the background color of the page is black */
.bg-black {
    background-color: black;
}
</style>
