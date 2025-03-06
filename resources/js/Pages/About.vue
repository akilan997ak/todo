<template>
    <div class="bg-black text-white min-h-screen flex items-center justify-center">
      <div class="container mx-auto px-6 py-10">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center">
          
          <!-- Left Content (Text) -->
          <div ref="textSection" class="space-y-6">
            <h1 class="text-4xl md:text-5xl font-bold text-green-900">About Us</h1>
            <p class="text-gray-300 text-lg">
              Welcome to our platform! We are dedicated to providing the best services to our users with innovative technology and seamless experiences.
            </p>
            <button class="bg-purple-500 hover:bg-green-600 transition-all px-6 py-3 rounded-lg text-white font-semibold">
              Learn More
            </button>
          </div>
  
          <!-- Right Content (Image) -->
          <div ref="imageSection">
            <img src="/assets/about.webp" alt="About Image" 
              class="rounded-lg shadow-lg mx-auto md:w-full">
          </div>
  
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import { ref, onMounted } from "vue";
  import { useMotion } from "@vueuse/motion"; // ✅ Correct import
  
  export default {
    setup() {
      const textSection = ref(null);
      const imageSection = ref(null);
  
      onMounted(() => {
        useMotion(textSection, {
          initial: { opacity: 0, x: -50 },
          enter: { opacity: 1, x: 0, transition: { duration: 1000 } }
        });
  
        useMotion(imageSection, {
          initial: { opacity: 0, scale: 0.8 },
          enter: { opacity: 1, scale: 1, transition: { duration: 1000, delay: 500 } }
        });
      });
  
      return { textSection, imageSection };
    }
  };
  </script>
  

  