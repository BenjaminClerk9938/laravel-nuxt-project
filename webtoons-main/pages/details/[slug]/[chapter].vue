<template>
    <div class="py-4">
      <div v-for="chapter in detail?.urls" :key="chapter" class="flex items-center justify-center px-4">
        <img :src="chapter.original_url" />
      </div>
      <div class="flex items-center justify-center gap-10 p-4">
        <button @click="goToChapters" class="bg-red-1 transition-all duration-500 hover:bg-opacity-80 border-red-1 border-2 font-semibold text-white text-center custom-font-2 px-9 py-2.5 md:py-[17px] rounded-[10px] text-sm md:text-base">
          Back to chapters
        </button>

        <button v-if="detail?.next_chapter" @click="nextChapter(detail.next_chapter)" class="bg-red-1 transition-all duration-500 hover:bg-opacity-80 border-red-1 border-2 font-semibold text-white text-center custom-font-2 px-9 py-2.5 md:py-[17px] rounded-[10px] text-sm md:text-base">
          Next chapter
        </button>
      </div>
    </div>
</template>

<script lang="ts" setup>
const route = useRoute()
const router = useRouter()
const detail = ref()

const getPostDetails = async () => {
  detail.value = await $fetch(`/api/chapters`, {
    method: 'POST',
    body: {
      chapter: route.params.chapter,
      slug: route.params.slug,
    }
  })
}

const goToChapters = () => {
  const updatedPath = route.path.replace(/\d+$/, "");
    navigateTo(updatedPath);
}

const nextChapter = (nextChapter) => {
  if (nextChapter != null) {
    const updatedPath = route.path.replace(/\d+$/, nextChapter);
    navigateTo(updatedPath);
  }
}

onMounted(()  => {
  getPostDetails();
})
</script>

<style lang="scss" scoped>

</style>