<script setup lang="ts">
import FollowIcon from "~/components/icons/FollowIcon.vue";

export interface DetailProps {
  img: string;
  follows: number;
  title: string;
  description: string;
  status: string;
  release_year: number;
  author: string[];
  alt_names: string;
  category: string;
  views: number;
  chapters: number;
  tags: string[],
  genres: string,
}

defineProps({
   detail: {
     type: Object as () => DetailProps,
     default: () => {}
   },
  loading: {
     type: Boolean,
    default: false
  },
})
</script>

<template>
  <div class="w-full px-4 lg:p-12 bg-black text-white">
    <div class="flex flex-col lg:flex-row gap-[58px] w-full h-full lg:p-8 bg-dark bg-opacity-50 rounded-xl">
      <div class="flex flex-col gap-8 w-full lg:w-3/4 pt-8 lg:pt-0">
        <!-- Imagen con skeleton -->
        <div :class="['w-full h-[508px] lg:h-full relative overflow-hidden rounded-lg', loading ? 'bg-gray-2 animate-pulse' : '']">
          <NuxtImg v-if="detail?.img && !loading" :src="detail.img" class="absolute object-cover object-center w-full h-full" />
        </div>

        <!-- Follows con skeleton -->
        <div :class="['rounded-[10px] flex justify-center py-[15px] gap-2.5 text-2xl custom-font-2', loading ? 'bg-gray-2 animate-pulse h-[58px] w-full' : 'bg-red-1 text-white']">
          <template v-if="!loading">
            <FollowIcon /> Follow <FollowIcon />
            {{ detail?.follows?.toLocaleString() }}
          </template>
        </div>
      </div>

      <div class="flex flex-col gap-6 w-full h-full">
        <!-- Título con skeleton -->
        <span :class="['custom-font-1 text-2xl lg:text-5xl', loading ? 'bg-gray-2 animate-pulse h-[40px] w-full lg:w-3/4' : '']">
        {{ loading ? '' : detail?.title }}
      </span>

        <div class="w-full flex-1">
          <div class="flex gap-4 custom-font-2">
            <!-- Visitas con skeleton -->
            <span :class="['border-red-1 border-b-2 pb-3 text-2xl h-full', loading ? 'bg-gray-2 animate-pulse h-[40px] w-[100px]' : '']">
            {{ loading ? '' : detail?.visits?.toLocaleString() }}
          </span>
            <!-- Capítulos con skeleton -->
            <span :class="['border-red-1 border-b-2 pb-3 text-2xl', loading ? 'bg-gray-2 animate-pulse h-[40px] w-[120px]' : '']">
            {{ loading ? '' : `${detail?.chapters?.length?.toLocaleString() ?? 0} Chapters` }}
          </span>
          </div>

          <div class="p-4 border-red-1 border-b-2 border-l-2 border-r-2 w-full h-full bg-dark">
            <span v-if="!loading && detail?.description" class="text-2xl custom-font-1 mb-4">Description:</span>
            <p :class="['custom-font-2 font-normal text-base mb-4', loading ? 'bg-gray-2 animate-pulse h-[20px] w-full' : '']">
              {{ loading ? '' : detail?.description }}
            </p>

            <p v-if="detail?.genres" :class="['text-lg custom-font-1 mb-4 flex-1', loading ? 'bg-gray-2 animate-pulse h-[20px] w-full' : '']">
              {{ loading ? '' : `Genres: ${detail?.genres}` }}
            </p>

            <button v-if="detail?.category" :class="['custom-font-2 mb-12 text-base px-[25px] py-[17px] rounded-[10px]', loading ? 'bg-gray-2 animate-pulse h-[50px] w-full' : 'bg-red-1 text-white']">
              {{ loading ? '' : detail?.category }}
            </button>

            <div class="flex flex-col mb-[48px]">
              <span class="text-2xl custom-font-1 mb-4">Additional Info:</span>
              <div :class="['custom-font-2 font-normal max-w-[450px] text-base mb-3.5', loading ? 'bg-gray-2 animate-pulse h-[20px] w-full' : '']">
                {{ loading ? '' : `Other names: ${detail?.alt_names}` }}
              </div>
              <div class="flex flex-col lg:flex-row gap-5 custom-font-2 text-xl w-fit">
              <span :class="loading ? 'bg-gray-2 animate-pulse h-[20px] w-[100px]' : ''">
                {{ loading ? '' : `Status: ${detail?.status}` }}
              </span>
              </div>
            </div>

            <div class="text-2xl custom-font-1 mb-4">Tags:</div>
            <div class="grid grid-cols-4 gap-2">
              <template v-if="loading">
                <div v-for="n in 4" :key="n" class="bg-gray-2 animate-pulse h-[40px] w-full lg:w-[100px] rounded-[10px]"></div>
              </template>
              <button v-for="tag in detail?.tags" :key="tag" v-if="!loading" class="custom-font-2 bg-red-1 text-white text-base px-2 w-full lg:px-6 py-2 rounded-[10px]">
                {{ tag }}
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped></style>