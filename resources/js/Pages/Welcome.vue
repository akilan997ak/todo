<script setup>
import { ref, onMounted } from 'vue';
import lottie from 'lottie-web';

const showLogo = ref(true);
let animationInstance = null;

onMounted(() => {
    // Fetch animation data from the public folder
    fetch('/assets/animation.json')  // Ensure this is correctly placed in the public/assets folder
        .then(response => {
            if (!response.ok) {
                throw new Error('Animation JSON not found!');
            }
            return response.json();
        })
        .then(data => {
            console.log('Animation data loaded:', data); // Verify the fetched data

            // Initialize Lottie animation with fetched data
            animationInstance = lottie.loadAnimation({
                container: document.getElementById('animation-container'),  // Target div
                renderer: 'svg',  // Use SVG rendering for better quality
                loop: true,  // Loop the animation if necessary
                autoplay: true,  // Automatically play the animation
                animationData: data,  // Use the fetched JSON animation data
            });
        })
        .catch(err => {
            console.error('Failed to load animation data:', err);  // Handle errors
        });

    // After 5 seconds, hide the animation and redirect to the login page
    setTimeout(() => {
        showLogo.value = false;
        window.location.href = route('login');  // Redirect to the login page
    }, 5000);  // Set timeout to 5 seconds
});
</script>

<template>
    <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-white">
        <!-- Lottie Animation - Visible for 5 seconds -->
        <div v-if="showLogo" id="animation-container" class="absolute flex justify-center items-center w-full h-full">
            <!-- Lottie will render the animation inside this div -->
        </div>
    </div>
</template>

<style scoped>
/* Ensure the container is properly sized and centered */
#animation-container {
    width: 200px;  /* Adjust the size of the animation */
    height: 200px; /* Adjust the size of the animation */
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 50; /* Ensure the container is on top */
}

/* Make sure the outer container has a white background and is full height */
body, html, .min-h-screen {
    margin: 0;
    padding: 0;
    height: 100%;
    background-color: black; /* White background for the entire screen */
}
</style>
