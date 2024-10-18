<script setup lang="ts">
import FlameIcon from "~/components/icons/FlameIcon.vue";
import StarIcon from "~/components/icons/StarIcon.vue";

export interface AppTopPost {
  img: string;
  title: string;
  creator: string;
  rate: number;
}

defineProps({
  items: {
    type: Array as () => AppTopPost[], default: () => {
      return [{
        img: 'top-posts/1.png',
        title: "Jujutsu Kaisen",
        creator: "Osamu Tezuka",
        rate: 7.6
      },
        {
          img: 'top-posts/2.png',
          title: "Jujutsu Kaisen",
          creator: "Osamu Tezuka",
          rate: 7.6
        },
        {
          img: 'top-posts/3.png',
          title: "Jujutsu Kaisen",
          creator: "Osamu Tezuka",
          rate: 7.6
        },
        {
          img: 'top-posts/4.png',
          title: "Jujutsu Kaisen",
          creator: "Osamu Tezuka",
          rate: 7.6
        },
        {
          img: 'top-posts/5.png',
          title: "Jujutsu Kaisen",
          creator: "Osamu Tezuka",
          rate: 7.6
        }];
    }
  }
})
</script>

<template>
  <div class="pt-12 lg:pt-[140px] px-4 lg:px-12 text-white">
    <div class="w-full h-full">
      <div class="flex flex-col gap-9">
        <p class="flex custom-font-1 text-[37px] leading-[45px] gap-2.5">
          Weekly Hot
          <FlameIcon/>
        </p>
        <div class="w-full grid grid-cols-2 lg:grid-cols-5 gap-[28px]">
          <div :class="['relative rounded-md h-[200px] lg:h-[275px] w-auto overflow-hidden', index > 1 ? 'hidden lg:block' : '']" v-for="(item, index) in items">
            <NuxtImg :src="item.img" class="absolute object-cover object-center z-0 w-full h-full"/>

            <div class="absolute bottom-0 left-0 z-10 p-2 w-a bg-text-gradient w-full">
              <div class="flex flex-col gap-[1px]">
                <p class="custom-font-1 text-2xl">{{ item.title }}</p>
                <div class="flex justify-between custom-font-2 text-[10px]">
                  {{ item.creator }} <span class="flex gap-0.5">{{item.rate}} <StarIcon /></span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>


<style scoped>

</style>