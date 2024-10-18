<script setup lang="ts">
import LockIcon from "~/components/icons/LockIcon.vue";

export interface Chapter {
  chapter: string;
  upload_date: string;
  img: string;
  new?: boolean;
  url?: string;
}

defineProps({
  items: {
    type: Array as () => Chapter[],
    default: () => []
  },
  loading: {
    type: Boolean,
    default: () => false
  }
})

const route = useRoute()
const router = useRouter()
</script>
<template>
  <div class="px-4 lg:px-12 pt-12 lg:pt-[100px] pb-6 lg:pb-0 bg-dark text-white">
    <p class="custom-font-1 text-[37px] pb-[36px] lg:pb-9">All chapters</p>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
      <template v-for="item in items" :key="item.chapter" v-if="!loading">
        <div
            v-if="item.url"
            @click="navigateTo(item.url, {external: true})"
            class="relative flex items-center w-full h-[111px] bg-gray-2 rounded-lg overflow-hidden z-0 border-gray-1 border cursor-pointer"
        >
          <div class="absolute w-full h-full bg-black opacity-60 flex items-center justify-center gap-2 z-50 hover:bg-white/50 hover:opacity-100 hover:text-dark">
            <span class="text-xl mt-0.5 font-semibold">Click to unlock</span> <LockIcon class="h-10"/>
          </div>
          <div class="custom-font-2 absolute text-[14px] px-4 py-1 bg-red-1 rounded-lg right-[5px] top-[5px] z-10" v-if="item.new">New</div>
          <NuxtImg :src="item.img" class="max-w-[100px] w-full h-full"/>
          <div class="flex flex-col items-start justify-center w-full pl-3">
            <span class="text-xl custom-font-2">{{ item.title }}</span>
            <span class="font-bold text-white custom-font-2 text-sm">{{ item.upload_date }}</span>
          </div>
        </div>

        <NuxtLink
            v-else
            :to="`/details/${route.params.slug}/${item.chapter}`"
            class="relative flex items-center w-full h-[111px] bg-gray-2 rounded-lg overflow-hidden z-0 border-gray-1 border"
        >
          <div class="custom-font-2 absolute text-[14px] px-4 py-1 bg-red-1 rounded-lg right-[5px] top-[5px] z-10" v-if="item.new">New</div>
          <NuxtImg :src="item.img" class="max-w-[100px] w-full h-full"/>
          <div class="flex flex-col items-start justify-center w-full pl-3">
            <span class="text-xl custom-font-2">{{ item.title }}</span>
            <span class="font-bold text-white custom-font-2 text-sm">{{ item.upload_date }}</span>
          </div>
        </NuxtLink>
      </template>
      <template v-else v-for="i in 12">
        <div class="relative flex items-center w-full h-[111px] bg-gray-2 rounded-lg overflow-hidden z-0 cursor-pointer animate-pulse">&nbsp;</div>
      </template>
    </div>
  </div>
</template>

<style scoped>

</style>