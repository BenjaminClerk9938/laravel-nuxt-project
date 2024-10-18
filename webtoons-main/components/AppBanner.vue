<script setup lang="ts">
export interface BannerProps {
  heading: string;
  title: string;
  cta_text: string;
  cta_url: string;
  img: string;
  img_mobile: string;
}

const props = defineProps({
  sources: {
    type: Array as () => BannerProps[],
    default: () => [
      {
        heading: "Introducing Osamu Tezuka",
        title: "Someone processed my body for 10 years",
        cta_text: "Read now",
        cta_url: "/",
        img: "banner.png",
        img_mobile: "banner-mb.png"
      },
      {
        heading: "Introducing Osamu Tezuka",
        title: "Someone processed my body for 10 years",
        cta_text: "Read now",
        cta_url: "/",
        img: "banner.png",
        img_mobile: "banner-mb.png"
      },
      {
        heading: "Introducing Osamu Tezuka",
        title: "Someone processed my body for 10 years",
        cta_text: "Read now",
        cta_url: "/",
        img: "banner.png",
        img_mobile: "banner-mb.png"
      },
      {
        heading: "Introducing Osamu Tezuka",
        title: "Someone processed my body for 10 years",
        cta_text: "Read now",
        cta_url: "/",
        img: "banner.png",
        img_mobile: "banner-mb.png"
      },
    ]
  },
});

const index = ref<number>(0);
const fade = ref(false);
let interval: ReturnType<typeof setInterval>;

const nextSlide = () => {
  fade.value = false;
  setTimeout(() => {
    index.value = (index.value + 1) % props.sources.length;
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
  <div class="bg-black">
    <div class="h-[410px] md:h-[713px] w-full md:px-12 px-4 pb-2.5 md:pb-[73px]">
      <div class="flex items-start md:items-center w-full h-full rounded-xl bg-dark-gradient relative overflow-hidden">
        <NuxtImg :src="sources[index].img" class="block md:hidden object-cover w-full h-full absolute top-0 left-0 rounded-xl z-0 transition-opacity duration-300" :class="{'opacity-0': !fade, 'opacity-100': fade}" /><NuxtImg :src="sources[index].img" class="object-cover w-full h-full absolute top-0 left-0 rounded-xl z-0 transition-opacity duration-300" :class="{'opacity-0': !fade, 'opacity-100': fade}" />
        <NuxtImg :src="sources[index].img_mobile" class="md:hidden block object-cover w-full h-full absolute top-0 left-0 rounded-xl z-0 transition-opacity duration-300" :class="{'opacity-0': !fade, 'opacity-100': fade}" />

        <div class="flex flex-col gap-4 mt-[95px] md:mt-[181px] mx-7 md:mx-12 z-10 text-white w-[285px] md:w-full">
          <p class="font-semibold text-2xl custom-font-2">
            {{ sources[index].heading }}
          </p>
          <p class="font-normal text-[32px] text-6xl md:leading-[73px] custom-font-1 text max-w-[578px]">
            {{ sources[index].title }}
          </p>
          <div>
            <NuxtLink :to="sources[index].cta_url">
              <button class="bg-red-1 transition-all duration-500 hover:bg-opacity-80 border-red-1 border-2 font-semibold text-white text-center custom-font-2 px-9 py-2.5 md:py-[17px] rounded-[10px] text-sm md:text-base">
                {{ sources[index].cta_text }}
              </button>
            </NuxtLink>
          </div>
        </div>

        <ul class="flex absolute z-10 bottom-5 md:bottom- 14 right-7 md:right-14 gap-[5px]" v-if="sources.length > 1">
          <li
              v-for="i in sources.length"
              :key="i"
              @click="handleClick(i)"
              :class="['flex items-center justify-center border rounded-full h-8 w-8 hover:bg-white/20 hover:text-white cursor-pointer', index + 1 == i ? 'bg-white' : 'text-white']">
            {{ i }}
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<style scoped></style>
