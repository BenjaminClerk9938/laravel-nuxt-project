<script setup lang="ts">
import EyeIcon from "~/components/icons/EyeIcon.vue";

interface CarouselProps {
  title: string;
  description: string;
  img: string;
  views: number;
  url: string;
}

const props = defineProps({
  items: {
    type: Array as () => CarouselProps[],
    default: () => [
      {
        title: "Someone Processed My Body For 10 Years",
        description: "Introducing Osamu Tezuka lorem ipsum doler sit amit.",
        views: 38372,
        img: "carousel.png",
        url: "/"
      },
      {
        title: "Someone Processed My Body For 10 Years",
        description: "Introducing Osamu Tezuka lorem ipsum doler sit amit.",
        views: 38372,
        img: "carousel.png",
        url: "/"
      }
    ]
  },
});

const index = ref(0);
const fade = ref(false);
let interval: ReturnType<typeof setInterval>;

const nextSlide = () => {
  fade.value = false;
  setTimeout(() => {
    index.value = (index.value + 1) % props.items.length;
    fade.value = true;
  }, 300);
};

const startInterval = () => {
  if (interval) {
    clearInterval(interval);
  }

  interval = setInterval(nextSlide, 10000);
};

const handleClick = (i: number) => {
  index.value = i - 1;
  fade.value = false;
  setTimeout(() => {
    fade.value = true;
  }, 300);
  startInterval();
};

onMounted(() => {
  fade.value = true;
  startInterval();
});

onBeforeUnmount(() => {
  clearInterval(interval);
});
</script>

<template>
  <div class="flex flex-col gap-4 mt-[140px] mx-[48px] mb-[72px] md:gap-6">
    <NuxtLink :to="items[index].url">
      <div class="rounded-lg relative h-[300px] overflow-hidden">
        <NuxtImg :src="items[index].img" class="absolute object-cover w-full h-full z-0 transition-opacity duration-300" :class="{'opacity-0': !fade, 'opacity-100': fade}" />
        <div class="flex text-white flex-col z-10 absolute top-[60px] left-[47px]">
          <span class="custom-font-1 mb-1 text-4xl w-[320px]">{{items[index].title}}</span>
          <span class="custom-font-2 mb-4 text-[10px]">{{items[index].description}}</span>
          <div class="custom-font-2">
            <button class="flex gap-2 items-center text-white py-1.5 px-6 bg-red-1 rounded-md">
              <EyeIcon /> {{items[index].views.toLocaleString()}}
            </button>
          </div>
        </div>
      </div>
    </NuxtLink>
    <ul class="flex items-center justify-center gap-3.5 pt-5 md:pt-6">
      <li
          v-for="i in items.length"
          :key="i"
          @click="handleClick(i)"
          :class="['w-2 h-2 rounded-full cursor-pointer', i == index + 1 ? 'bg-white' : 'bg-gray-2']">
      </li>
    </ul>
  </div>
</template>

<style scoped></style>
