

<template>
    <div class="bg-black text-white min-h-screen-250 flex items-center justify-center">
      <div class="container mx-auto px-6 py-10">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center">
 <!-- text portion    -->
          <div ref="textSection" class="space-y-6">
            <h1 class="text-4xl md:text-5xl font-bold text-purple-500 drop-shadow-[0_0_10px_rgba(255,255,255,0.8)]">About Us</h1>
            <p class="text-gray-300 text-lg">
              Welcome to our platform! We are dedicated to providing the best services to our users with innovative technology and seamless experiences.
            </p>
            <button class="bg-purple-500 hover:bg-green-600 transition-all px-6 py-3 rounded-lg text-white font-semibold drop-shadow-[0_0_5px_rgba(255,255,255,0.8)]">
              Learn More
            </button>
          </div>
  <!-- image portion -->
          <div ref="imageSection">
            <img src="/assets/about.webp" alt="About Image" 
              class="rounded-lg shadow-lg mx-auto md:w-full">
          </div>
  
        </div>
      </div>
    </div>
    <div class="bg-white dark:bg-black py-6 sm:py-8 lg:py-12">
    <div class="mx-auto max-w-screen-2xl px-4 md:px-8">
        <div class="mb-4 flex items-center justify-between gap-8 sm:mb-8 md:mb-12">
            <div class="flex items-center  justify-center gap-12">
                <h2 class="text-2xl font-bold text-purple-800 lg:text-3xl dark:text-blue drop-shadow-[0_0_10px_rgba(255,255,255,0.8)]">Our Services</h2>

                <p class="hidden max-w-screen-sm text-gray-500 dark:text-gray-300 md:block">
  <strong class="text-red-900">🚀 Cutting-Edge VR Solutions</strong><br>
  Immerse your audience in interactive virtual experiences with our advanced VR development services.
  <br><br>
  <strong class="text-red-900">💻 Expert Software Development</strong><br>
  From web to mobile, we build high-performance applications tailored to your business needs.
  <br><br>
  <strong class="text-red-900">🔧 Tech & IT Services</strong><br>
  Get seamless tech support, cloud solutions, and IT consulting to scale your business efficiently.
</p>

            </div>
        </div>
    </div>
    <div class="grid grid-cols-2 gap-4 mx-[10px] sm:grid-cols-3 md:gap-6 xl:gap-8">

<a href="#"
      class="group relative flex h-48 items-end overflow-hidden rounded-lg bg-gray-100 shadow-lg md:h-80">
      <img src="https://images.unsplash.com/photo-1593508512255-86ab42a8e620?auto=format&q=75&fit=crop&w=600" loading="lazy" alt="Photo by Minh Pham" class="absolute inset-0 h-full w-full object-cover object-center transition duration-200 group-hover:scale-110" />

      <div
          class="pointer-events-none absolute inset-0 bg-gradient-to-t from-gray-800 via-transparent to-transparent opacity-50">
      </div>

      <span class="relative ml-4 mb-3 inline-block text-sm text-white md:ml-5 md:text-lg">VR</span>
  </a>

  <a href="#"
      class="group relative flex h-48 items-end overflow-hidden rounded-lg bg-gray-100 shadow-lg md:col-span-2 md:h-80">
      <img src="https://images.unsplash.com/photo-1542759564-7ccbb6ac450a?auto=format&q=75&fit=crop&w=1000" loading="lazy" alt="Photo by Magicle" class="absolute inset-0 h-full w-full object-cover object-center transition duration-200 group-hover:scale-110" />

      <div
          class="pointer-events-none absolute inset-0 bg-gradient-to-t from-gray-800 via-transparent to-transparent opacity-50">
      </div>

      <span class="relative ml-4 mb-3 inline-block text-sm text-white md:ml-5 md:text-lg">Tech</span>
  </a>

  <a href="#"
      class="group relative flex h-48 items-end overflow-hidden rounded-lg bg-gray-100 shadow-lg md:col-span-2 md:h-80">
      <img src="https://images.unsplash.com/photo-1610465299996-30f240ac2b1c?auto=format&q=75&fit=crop&w=1000" loading="lazy" alt="Photo by Martin Sanchez" class="absolute inset-0 h-full w-full object-cover object-center transition duration-200 group-hover:scale-110" />

      <div
          class="pointer-events-none absolute inset-0 bg-gradient-to-t from-gray-800 via-transparent to-transparent opacity-50">
      </div>

      <span class="relative ml-4 mb-3 inline-block text-sm text-white md:ml-5 md:text-lg">Dev</span>
  </a>

  <a href="#"
      class="group relative flex h-48 items-end overflow-hidden rounded-lg bg-gray-100 shadow-lg md:h-80">
      <img src="https://images.unsplash.com/photo-1550745165-9bc0b252726f?auto=format&q=75&fit=crop&w=600" loading="lazy" alt="Photo by Lorenzo Herrera" class="absolute inset-0 h-full w-full object-cover object-center transition duration-200 group-hover:scale-110" />

      <div
          class="pointer-events-none absolute inset-0 bg-gradient-to-t from-gray-800 via-transparent to-transparent opacity-50">
      </div>

      <span class="relative ml-4 mb-3 inline-block text-sm text-white md:ml-5 md:text-lg">Retro</span>
  </a>
</div>
</div>

<!-- slider -->
<div class="bg-black text-white px-[30px] py-[30px] flex items-center justify-center">
  <Swiper
  :modules="[Navigation, Pagination, Autoplay]"
  :slides-per-view="1"
  :loop="true"
  :pagination="{ clickable: true }"
  :autoplay="{ delay: 3000, disableOnInteraction: false }" 
  class="rounded-lg shadow-lg"
>
  <SwiperSlide v-for="(slide, index) in slideimages" :key="index" class="relative">
    <img
      :src="slide.src"
      :alt="'Slide ' + (index + 1)"
      class="w-full h-[300px] md:h-[500px] object-cover rounded-lg"
    />
    <!-- Stacked Content -->
    <div class="absolute inset-0 flex flex-col items-center justify-center bg-black bg-opacity-50 text-white p-4">
      <h2 class="text-2xl font-bold">{{ slide.title }}</h2>
      <p class="text-sm md:text-base text-center mt-2">{{ slide.description }}</p>
    </div>
  </SwiperSlide>
</Swiper>


  </div>
 
  <div class="h-[500px] bg-black w-full"></div>

  
  </template>
  
  <script>
  import { ref, onMounted } from "vue";
  import { useMotion } from "@vueuse/motion";
  import { Swiper, SwiperSlide } from "swiper/vue";
import { Navigation, Pagination, Autoplay } from "swiper/modules";
import "swiper/css";
import "swiper/css/navigation";
import "swiper/css/pagination";

  export default {
    components: {
    Swiper,
    SwiperSlide
  },
    setup() {
      const textSection = ref(null);
      const imageSection = ref(null);
      const slideimages = ref([
      {
        src: "assets/vr.webp",
        title: "Cutting-Edge VR Solutions",
        description:
          "Immerse your audience in interactive virtual experiences with our advanced VR development.",
      },
      {
        src: "assets/dev.webp",
        title: "Expert Software Development",
        description:
          "From web to mobile, we build high-performance applications tailored to your business needs.",
      },
      {
        src: "assets/tech.webp",
        title: "Tech & IT Services",
        description:
          "Get seamless tech support, cloud solutions, and IT consulting to scale your business efficiently.",
      },
    ]);
  
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
  
      return { textSection, imageSection,slideimages, Navigation, Pagination, Autoplay };
    },
  };
      
  </script>
  
