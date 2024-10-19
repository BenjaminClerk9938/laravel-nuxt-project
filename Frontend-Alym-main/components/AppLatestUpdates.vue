<script setup lang="ts">
import { TailwindPagination } from 'laravel-vue-pagination';

export interface Update {
  id?: string;
  category: string;
  title: string;
  cta_text1: string;
  cta_url1: string;
  cta_text2: string;
  cta_url2: string;
  img: string;
}

defineProps({
  items: {
    type: Object as () => Update[],
    default: () => []
  },
  loading: {
    type: Boolean, default: () => false
  },

})

defineEmits(["goTo"])

const router = useRouter()
</script>

<template>
  <div class="px-4 lg:pl-12 lg:pr-6 pt-[48px] lg:pt-[140px] text-white flex flex-col gap-5 lg:gap-6">
      <div class="flex flex-col gap-9">
        <p class="custom-font-1 text-[37px]">Latest updates</p>

        <div class="grid grid-cols-2 lg:grid-cols-3 gap-2.5 lg:gap-4">
          <div v-if="loading" v-for="i in 9" class="flex flex-col gap-[23px] lg:h-[491px] rounded-lg p-2 lg:p-[15px] bg-gray-2">
            <!-- Placeholder content while loading -->
          </div>

          <div v-else-if="items && items.data && items.data.length > 0" v-for="item in items.data" class="flex flex-col gap-[23px] lg:h-[491px] rounded-lg p-2 lg:p-[15px] bg-gray-2">
            <div class="h-[141px] lg:h-[295px] w-full relative">
              <NuxtImg :src="item.img" class="absolute object-cover object-center w-full h-full"></NuxtImg>
              <span class="absolute top-2.5 right-2.5 bg-red-1 px-1.5 lg:px-7 py-[2px] lg:py-1 rounded-[5px] text-[10px] lg:text-sm">
                {{ item.category }}
            </span>
            </div>
            <div class="flex flex-col gap-5 lg:gap-[15px]">
              <p class="custom-font-1 text-lg truncate">{{ item.title }}</p>
              <nuxt-link :to="`details/${item.id}`" class="text-[10px] lg:text-base border rounded-lg px-2 lg:px-16 py-3 text-center hover:text-gray-2 hover:bg-white">
                {{ item.cta_text1 }}
              </nuxt-link>
              <nuxt-link :to="`details/${item.id}`" class="text-[10px] lg:text-base border rounded-lg px-2 lg:px-16 py-3 text-center hover:text-gray-2 hover:bg-white">
                {{ item.cta_text2 }}
              </nuxt-link>
            </div>
          </div>

          <div v-else class="col-span-3 flex flex-col gap-2 items-center justify-center w-full h-52">
            <h1 class="text-4xl">No items found</h1>
            <p class="text-lg">Please, try again.</p>
          </div>
        </div>


      </div>
        <TailwindPagination
            class="paginator"
            :data="items"
            @pagination-change-page="$page => $emit('goTo', $page)"
        />
  </div>
</template>
<style scoped>

</style>