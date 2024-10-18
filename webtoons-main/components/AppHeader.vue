<script setup lang="ts">
import debounce from 'lodash.debounce'
import SearchIcon from "~/components/icons/SearchIcon.vue";
import { onClickOutside } from '@vueuse/core'

const loadingChapters = ref<boolean>(true)
let retrievedChapters = reactive([])

const search = ref<string>("")

let tags = ref([]);

const searchPosts = async ()  => {
  loadingChapters.value = true;

  retrievedChapters.length = 0;

  const result = await useApi("/search" , {
    method: "post",
    body: {
      search: search.value
    }
  }).finally(() => {
    loadingChapters.value = false;
  });

  retrievedChapters.push(...result);
}

watch(search, debounce(() => {
  if(search.value.length > 0) searchPosts()
}, 500))


const navigateToItem = (slug: string) => {
  navigateTo(`/details/${slug}`)
  search.value = "";
  retrievedChapters.length = 0;
}

const results = ref(null)

onClickOutside(results, () => {
  retrievedChapters.length = 0
  search.value = "";
});

const route = useRoute();

const filter = useState('filter')

const filterLatestUpdates = (newFilter: string) => {
    filter.value = newFilter
  if(route.fullPath !== '/'){
  }
}

const getTags = async () => {


  tags.value = await $fetch("http://localhost:8000/api/post/tags")
}

onMounted(() => getTags())

</script>

<template>
  <header class="flex justify-between items-center text-xl leading-[24px] h-[93px] bg-black py-6 lg:py-[34px] px-4 lg:px-12 text-white sticky top-0 z-50">
    <NuxtLink to="/" class="custom-font-2 font-extrabold">LOGO</NuxtLink>

    <div class="hidden xl:block">
      <ul class="flex gap-10 font-bold">
        <li class="cursor-pointer" @click="() => filterLatestUpdates('all')">All</li>
        <li class="cursor-pointer" v-for="tag in tags" @click="() => filterLatestUpdates(tag.slug)">{{ tag.name }}</li>
        <li class="cursor-pointer" @click="() => filterLatestUpdates('popular')">Most popular</li>
      </ul>
    </div>

    <div class="flex gap-4">
      <div class="relative">
        <div class="flex">
          <SearchIcon class="text-gray-1 absolute top-3 left-[14px] h-5 lg:w-5"/>
          <input
              v-model="search"
              placeholder="Search series..."
              class="md:flex-1 bg-beige max-w-[180px] lg:min-w-[358px] text-gray-1 py-2.5 pl-[44px] lg:pl-[50px] pr-3.5 rounded-lg font-medium"
          />
        </div>
        <ul ref="results" v-if="retrievedChapters.length > 0" class="absolute bg-white rounded-br-md rounded-bl-md text-dark w-full overflow-hidden">
          <li @click="() => navigateToItem(chapters.slug)" class="flex gap-2 items-center px-2 py-3 hover:bg-red-1 hover:text-white cursor-pointer" v-for="chapters in retrievedChapters">
          <div class="w-10 h-10 relative rounded-full overflow-hidden">
            <img :src="chapters.cover" class="w-full h-full absolute object-cover" /> />
          </div>
            <div class="flex flex-col gap-1">
              <p>{{chapters.title}}</p>
              <p>{{chapters.uploadedDate}}</p>
            </div>
          </li>


          <div v-if="loadingChapters" class="w-full">
            <div class="border-2 border-t-red-1 animate-spin">&nbsp;</div>
          </div>
        </ul>
      </div>

      <div class="h-10 w-10 rounded-full overflow-hidden hidden lg:block">
        <NuxtImg src="avatar.jpeg"  />
      </div>
    </div>
  </header>
</template>


<style lang="scss" scoped>

</style>